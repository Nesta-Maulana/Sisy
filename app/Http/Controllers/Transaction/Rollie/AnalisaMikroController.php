<?php

namespace App\Http\Controllers\Transaction\Rollie;

use App\Http\Controllers\ResourceController;
use App\Models\Transaction\Rollie\AnalisaMikro;
use App\Models\Transaction\Rollie\AnalisaMikroDetail;
use App\Models\Transaction\Rollie\AnalisaMikroResampling;
use App\Models\Transaction\Rollie\RpdFillingDetailPi;
use App\Models\Transaction\Rollie\CppHead;
use App\Models\Transaction\Rollie\CppDetail;
use App\Models\Transaction\Rollie\Ppq;
use App\Models\Transaction\Rollie\Palet;
use App\Models\Transaction\Rollie\PaletPpq;

use App\Models\Master\Product;
use App\Models\Master\FillingSampelCode;
use App\Models\Master\FillingMachine;
use App\Models\Master\User;
use App\Models\Master\DistributionList;


use Illuminate\Support\Facades\Mail;
use App\Mail\Rollie\AnalisaMikro\NotificationToQCRelease;
use App\Mail\Rollie\Ppq\NewPpqMail;

use Illuminate\Http\Request;

class AnalisaMikroController extends ResourceController
{
    public function inputAnalisaMikro(Request $request)
    {
        $url    = explode('/',\Request::getRequestUri());
        $url    = $url[2];
        $cekAkses   = $this->checkAksesTambah(\Request::getRequestUri(),'rollie.analysis_data.'.str_replace('-','_',$url));
        if ($cekAkses['success']) 
        {
            $cpp_head_id    = $this->decrypt($request->cpp_head_id);
            $cppHead        = CppHead::find($cpp_head_id);
            if (is_null($cppHead->analisaMikro)) 
            {
                /* ini untuk input analisa mikro nya ya  */
                $tanggal_analisa    = date('Y-m-d');
                $analisaMikro       = AnalisaMikro::create([
                    'cpp_head_id'       => $cppHead->id,
                    'tanggal_analisa'   => $tanggal_analisa,
                    'progress_status'   => '0'
                ]);
                $analisaMikro->progress_status_30   ='0';
                if ($cppHead->woNumbers[0]->product->productType->product_type == 'Susu') 
                {
                    $analisaMikro->progress_status_55   ='0';
                } 
                $analisaMikro->save();
                $cppHead->analisa_mikro_id  = $analisaMikro->id;
                $cppHead->save();
                $counting       = 1;
                $countingR      = 1;
                $pi_biasa       = array();
                $pi_R           = array();
                foreach ($cppHead->product->fillingMachineGroupHead->fillingMachineGroupDetails as $fillingMachineGroupDetail) 
                {
                    foreach ($cppHead->woNumbers as $woNumber) 
                    {
                        foreach ($woNumber->rpdFillingDetailPis as $rpdFillingDetailPi) 
                        {
                            if ($rpdFillingDetailPi->filling_machine_id === $fillingMachineGroupDetail->filling_machine_id) 
                            {
                                /* ini kalo bukan sampel Random maka dia pake urutan yang berurutan */
                                if (strpos($rpdFillingDetailPi->fillingSampelCode->filling_sampel_code,'R') === false && $rpdFillingDetailPi->fillingSampelCode->mikro30 > 0) 
                                {
                                    for ($i = $counting; $i < $counting+$rpdFillingDetailPi->fillingSampelCode->mikro30 ; $i++) 
                                    {    
                                        $kode_sampel                    = $rpdFillingDetailPi->fillingSampelCode->filling_sampel_code.$i;
                                        $simpan                         = AnalisaMikroDetail::create([
                                            'analisa_mikro_id'          => $analisaMikro->id,
                                            'kode_sampel'               => $kode_sampel,
                                            'jam_filling'               => $rpdFillingDetailPi->filling_date.' '.$rpdFillingDetailPi->filling_time,
                                            'filling_machine_id'        => $rpdFillingDetailPi->filling_machine_id, 
                                            'suhu_preinkubasi'          => '30', 
                                            'status'                    => '0',
                                        ]);
                                    }
                                    $counting = $i;
                                }
                                /* kalo dia sampel random maka akan di declare seperti ini */
                                elseif(strpos($rpdFillingDetailPi->fillingSampelCode->filling_sampel_code, 'R') !== false && $rpdFillingDetailPi->fillingSampelCode->mikro30 > 0)
                                {
                                    for ($i = $countingR; $i < $countingR+$rpdFillingDetailPi->fillingSampelCode->mikro30 ; $i++) 
                                    {
                                            $kode_sampel            = $rpdFillingDetailPi->fillingSampelCode->filling_sampel_code.$i;
                                            AnalisaMikroDetail::create([
                                                'analisa_mikro_id'         => $analisaMikro->id,
                                                'kode_sampel'              => $kode_sampel,
                                                'jam_filling'              => $rpdFillingDetailPi->filling_date.' '.$rpdFillingDetailPi->filling_time,
                                                'filling_machine_id'       => $rpdFillingDetailPi->filling_machine_id, 
                                                'suhu_preinkubasi'         => '30', 
                                                'status'                   => '0',
                                            ]);
                                    }
                                    $countingR = $i;
                                }
                            }
                        }
                    }
                    /* redeclare jika ganti batch */
                    $counting       = 1;
                    $countingR      = 1;
                }
                foreach ($cppHead->woNumbers as $woNumber) 
                {
                    if ($woNumber->product->productType->product_type == 'Susu') 
                    {
                        foreach ($woNumber->rpdFillingDetailPis->unique('filling_machine_id') as $rpdFillingDetailPi)
                        {
                            AnalisaMikroDetail::create([
                                'analisa_mikro_id'         => $analisaMikro->id,
                                'kode_sampel'              => 'S1',
                                'jam_filling'              => $rpdFillingDetailPi->woNumber->cppHead->analisaKimia->jam_filling_awal,
                                'filling_machine_id'        => $rpdFillingDetailPi->filling_machine_id, 
                                'suhu_preinkubasi'         => '55', 
                                'status'                   => '0', 
                            ]);

                            AnalisaMikroDetail::create([
                                'analisa_mikro_id'         => $analisaMikro->id,
                                'kode_sampel'              => 'S2',
                                'filling_machine_id'        => $rpdFillingDetailPi->filling_machine_id,
                                'jam_filling'              => $rpdFillingDetailPi->woNumber->cppHead->analisaKimia->jam_filling_tengah,
                                'suhu_preinkubasi'         => '55', 
                                'status'                   => '0', 
                                
                            ]);

                            AnalisaMikroDetail::create([
                                'analisa_mikro_id'         => $analisaMikro->id,
                                'kode_sampel'              => 'S3',
                                'filling_machine_id'        => $rpdFillingDetailPi->filling_machine_id,
                                'jam_filling'              => $rpdFillingDetailPi->woNumber->cppHead->analisaKimia->jam_filling_akhir,
                                'suhu_preinkubasi'         => '55', 
                                'status'                   => '0', 
                            ]);
                        }
                    }
                    // return $pi_biasa;
                }
                return ['success' => true,'analisa_mikro_id'=>$this->encrypt($analisaMikro->id),'url'=>$url];
            } 
            else 
            {
                /* ini apabila ternyata sudah ada analisa mikro produk tsb */
            }
            
        } 
        else
        {
            return $cekAkses;
        }
        


    }
    function analisaMikroDetail($analisaMikroDetail,$url,$inputan,$product)
    {
        /* ini jika analisa mikro 30 nya belum close */
        switch ($url) 
        {
            case 'analisa-mikro-produk':
                
                $analisaMikroDetail->tpc    = $inputan['tpc'];
                if ($product->oracle_code == '7300861') 
                {
                    $analisaMikroDetail->yeast  = $inputan['yeast'];
                    $analisaMikroDetail->mold   = $inputan['mold'];
                }
                $analisaMikroDetail->save();
            
            break;
            case 'analisa-ph-produk':
                
                $analisaMikroDetail->ph     = $inputan['ph'];
                $analisaMikroDetail->save();
            
            break;
            case 'analisa-mikro-release':
                
                $analisaMikroDetail->tpc    = $inputan['tpc'];
                if ($product->oracle_code == '7300861') 
                {
                    $analisaMikroDetail->yeast  = $inputan['yeast'];
                    $analisaMikroDetail->mold   = $inputan['mold'];
                }
                
                
                $analisaMikroDetail->ph         = $inputan['ph'];
                if (!is_null($inputan['tpc']) && !is_null($inputan['ph']) ) 
                {
                    if ($product->oracle_code == '7300861') 
                    {
                        if (!is_null($inputan['yeast']) && !is_null($inputan['mold']))
                        {
                            $analisaMikroDetail->status     = $inputan['status'];
                        }
                    } 
                    else 
                    {
                        $analisaMikroDetail->status     = $inputan['status'];
                    }
                                        
                }
                $analisaMikroDetail->save();
                /* $analisaMikroDetail->analisaMikroHead->verifikasi_qc_release    = '1';
                $analisaMikroDetail->analisaMikroHead->save(); */
            break;
        }

        $keterangan_analisa_mikro               = '';
        /* disini pengecekan masih ada data analisa mikro yang kosong atau engga , kalo semua data mikro sudah terisi bisa kirim email ke tim qc release , namun jika masih ada yang kosong akan di simpan sebagai draft analisa yang masih bisa di input oleh tim terkait */
        if ( is_null($analisaMikroDetail->tpc) || is_null($analisaMikroDetail->ph) ) 
        {
            $hasil_analisa_mikro['status_akhir']                    = NULL; /* ini untuk status analisa mikro di table analisa mikro detail*/
            $hasil_analisa_mikro['keterangan_analisa_mikro']        = $keterangan_analisa_mikro;  /* keterangannya di kosongin karena emang masih kosong */
            $hasil_analisa_mikro['suhu_preinkubasi']                = $analisaMikroDetail->suhu_preinkubasi;  /* untuk acuan pembuatan ppq yang dipisah per suhu */
            $hasil_analisa_mikro['progress_status_'.$analisaMikroDetail->suhu_preinkubasi]      = '0' ;  /* untuk acuan pembuatan ppq yang dipisah per suhu */
            $hasil_analisa_mikro['filling_machine_id']              = $analisaMikroDetail->filling_machine_id; /* untuk acuan pembuatan ppq berdasarkan mesin */
            $hasil_analisa_mikro['jam_filling']                     = $analisaMikroDetail->jam_filling; /* ini untuk acuan pembuatan ppq pengambilan palet berdasarkan jam filling */
            $hasil_analisa_mikro['analisa_mikro_detail_id']         = $analisaMikroDetail->id;  /* untuk acuan pembuatan palet ppq */
            
            return $hasil_analisa_mikro;
            //$array_hasil_analisa_mikro[$analisaMikroDetail->id]     = $hasil_analisa_mikro; /* disini akan ditampung seluruh hasil analisa mikro untuk pengecekan selanjutnya ya */
            //unset($hasil_analisa_mikro['progress_status_'.$analisaMikroDetail->suhu_preinkubasi]);
        } 
        else 
        {
            $hasil_analisa_mikro['suhu_preinkubasi']        = $analisaMikroDetail->suhu_preinkubasi;
            $hasil_analisa_mikro['progress_status_'.$analisaMikroDetail->suhu_preinkubasi]      = '1' ;  /* untuk acuan pembuatan ppq yang dipisah per suhu */
            $hasil_analisa_mikro['filling_machine_id']      = $analisaMikroDetail->filling_machine_id;
            $hasil_analisa_mikro['jam_filling']             = $analisaMikroDetail->jam_filling;
            $hasil_analisa_mikro['analisa_mikro_detail_id'] = $analisaMikroDetail->id;  /* untuk acuan pembuatan ppq yang dipisah per suhu */
            
            /* ini untuk pengecekan tpc nya sesuai spek atau tidak */
            if ($analisaMikroDetail->tpc > 0 ) 
            {
                /* ini apabila spek tpc terdeteksi pada produk maka akan di cek apakah keterangan analisa mikro detail tersebut masih kosong atau sudah ada isinya */
                if ($keterangan_analisa_mikro  == '') 
                {
                    $keterangan_analisa_mikro   = 'TPC pada pukul '.$analisaMikroDetail->jam_filling.' sejumlah '.$analisaMikroDetail->tpc;
                } 
                else 
                {
                    $keterangan_analisa_mikro   .= ', TPC pada pukul '.$analisaMikroDetail->jam_filling.' sejumlah '.$analisaMikroDetail->tpc;
                }

                if ($analisaMikroDetail->ph < $product->spek_ph_min || $analisaMikroDetail->ph > $product->spek_ph_max ) 
                {
                    // ini untuk analisa pH yang diluar spek ya a.k.a #OK 
                    if ($keterangan_analisa_mikro == '') 
                    {
                        $keterangan_analisa_mikro   = 'pH pada pukul '.$analisaMikroDetail->jam_filling.' bernilai '.$analisaMikroDetail->ph.' berada diluar spek. Spek minimal : '.$product->spek_ph_min.' spek max : '.$product->spek_ph_max;
                    } 
                    else 
                    {
                        $keterangan_analisa_mikro   .= ', pH pada pukul '.$analisaMikroDetail->jam_filling.' bernilai '.$analisaMikroDetail->ph.' berada diluar spek. Spek minimal : '.$product->spek_ph_min.' spek max : '.$product->spek_ph_max;
                    }
                }
                $progress_status                                    = '1'; // ini untuk setting status progress di analisa kimia head
                $hasil_analisa_mikro['status_akhir']                = '0';
                $hasil_analisa_mikro['keterangan_analisa_mikro']    = $keterangan_analisa_mikro;
            } 
            else 
            {
                /* ini tpcnya oke , lalu di lakukan pengecekan analisa ph nya oke atau engga */
                if ($analisaMikroDetail->ph < $product->spek_ph_min || $analisaMikroDetail->ph > $product->spek_ph_max ) 
                {
                    // ini untuk analisa pH yang diluar spek ya a.k.a #OK 
                    if ($keterangan_analisa_mikro == '') 
                    {
                        $keterangan_analisa_mikro   = 'pH pada pukul '.$analisaMikroDetail->jam_filling.' bernilai '.$analisaMikroDetail->ph.' berada diluar spek. Spek minimal : '.$product->spek_ph_min.' spek max : '.$product->spek_ph_max;
                    } 
                    else 
                    {
                        $keterangan_analisa_mikro   .= ', pH pada pukul '.$analisaMikroDetail->jam_filling.' bernilai '.$analisaMikroDetail->ph.' berada diluar spek. Spek minimal : '.$product->spek_ph_min.' spek max : '.$product->spek_ph_max;
                    }
                    $progress_status                                    = '1'; // ini untuk setting status progress di analisa kimia head
                    $hasil_analisa_mikro['status_akhir']                = '0';
                    $hasil_analisa_mikro['keterangan_analisa_mikro']    = $keterangan_analisa_mikro;
                    
                }
                else
                {  
                    $progress_status                                    = '1'; // ini untuk setting status progress di analisa kimia head
                    $hasil_analisa_mikro['status_akhir']                = '1';
                    $hasil_analisa_mikro['keterangan_analisa_mikro']    = $keterangan_analisa_mikro;        
                }
            }
            /* ini dilakukan pengecekan apakah produk yang sedang dianalisa ada */
            if ($product->oracle_code == '7300861') 
            {
                if (is_null($analisaMikroDetail->yeast) || is_null($analisaMikroDetail->mold))
                {
                    $hasil_analisa_mikro['progress_status_'.$analisaMikroDetail->suhu_preinkubasi]      = '0' ;  /* untuk acuan pembuatan ppq yang dipisah per suhu */        
                    $progress_status                                    = '0'; // ini untuk setting status progress di analisa kimia head
                    $hasil_analisa_mikro['status_akhir']                = NULL;
                    $hasil_analisa_mikro['keterangan_analisa_mikro']    = $keterangan_analisa_mikro;
                    if ($analisaMikroDetail->suhu_preinkubasi =='30') 
                    {
                        $progress_status_30       = '0';
                    } 
                    else if($analisaMikroDetail->suhu_preinkubasi =='55')
                    {
                        $progress_status_55       = '0';
                    }
                } 
                else 
                {
                    if ($analisaMikroDetail->yeast > 0) 
                    {
                        if ($keterangan_analisa_mikro == '') 
                        {
                            $keterangan_analisa_mikro   = 'Yeast pada pukul '.$analisaMikroDetail->jam_filling.' terdeteksi sejumlah : '.$analisaMikroDetail->yeast;
                        } 
                        else 
                        {
                            $keterangan_analisa_mikro   .= ', Yeast pada pukul '.$analisaMikroDetail->jam_filling.' terdeteksi sejumlah : '.$analisaMikroDetail->yeast;
                        }
                    }
                    if ($analisaMikroDetail->mold > 0) 
                    {
                        if ($keterangan_analisa_mikro == '') 
                        {
                            $keterangan_analisa_mikro   = 'Mold pada pukul '.$analisaMikroDetail->jam_filling.' terdeteksi sejumlah : '.$analisaMikroDetail->mold;
                        } 
                        else 
                        {
                            $keterangan_analisa_mikro   .= ', Mold pada pukul '.$analisaMikroDetail->jam_filling.' terdeteksi sejumlah : '.$analisaMikroDetail->mold;
                        }
                    }
                    
                    if ($analisaMikroDetail->mold == 0 && $analisaMikroDetail->yeast == 0)
                    {
                        if ($hasil_analisa_mikro['status_akhir'] !== '0') 
                        {
                            $hasil_analisa_mikro['status_akhir']                = '1'; 
                        }
                            
                    } 
                    else 
                    {
                        $hasil_analisa_mikro['status_akhir']                = '0';
                    }
                    
                    $progress_status                                    = '1'; // ini untuk setting status progress di analisa kimia head
                    $hasil_analisa_mikro['keterangan_analisa_mikro']    = $keterangan_analisa_mikro;
                    $hasil_analisa_mikro['progress_status_'.$analisaMikroDetail->suhu_preinkubasi]      = '1' ;  /* untuk acuan pembuatan ppq yang dipisah per suhu */   
                }                        
            }
            $analisaMikroDetail->status                         = $hasil_analisa_mikro['status_akhir'];
            $analisaMikroDetail->save();
            return $hasil_analisa_mikro;
            // $array_hasil_analisa_mikro[$analisaMikroDetail->id] = $hasil_analisa_mikro;
            // unset($hasil_analisa_mikro['progress_status_'.$analisaMikroDetail->suhu_preinkubasi]);
            // $keterangan_analisa_mikro                               = '';      

            
        }
    }
    public function submitHasilAnalisa(Request $request)
    {
        $url        = explode('/',\Request::getRequestUri());
        $url        = $url[2];
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'rollie.analysis_data.'.str_replace('-','_',$url));
        if ($cekAkses['success'] == true) 
        {
            $status_akhir               = '0';
            $progress_status            = '0';
            $progress_status_30         = '0';
            $progress_status_55         = '0';
            $status_akhir               = array();
            $jam_filling_tidak_ok       = array();
            $analisa_mikro_id           = $request->analisa_mikro_id;
            $product_id                 = $request->product_id;
            $product                    = Product::find($this->decrypt($product_id));
            $analisaMikro               = AnalisaMikro::find($this->decrypt($analisa_mikro_id));
            $array_hasil_analisa_mikro  = array();
            foreach ($request->except(['analisa_mikro_id','product_id','_token','simpan']) as $analisa_mikro_id => $inputan ) 
            {
                $analisaMikroDetail         = AnalisaMikroDetail::find($this->decrypt($analisa_mikro_id));
                if ($analisaMikro->cppHead->product->productType->product_type == 'Susu') 
                {
                    if ($analisaMikro->progress_status == '0') 
                    {
                        /* ini yang include suhu 30 dan 55  */
                        if ($analisaMikro->progress_status_30 !== '2') 
                        {
                            $hasil_analisa_mikro                                    = $this->analisaMikroDetail($analisaMikroDetail,$url,$inputan,$product);
                            $array_hasil_analisa_mikro[$analisaMikroDetail->id]     = $hasil_analisa_mikro; /* disini akan ditampung seluruh hasil analisa mikro untuk pengecekan selanjutnya ya */
                        } 
                        else 
                        {
                            if ($analisaMikroDetail->suhu_preinkubasi == '55') 
                            {
                                $hasil_analisa_mikro                                    = $this->analisaMikroDetail($analisaMikroDetail,$url,$inputan,$product);
                                $array_hasil_analisa_mikro[$analisaMikroDetail->id]     = $hasil_analisa_mikro; /* disini akan ditampung seluruh hasil analisa mikro untuk pengecekan selanjutnya ya */
                            }   
                        }
                        
                    } 
                    else 
                    {
                        /* ini jika analisa mikro 30 nya sudah close */
                        return redirect(route('rollie.analysis_data.'.str_replace('-','_',$url)))->with('error','Analisa mikro mikro sudah diinput, harap hubungi QC Release apabila ada kesalahan input hasil pengamatan.');
                    }
                    
                } 
                else if($analisaMikro->cppHead->product->productType->product_type == 'Non Susu')
                {
                    /* ini hanya suhu 30 saja */
                    if ($url !== 'analisa-mikro-release')
                    {
                        if ($analisaMikro->progress_status == '0') 
                        {
                            $hasil_analisa_mikro    = $this->analisaMikroDetail($analisaMikroDetail,$url,$inputan,$product);
                            $array_hasil_analisa_mikro[$analisaMikroDetail->id]     = $hasil_analisa_mikro; /* disini akan ditampung seluruh hasil analisa mikro untuk pengecekan selanjutnya ya */
                        }
                        else
                        {
                            return redirect(route('rollie.analysis_data.'.str_replace('-','_',$url)))->with('error','Analisa mikro mikro sudah diinput, harap hubungi QC Release apabila ada kesalahan input hasil pengamatan.');   
                        }
                    }
                    else
                    {
                        $hasil_analisa_mikro    = $this->analisaMikroDetail($analisaMikroDetail,$url,$inputan,$product);
                        $array_hasil_analisa_mikro[$analisaMikroDetail->id]     = $hasil_analisa_mikro; /* disini akan ditampung seluruh hasil analisa mikro untuk pengecekan selanjutnya ya */
                    }
                }   
            }
            if ($request->simpan == 'draft') 
            {
                return redirect(route('rollie.analysis_data.'.str_replace('-','_',$url)))->with('success','Draft hasil analisa mikro produk '.$product->product_name.' berhasil disimpan');
            } 
            elseif($request->simpan == 'simpan') 
            {
                $arraystatus    = array();
                $keterangan     = '';
                $detailPpq      = array();
                foreach ($array_hasil_analisa_mikro as $hasil_analisa_mikro) 
                {
                    if ($hasil_analisa_mikro['suhu_preinkubasi'] == '30') 
                    {
                        $progress_status_30     = $hasil_analisa_mikro['progress_status_30'];
                    } 
                    else 
                    {
                        $progress_status_55     = $hasil_analisa_mikro['progress_status_55'];
                    }
                    if ($hasil_analisa_mikro['status_akhir'] == '0') 
                    {
                        $array_for_ppq['suhu_preinkubasi']          = $hasil_analisa_mikro['suhu_preinkubasi'];
                        $array_for_ppq['jam_filling']               = $hasil_analisa_mikro['jam_filling'];
                        $array_for_ppq['filling_machine_id']        = $hasil_analisa_mikro['filling_machine_id'];
                        $array_for_ppq['keterangan_analisa_mikro']  = $hasil_analisa_mikro['keterangan_analisa_mikro'];
                        $array_for_ppq['analisa_mikro_detail_id']   = $hasil_analisa_mikro['analisa_mikro_detail_id'];
                        array_push($detailPpq,$array_for_ppq);
                        array_push($arraystatus,$hasil_analisa_mikro['status_akhir']);
                        $keterangan .= $hasil_analisa_mikro['keterangan_analisa_mikro'].' | ';
                        $analisaMikro->analisa_mikro_status = '0';
                        $analisaMikro->save();
                    }
                }
                
                if ($url !== 'analisa-mikro-release') 
                {
                    if ($analisaMikro->cppHead->product->productType->product_type == 'Susu') 
                    {
                        if ($analisaMikro->progress_status_30 == '0') 
                        {
                            $analisaMikro->progress_status_30       = $progress_status_30;
                            $analisaMikro->progress_status_55       = $progress_status_55;
                            if ($progress_status_30 == '1' && $progress_status_55 == '1') 
                            {
                                /* apabila status analisa mikro 30 dan 55 sudah selesai maka akan dilanjutkan */
                                $analisaMikro->progress_status          = '1';
                            } 
                            else 
                            {
                                $analisaMikro->progress_status          = '0';
                            }
                            $analisaMikro->save();                            
                            if ($progress_status_30 == '1' && $progress_status_55   == '1') 
                            {
                                Mail::to('nestamaulana165@gmail.com')->bcc('nestamaulana165@gmail.com')->send(new NotificationToQCRelease($analisaMikro,$keterangan,'Rollie - Hasil Pengamatan Mikro Suhu 30 & 55 '.$analisaMikro->cppHead->woNumbers[0]->product->product_name.' Tanggal Produksi ' . $analisaMikro->cppHead->woNumbers[0]->production_realisation_date));
                                return redirect(route('rollie.analysis_data.'.str_replace('-','_',$url)))->with('success','Hasil analisa mikro berhasil disimpan. Apabila ada kesalahan input data harap segera hubungi QC Release');
                            } 
                            else if($progress_status_30 =='1' && $progress_status_55 == '0')
                            {
                                Mail::to('nestamaulana165@gmail.com')->bcc('nestamaulana165@gmail.com')->send(new NotificationToQCRelease($analisaMikro,$keterangan,'Rollie - Hasil Pengamatan Mikro Suhu 30 '.$analisaMikro->cppHead->woNumbers[0]->product->product_name.' Tanggal Produksi '.$analisaMikro->cppHead->woNumbers[0]->production_realisation_date));
                                return redirect(route('rollie.analysis_data.'.str_replace('-','_',$url)))->with('success','Hasil analisa mikro 30 berhasil disimpan. Apabila ada kesalahan input data harap segera hubungi QC Release');
                            }
                            else
                            {
                                return redirect(route('rollie.analysis_data.'.str_replace('-','_',$url)))->with('success','Hasil analisa mikro berhasil disimpan, namun masih bisa dilakukan perubahan data apabila diperlukan.');
                            }
                            
                        } 
                        else if($analisaMikro->progress_status_30 == '1')
                        {
                            $analisaMikro->progress_status_55       = $progress_status_55;
                            if ($progress_status_55 == '1') 
                            {
                                $analisaMikro->progress_status          = '1';
                                Mail::to('nestamaulana165@gmail.com')->bcc('nestamaulana165@gmail.com')->send(new NotificationToQCRelease($analisaMikro,$keterangan,'Rollie - Hasil Pengamatan Mikro Suhu 55 '.$analisaMikro->cppHead->woNumbers[0]->product->product_name.' Tanggal Produksi ' . $analisaMikro->cppHead->woNumbers[0]->production_realisation_date));
                            } 
                            $analisaMikro->save();                        
                            return redirect(route('rollie.analysis_data.'.str_replace('-','_',$url)))->with('success','Hasil analisa mikro 55 berhasil disimpan. Apabila ada kesalahan input data harap segera hubungi QC Release');
                        }
                    } 
                    else 
                    {
                        if ($progress_status_30 == '0') 
                        {
                            $analisaMikro->progress_status          = '0';
                            $analisaMikro->progress_status_30       = $progress_status_30;
                            $analisaMikro->save();
                            return redirect(route('rollie.analysis_data.'.str_replace('-','_',$url)))->with('success','Hasil analisa mikro berhasil disimpan, masih bisa dilakukan perubahan data apabila diperlukan.');
                        } 
                        else 
                        {
                            $analisaMikro->progress_status          = '1';
                            $analisaMikro->progress_status_30       = $progress_status_30;
                            $analisaMikro->save();
                            Mail::to('nestamaulana165@gmail.com')->bcc('nestamaulana165@gmail.com')->send(new NotificationToQCRelease($analisaMikro,$keterangan,'Rollie - Hasil Pengamatan Mikro Suhu 30 '.$analisaMikro->cppHead->woNumbers[0]->product->product_name.' Tanggal Produksi '.$analisaMikro->cppHead->woNumbers[0]->production_realisation_date));
                            return redirect(route('rollie.analysis_data.'.str_replace('-','_',$url)))->with('success','Hasil analisa mikro 30 berhasil disimpan. Apabila ada kesalahan input data harap segera hubungi QC Release');
                        }
                    }
                } 
                else if($url == 'analisa-mikro-release') 
                {
                /*  ini jika halaman yang diakses adalah halaman analisa mikro release */
                    if ($analisaMikro->cppHead->product->productType->product_type == 'Susu') 
                    {
                        if ($analisaMikro->progress_status_30 == '2') 
                        {
                            /* ini kalo analisa mikro 30 nya sudah dilakukan atau sudah di verifikasi */
                        } 
                        else 
                        {
                            /*  ini kalo analisa mikro 30  nya belum dilakukan atau belum di verifikasi */
                            if ($progress_status_30 == '1' && $progress_status_55 == '1') 
                            {
                                /*  ini apabila seluruh  analisa mikro di selesaikan oleh qc release */
                                
                            } 
                            else if($progress_status_30 == '1' && $progress_status_55 == '0')
                            {
                                /* ini untuk update status analisa mikro di palet berdasarkan analisa mikro suhu 30 aja .. karena analisa suhu 55 hanya sebagai monitoring tidak berpengaruh pada produk release nya. tapi tetap nanti di rpr akan di tampilkan berdasarkan suhunya . */
                                foreach ($array_hasil_analisa_mikro as $hasil_analisa_mikro) 
                                {
                                    if ($hasil_analisa_mikro['suhu_preinkubasi'] == '30') 
                                    {
                                        $cppDetails     = CppDetail::where('cpp_head_id',$analisaMikro->cppHead->id)->where('filling_machine_id',$hasil_analisa_mikro['filling_machine_id'])->get();
                                        foreach ($cppDetails as $cppDetail) 
                                        {
                                            $palet  = $cppDetail->palets->where('start','<=',$hasil_analisa_mikro['jam_filling'])->where('end','>=',$hasil_analisa_mikro['jam_filling'])->first();
                                            if ( is_null($palet) )
                                            {
                                                /* ini akan mengambil palet pertama ketika jam filling di rpd filling tidak sesuai dengan yang ada di jam palet */
                                                $palet  = $cppDetail->palets->where('start','>=',$hasil_analisa_mikro['jam_filling'])->where('end','>=',$hasil_analisa_mikro['jam_filling'])->first();
                                                if (is_null($palet)) 
                                                {
                                                    $palet  = $cppDetail->palets->where('start','<=',$hasil_analisa_mikro['jam_filling'])->where('end','<=',$hasil_analisa_mikro['jam_filling'])->last();
                                                }
                                            }
                                            if ($palet->analisa_mikro_status !== '0') 
                                            {
                                                $palet->analisa_mikro_status    = $hasil_analisa_mikro['status_akhir'];
                                            }
                                            $palet->save();
                                        }
                                    }
                                }
                                /* ini untuk update status analisa 30 doang 55 nya masih di pending */
                                $list_ppq       = array();
                                foreach ($detailPpq as $ppq) 
                                {
                                    if ($ppq['suhu_preinkubasi'] == '30') 
                                    {
                                        array_push($list_ppq,$ppq);
                                    }
                                }
                                if (count($list_ppq) >  0) 
                                {
                                    /* jika ada analisa yang 30 yang tidak OK maka dia akan masuk untuk input PPQ */
                                    $nomor_ppq          = $this->getNomorPpq();
                                    $cpp_head_id        = $analisaMikro->cppHead->id;
                                    $kategori_ppq_id    = '24';
                                    $ppq_date           = date('Y-m-d');
                                    $jam_filling_awal   = $list_ppq[0]['jam_filling'];
                                    $jam_filling_akhir  = end($list_ppq)['jam_filling'];
                                    $keterangan_analisa_mikro   = 'Analisa Mikro 30 - ';/* ini untuk alasan  */
                                    $alasan             = ''; /* ini untuk detail titik ketidak sesuaian */
                                    $detail_titik_ppq   = '';
                                    foreach ($list_ppq as $ppq) 
                                    {
                                        if (strpos($detail_titik_ppq,$ppq['jam_filling'].', ') === false) 
                                        {
                                            $detail_titik_ppq .= $ppq['jam_filling'].', ';
                                        }
                                        if (strpos($ppq['keterangan_analisa_mikro'],'pH') !== false) 
                                        {
                                            if (strpos($keterangan_analisa_mikro,'pH #OK') === false) 
                                            {
                                                $keterangan_analisa_mikro .= 'pH #OK ';
                                            }

                                            if (strpos($alasan,$ppq['keterangan_analisa_mikro'].' 14&#13;&#10;') === false) 
                                            {
                                                $alasan .= $ppq['keterangan_analisa_mikro'].' 14&#13;&#10;';
                                            }
                                            
                                        }
                                        if (strpos($ppq['keterangan_analisa_mikro'],'TPC') !== false) 
                                        {
                                            if (strpos($keterangan_analisa_mikro,'TPC #OK') === false) 
                                            {
                                                $keterangan_analisa_mikro .= 'TPC #OK ';
                                            }
                                            if (strpos($alasan,$ppq['keterangan_analisa_mikro'].' 14&#13;&#10;') === false) 
                                            {
                                                $alasan .= $ppq['keterangan_analisa_mikro'].' 14&#13;&#10;';
                                            }
                                            
                                        }
                                        
                                        if (strpos($ppq['keterangan_analisa_mikro'],'Yeast') !== false) 
                                        {
                                            if (strpos($keterangan_analisa_mikro,'Yeast #OK') === false) 
                                            {
                                                $keterangan_analisa_mikro .= 'Yeast #OK ';
                                            }
                                            if (strpos($alasan,$ppq['keterangan_analisa_mikro'].' 14&#13;&#10;') === false) 
                                            {
                                                $alasan .= $ppq['keterangan_analisa_mikro'].' 14&#13;&#10;';
                                            }
                                            
                                        }

                                        
                                        if (strpos($ppq['keterangan_analisa_mikro'],'Mold') !== false) 
                                        {
                                            if (strpos($keterangan_analisa_mikro,'Mold #OK') === false) 
                                            {
                                                $keterangan_analisa_mikro .= 'Mold #OK ';
                                            }
                                            if (strpos($alasan,$ppq['keterangan_analisa_mikro'].' 14&#13;&#10;') === false) 
                                            {
                                                $alasan .= $ppq['keterangan_analisa_mikro'].' 14&#13;&#10;';
                                            }
                                        }
                                    }
                                    $detail_titik_ppq   = rtrim($detail_titik_ppq,', ');
                                    // dd($list_ppq);
                                    $ppq                = Ppq::create([
                                        'nomor_ppq'         => $nomor_ppq,
                                        'ppq_date'          => $ppq_date,
                                        'kategori_ppq_id'   => $kategori_ppq_id,
                                        'cpp_head_id'       => $cpp_head_id,
                                        'jam_awal_ppq'      => $jam_filling_awal,
                                        'jam_akhir_ppq'     => $jam_filling_akhir,
                                        'alasan'            => $keterangan_analisa_mikro,
                                        'detail_titik_ppq'  => $alasan,
                                        'status_akhir'      => '0'
                                    ]);
                                    $jumlah_pack    = 0;
                                    $palet_ppq      = array();
                                    foreach ($list_ppq as $get_palet) 
                                    {
                                        $cppDetails     = CppDetail::where('cpp_head_id',$cpp_head_id)->where('filling_machine_id',$get_palet['filling_machine_id'])->get();
                                        foreach ($cppDetails as $cppDetail) 
                                        {
                                            $palet  = $cppDetail->palets->where('start','<=',$get_palet['jam_filling'])->where('end','>=',$get_palet['jam_filling'])->first();
                                            if ( is_null($palet) )
                                            {
                                                /* ini akan mengambil palet pertama ketika jam filling di rpd filling tidak sesuai dengan yang ada di jam palet */
                                                $palet  = $cppDetail->palets->where('start','>=',$get_palet['jam_filling'])->where('end','>=',$get_palet['jam_filling'])->first();
                                            }
                                            $jumlah_pack    = $jumlah_pack+=$palet->jumlah_pack;
                                            $palet_ppq      = PaletPpq::Create([
                                                'ppq_id' => $ppq->id,
                                                'palet_id' => $palet->id
                                            ]);
                                            $palet->analisa_mikro_status    = '0';
                                            $palet->save();

                                        }
                                        $mikroDetail            = analisaMikroDetail::find($get_palet['analisa_mikro_detail_id']);
                                        $mikroDetail->ppq_id    = $ppq->id;
                                        $mikroDetail->save();
                                    }
                                    $ppq->jumlah_pack                   = $jumlah_pack;
                                    $ppq->save();
                                    $analisaMikro->progress_status_30   = '2';
                                    $analisaMikro->save();
                                    return redirect(url('/rollie/analisa-mikro-release/form-ppq/'.$this->encrypt($ppq->id).'/'.$this->encrypt('null') ))->with('info','Analisa Mikro 30 #OK, anda akan dialihkan secara otomatis oleh sistem untuk membuat PPQ Guna Kebutuhan Resampling');
                                } 
                                else 
                                {
                                    $analisaMikro->progress_status_30       = '2';
                                    $analisaMikro->save();
                                }
                                
                            }
                            else if($progress_status_30 == '0' && $progress_status_55 == '0')
                            {

                            }
                            
                            

                        }
                        
                    } 
                    else
                    {
                        foreach ($array_hasil_analisa_mikro as $hasil_analisa_mikro) 
                        {
                            if ($hasil_analisa_mikro['suhu_preinkubasi'] == '30') 
                            {
                                $cppDetails     = CppDetail::where('cpp_head_id',$analisaMikro->cppHead->id)->where('filling_machine_id',$hasil_analisa_mikro['filling_machine_id'])->get();
                                foreach ($cppDetails as $cppDetail) 
                                {
                                    $palet  = $cppDetail->palets->where('start','<=',$hasil_analisa_mikro['jam_filling'])->where('end','>=',$hasil_analisa_mikro['jam_filling'])->first();
                                    if ( is_null($palet) )
                                    {
                                        /* ini akan mengambil palet pertama ketika jam filling di rpd filling tidak sesuai dengan yang ada di jam palet */
                                        $palet  = $cppDetail->palets->where('start','>=',$hasil_analisa_mikro['jam_filling'])->where('end','>=',$hasil_analisa_mikro['jam_filling'])->first();
                                        if (is_null($palet)) 
                                        {
                                            $palet  = $cppDetail->palets->where('start','<=',$hasil_analisa_mikro['jam_filling'])->where('end','<=',$hasil_analisa_mikro['jam_filling'])->last();
                                        }
                                    }
                                    if ($palet->analisa_mikro_status !== '0') 
                                    {
                                        $palet->analisa_mikro_status    = $hasil_analisa_mikro['status_akhir'];
                                    }
                                    $palet->save();
                                }
                            }
                        }
                        /* ini untuk update status analisa 30 doang 55 nya masih di pending */
                        $list_ppq       = array();
                        foreach ($detailPpq as $ppq) 
                        {
                            if ($ppq['suhu_preinkubasi'] == '30') 
                            {
                                array_push($list_ppq,$ppq);
                            }
                        }
                        if (count($list_ppq) >  0) 
                        {
                            /* jika ada analisa yang 30 yang tidak OK maka dia akan masuk untuk input PPQ */
                            $nomor_ppq          = $this->getNomorPpq();
                            $cpp_head_id        = $analisaMikro->cppHead->id;
                            $kategori_ppq_id    = '24';
                            $ppq_date           = date('Y-m-d');
                            $jam_filling_awal   = $list_ppq[0]['jam_filling'];
                            $jam_filling_akhir  = end($list_ppq)['jam_filling'];
                            $keterangan_analisa_mikro   = 'Analisa Mikro 30 - ';/* ini untuk alasan  */
                            $alasan             = ''; /* ini untuk detail titik ketidak sesuaian */
                            $detail_titik_ppq   = '';
                            foreach ($list_ppq as $ppq) 
                            {
                                if (strpos($detail_titik_ppq,$ppq['jam_filling'].', ') === false) 
                                {
                                    $detail_titik_ppq .= $ppq['jam_filling'].', ';
                                }
                                if (strpos($ppq['keterangan_analisa_mikro'],'pH') !== false) 
                                {
                                    if (strpos($keterangan_analisa_mikro,'pH #OK') === false) 
                                    {
                                        $keterangan_analisa_mikro .= 'pH #OK ';
                                    }

                                    if (strpos($alasan,$ppq['keterangan_analisa_mikro'].' 14&#13;&#10;') === false) 
                                    {
                                        $alasan .= $ppq['keterangan_analisa_mikro'].' 14&#13;&#10;';
                                    }
                                    
                                }
                                if (strpos($ppq['keterangan_analisa_mikro'],'TPC') !== false) 
                                {
                                    if (strpos($keterangan_analisa_mikro,'TPC #OK') === false) 
                                    {
                                        $keterangan_analisa_mikro .= 'TPC #OK ';
                                    }
                                    if (strpos($alasan,$ppq['keterangan_analisa_mikro'].' 14&#13;&#10;') === false) 
                                    {
                                        $alasan .= $ppq['keterangan_analisa_mikro'].' 14&#13;&#10;';
                                    }
                                    
                                }
                                
                                if (strpos($ppq['keterangan_analisa_mikro'],'Yeast') !== false) 
                                {
                                    if (strpos($keterangan_analisa_mikro,'Yeast #OK') === false) 
                                    {
                                        $keterangan_analisa_mikro .= 'Yeast #OK ';
                                    }
                                    if (strpos($alasan,$ppq['keterangan_analisa_mikro'].' 14&#13;&#10;') === false) 
                                    {
                                        $alasan .= $ppq['keterangan_analisa_mikro'].' 14&#13;&#10;';
                                    }
                                    
                                }

                                
                                if (strpos($ppq['keterangan_analisa_mikro'],'Mold') !== false) 
                                {
                                    if (strpos($keterangan_analisa_mikro,'Mold #OK') === false) 
                                    {
                                        $keterangan_analisa_mikro .= 'Mold #OK ';
                                    }
                                    if (strpos($alasan,$ppq['keterangan_analisa_mikro'].' 14&#13;&#10;') === false) 
                                    {
                                        $alasan .= $ppq['keterangan_analisa_mikro'].' 14&#13;&#10;';
                                    }
                                }
                            }
                            $detail_titik_ppq   = rtrim($detail_titik_ppq,', ');
                            // dd($list_ppq);
                            $ppq                = Ppq::create([
                                'nomor_ppq'         => $nomor_ppq,
                                'ppq_date'          => $ppq_date,
                                'kategori_ppq_id'   => $kategori_ppq_id,
                                'cpp_head_id'       => $cpp_head_id,
                                'jam_awal_ppq'      => $jam_filling_awal,
                                'jam_akhir_ppq'     => $jam_filling_akhir,
                                'alasan'            => $keterangan_analisa_mikro,
                                'detail_titik_ppq'  => $alasan,
                                'status_akhir'      => '0'
                            ]);
                            $jumlah_pack    = 0;
                            $palet_ppq      = array();
                            foreach ($list_ppq as $get_palet) 
                            {
                                $cppDetails     = CppDetail::where('cpp_head_id',$cpp_head_id)->where('filling_machine_id',$get_palet['filling_machine_id'])->get();
                                foreach ($cppDetails as $cppDetail) 
                                {
                                    $palet  = $cppDetail->palets->where('start','<=',$get_palet['jam_filling'])->where('end','>=',$get_palet['jam_filling'])->first();
                                    if ( is_null($palet) )
                                    {
                                        /* ini akan mengambil palet pertama ketika jam filling di rpd filling tidak sesuai dengan yang ada di jam palet */
                                        $palet  = $cppDetail->palets->where('start','>=',$get_palet['jam_filling'])->where('end','>=',$get_palet['jam_filling'])->first();
                                    }
                                    $jumlah_pack    = $jumlah_pack+=$palet->jumlah_pack;
                                    $palet_ppq      = PaletPpq::Create([
                                        'ppq_id' => $ppq->id,
                                        'palet_id' => $palet->id
                                    ]);
                                    $palet->analisa_mikro_status    = '0';
                                    $palet->save();

                                }
                                $mikroDetail            = analisaMikroDetail::find($get_palet['analisa_mikro_detail_id']);
                                $mikroDetail->ppq_id    = $ppq->id;
                                $mikroDetail->save();
                            }
                            $ppq->jumlah_pack                   = $jumlah_pack;
                            $ppq->save();
                            $analisaMikro->progress_status_30   = '2';
                            $analisaMikro->save();
                            return redirect(url('/rollie/analisa-mikro-release/form-ppq/'.$this->encrypt($ppq->id).'/'.$this->encrypt('null') ))->with('info','Analisa Mikro 30 #OK, anda akan dialihkan secara otomatis oleh sistem untuk membuat PPQ Guna Kebutuhan Resampling');
                        } 
                        else 
                        {
                            $analisaMikro->progress_status_30       = '2';
                            $analisaMikro->save();
                        }
                    }
                    
                }
            }
        } 
        else 
        {
           return redirect(route('rollie.analysis_data.'.str_replace('-','_',$url)))->with('error',$cekAkses['message']);
        }
    }

    public function ubahJamFillingSampel(Request $request)
    {   
        $url        = explode('/',\Request::getRequestUri());
        $url        = $url[2];
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'rollie.analysis_data.'.str_replace('-','_',$url));
        if ($cekAkses['success']) 
        {
            $analisa_mikro_id   = $this->decrypt($request->analisa_mikro_id);
            $analisaMikroDetail = AnalisaMikroDetail::find($analisa_mikro_id);
            $analisaMikroDetail->jam_filling = $request->jam_filling_mikro;
            $analisaMikroDetail->save();
            return ['success' => true, 'message' => 'Jam filling sampel '.$analisaMikroDetail->kode_sampel.' pada mesin '.$analisaMikroDetail->fillingMachine->filling_machine_name.' telah berhasil diubah'];
        } 
        else 
        {
            return $cekAkses;
        }
        
    }

    public function getFillingSampelCode($filling_machine_id,$product_type_id)
    {
        $filling_machine_id         = $this->decrypt($filling_machine_id);
        $product_type_id            = $this->decrypt($product_type_id);
        $kode_sampel                = FillingSampelCode::where('product_type_id',$product_type_id)->where('filling_machine_id',$filling_machine_id)->get();
        $kode_sampel                = $this->encryptId($kode_sampel,'product_type_id','filling_machine_id');
        return $kode_sampel;
    
    }

    public function addMikroSample(Request $request)
    {
        $url        = explode('/',\Request::getRequestUri());
        $url        = $url[2];
        $cekAkses   = $this->checkAksesTambah(\Request::getRequestUri(),'rollie.analysis_data.'.str_replace('-','_',$url));
        if ($cekAkses['success']) 
        {
            $analisa_mikro_id       = $this->decrypt($request->analisa_mikro_id);
            $filling_machine_id     = $this->decrypt($request->filling_machine_id);
            $filling_sampel_code_id = $this->decrypt($request->filling_sampel_code_id);
            $jam_filling_sampel     = $request->jam_filling_sampel;
            $analisaMikro           = AnalisaMikro::find($analisa_mikro_id);
            $fillingMachine         = FillingMachine::find($filling_machine_id);
            $fillingSampelCode      = FillingSampelCode::find($filling_sampel_code_id);
            $analisaMikroDetails    = $analisaMikro->analisaMikroDetails->where('filling_machine_id',$filling_machine_id)->where('jam_filling', '>=',$jam_filling_sampel)->where('suhu_preinkubasi','30');
            $loop                   = 0;
            if (strpos($fillingSampelCode->filling_sampel_code,'R') !== false) 
            {
                /*  ini apabila sampel yang ditambah adalah sampel R */
                foreach ($analisaMikroDetails as $analisaMikroDetail) 
                {
                    if(strpos($analisaMikroDetail->kode_sampel,'R') !== false)
                    {
                        if ($loop == 0)
                        {
                            foreach ($analisaMikro->cppHead->cppDetails->where('filling_machine_id',$filling_machine_id) as $cppDetail) 
                            {
                                $palet      = $cppDetail->palets->where('start','<=',$jam_filling_sampel)->where('end', '>=', $jam_filling_sampel)->first();
                                if (!is_null($palet)) 
                                {
                                    $insertPi       = RpdFillingDetailPi::create([
                                        'rpd_filling_head_id'           => $palet->cppDetail->woNumber->rpdFillingHead->id,
                                        'wo_number_id'                  => $palet->cppDetail->woNumber->id,
                                        'filling_date'                  => explode(' ',$jam_filling_sampel)[0],
                                        'filling_time'                  => explode(' ',$jam_filling_sampel)[1],
                                        'filling_machine_id'            => $filling_machine_id,
                                        'filling_sampel_code_id'        => $filling_sampel_code_id,
                                        'berat_kanan'                   => '000',
                                        'berat_kiri'                    => '000'
                                    ]);
                                }
                            }
                            preg_match("/([0-9]+)/", $analisaMikroDetail->kode_sampel, $matches);
                            $loop   = $matches[0];
                            AnalisaMikroDetail::create([
                                'analisa_mikro_id'         => $analisaMikro->id,
                                'kode_sampel'              => $fillingSampelCode->filling_sampel_code.$loop,
                                'jam_filling'              => $jam_filling_sampel,
                                'filling_machine_id'       => $fillingMachine->id, 
                                'suhu_preinkubasi'         => '30', 
                                'status'                   => '0',
                            ]);
                            $loop++;
                            AnalisaMikroDetail::create([
                                'analisa_mikro_id'         => $analisaMikro->id,
                                'kode_sampel'              => $fillingSampelCode->filling_sampel_code.$loop,
                                'jam_filling'              => $jam_filling_sampel,
                                'filling_machine_id'       => $fillingMachine->id, 
                                'suhu_preinkubasi'         => '30', 
                                'status'                   => '0',
                            ]);
                            $loop++;
                            $analisaMikroDetailPcs                  = AnalisaMikroDetail::find($analisaMikroDetail->id);
                            $analisaMikroDetail->kode_sampel        = preg_replace('/[0-9]+/', null, $analisaMikroDetail->kode_sampel);
                            $analisaMikroDetailPcs->kode_sampel     = $analisaMikroDetail->kode_sampel.$loop;
                            $analisaMikroDetailPcs->save();
                            $loop++;
                        } 
                        else 
                        {
                            $analisaMikroDetailPcs                  = AnalisaMikroDetail::find($analisaMikroDetail->id);
                            $analisaMikroDetail->kode_sampel        = preg_replace('/[0-9]+/', null, $analisaMikroDetail->kode_sampel);
                            $analisaMikroDetailPcs->kode_sampel     = $analisaMikroDetail->kode_sampel.$loop;
                            $analisaMikroDetailPcs->save();
                            $loop++;
                        }
                        
                    }
                }
            } 
            else if(strpos($fillingSampelCode->filling_sampel_code,'R') === false) 
            {
                /* ini apabila sampel yang ditambah adalah sampel bukan R */
                foreach ($analisaMikroDetails as $analisaMikroDetail) 
                {
                    if(strpos($analisaMikroDetail->kode_sampel,'R') === false)
                    {
                        if ($loop == 0)
                        {
                            // dd($analisaMikro->cppHead->cppDetails->where('filling_machine_id',$filling_machine_id));
                            foreach ($analisaMikro->cppHead->cppDetails->where('filling_machine_id',$filling_machine_id) as $cppDetail) 
                            {
                                $palet      = $cppDetail->palets->where('start','<=',$jam_filling_sampel)->where('end', '>=', $jam_filling_sampel)->first();
                                if (!is_null($palet)) 
                                {
                                    $insertPi       = RpdFillingDetailPi::create([
                                        'rpd_filling_head_id'           => $palet->cppDetail->woNumber->rpdFillingHead->id,
                                        'wo_number_id'                  => $palet->cppDetail->woNumber->id,
                                        'filling_date'                  => explode(' ',$jam_filling_sampel)[0],
                                        'filling_time'                  => explode(' ',$jam_filling_sampel)[1],
                                        'filling_machine_id'            => $filling_machine_id,
                                        'filling_sampel_code_id'        => $filling_sampel_code_id,
                                        'berat_kanan'                   => '000',
                                        'berat_kiri'                    => '000'
                                    ]);
                                }
                            }
                            preg_match("/([0-9]+)/", $analisaMikroDetail->kode_sampel, $matches);
                            $loop   = $matches[0];
                            AnalisaMikroDetail::create([
                                'analisa_mikro_id'         => $analisaMikro->id,
                                'kode_sampel'              => $fillingSampelCode->filling_sampel_code.$loop,
                                'jam_filling'              => $jam_filling_sampel,
                                'filling_machine_id'       => $fillingMachine->id, 
                                'suhu_preinkubasi'         => '30', 
                                'status'                   => '0',
                            ]);
                            $loop++;
                            AnalisaMikroDetail::create([
                                'analisa_mikro_id'         => $analisaMikro->id,
                                'kode_sampel'              => $fillingSampelCode->filling_sampel_code.$loop,
                                'jam_filling'              => $jam_filling_sampel,
                                'filling_machine_id'       => $fillingMachine->id, 
                                'suhu_preinkubasi'         => '30', 
                                'status'                   => '0',
                            ]);
                            $loop++;
                            $analisaMikroDetailPcs                  = AnalisaMikroDetail::find($analisaMikroDetail->id);
                            $analisaMikroDetail->kode_sampel        = preg_replace('/[0-9]+/', null, $analisaMikroDetail->kode_sampel);
                            $analisaMikroDetailPcs->kode_sampel     = $analisaMikroDetail->kode_sampel.$loop;
                            $analisaMikroDetailPcs->save();
                            $loop++;
                        } 
                        else 
                        {
                            $analisaMikroDetailPcs                  = AnalisaMikroDetail::find($analisaMikroDetail->id);
                            $analisaMikroDetail->kode_sampel        = preg_replace('/[0-9]+/', null, $analisaMikroDetail->kode_sampel);
                            $analisaMikroDetailPcs->kode_sampel     = $analisaMikroDetail->kode_sampel.$loop;
                            $analisaMikroDetailPcs->save();
                            $loop++;
                        }
                        
                    }
                }
            }
            return redirect('/rollie/analisa-ph-produk/form/'.$this->encrypt($analisaMikro->id))->with('success','Sampel analisa berhasil ditambahkan .');            
        } 
        else 
        {
            return redirect(route('rollie.analysis_data.'.str_replace('-','_',$url)))->with('error',$cekAkses['message']);
        }
        
    }

    public function prosesPpqMikro(Request $request)
    {
        $ppq_id                 = $this->decrypt($request->ppq_id);

        $alasan_ppq             = $request->alasan_ppq;
        $detail_titik_ppq       = str_replace('<br />','14&#13;&#10;',nl2br($request->detail_titik_ppq));
        $detail_titik_ppq       .= '14&#13;&#10;';
        $kategori_ppq_id        = $this->decrypt($request->kategori_ppq_id);
        $jumlah_pack            = $request->jumlah_pack;

        $ppq                    = Ppq::find($ppq_id);
        $ppq->alasan            = $alasan_ppq;
        $ppq->detail_titik_ppq  = $detail_titik_ppq;
        $ppq->kategori_ppq_id   = $kategori_ppq_id;
        $ppq->jumlah_pack       = $jumlah_pack;
        $ppq->status_akhir      = '1';
        $ppq->save();   

        /* disini bakal langsung ngebuat analisa resampling untuk  */
        $analisaResampling      = AnalisaMikroResampling::create([
            'analisa_mikro_id'  => $ppq->analisaMikroDetails[0]->analisaMikroHead->id,
            'ppq_id'            => $ppq->id,
            'tanggal_analisa'   => date('Y-m-d'),
            'progress_status'   => '0',
            'suhu_preinkubasi'  => $ppq->analisaMikroDetails[0]->suhu_preinkubasi
        ]);
        
        /*  */
        $distributionLists          = DistributionList::where('ppq_mail_to','1')->get();
        $user_to            = array();
        
        foreach ($distributionLists as $distributionList) 
        {
            array_push($user_to, $distributionList->employee->email);
        }
        
        $distributionLists          = DistributionList::where('ppq_mail_cc','1')->get();
        $user_cc            = array();
        foreach ($distributionLists as $distributionList) 
        {
            array_push($user_cc, $distributionList->employee->email);
        }

        Mail::to($user_to)->cc($user_cc)->bcc('nesta.maulana@nutrifood.co.id')->send(new NewPpqMail($ppq));

        return ['success'=>true,'message'=>'Na Na Na Na '];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\production_data\AnalisaMikro  $analisaMikro
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnalisaMikro $analisaMikro)
    {
        //
    }
}
