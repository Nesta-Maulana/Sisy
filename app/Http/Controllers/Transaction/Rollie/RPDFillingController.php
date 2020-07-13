<?php

namespace App\Http\Controllers\Transaction\Rollie;

use App\Http\Controllers\ResourceController;

use App\Models\Master\Product;
use App\Models\Master\FillingMachine;
use App\Models\Master\FillingSampelCode;
use App\Models\Master\FillingMachineGroupHead;
use App\Models\Master\FillingMachineGroupDetail;

use App\Exports\Rollie\ReportRpdFilling;

use App\Models\Transaction\Rollie\WoNumber;
use App\Models\Transaction\Rollie\RpdFillingHead;
use App\Models\Transaction\Rollie\RpdFillingDetailPi;
use App\Models\Transaction\Rollie\RpdFillingDetailAtEvent;

use App\Models\Transaction\Rollie\CppHead;
use App\Models\Transaction\Rollie\CppDetail;
use App\Models\Transaction\Rollie\Palet;
use App\Models\Transaction\Rollie\PaletPpq;
use App\Models\Transaction\Rollie\Ppq;
use App\Models\Transaction\Rollie\Psr;

use Illuminate\Http\Request;
use Excel;
use Auth;
use Session;
use DB;
class RPDFillingController extends ResourceController
{

    public function prosesRpdFilling(Request $request)
    {
        $cekAkses       = $this->checkAksesUbah(\Request::getRequestUri(),'rollie.process_data.rpds');
        if ($cekAkses['success']) 
        {
            
            $wo_number                  = WoNumber::find($this->decrypt($request->wo_number_id));
            $start_filling              = date('Y-m-d');
            $active_rpd                 = RpdFillingHead::where('rpd_status','0')->get();
            if (count($active_rpd) > 0) 
            {
                $aksestambah            = 0;        
                $aksesduplik            = 0;
                $product_id                 = $wo_number->product->id;

                foreach ($active_rpd as $rpd_active) 
                {
                    if ($rpd_active->product->filling_machine_group_head_id == $wo_number->product->filling_machine_group_head_id && 
                    $rpd_active->product_id !== $product_id) 
                    {
                        return ['success'=>false,'message'=>'Harap Selesaikan Proses RPD Filling '.$rpd_active->product->fillingMachineGroupHead->filling_machine_group_name.' yang sedang akif terlebih dahulu'];
                    }
                    else if($rpd_active->product->filling_machine_group_head_id == $wo_number->product->filling_machine_group_head_id && $rpd_active->product_id == $product_id) 
                    {
                        $rpd_product     = $rpd_active;
                        $aksesduplik++;
                    }
                    else if($rpd_active->product->filling_machine_group_head_id !== $wo_number->product->filling_machine_group_head_id && count($active_rpd) == 1)
                    {
                        $aksestambah++;
                    }
                }
                if ($aksestambah == 0 && $aksesduplik == 0) 
                {
                    return ['success'=>false,'message'=>'Harap selesaikan proses salah satu RPD Filling terlebih dahulu'];
                }
                
                else if($aksestambah > 0)
                {
                    //insert ke head table rpd filling
                    $rpdFillingHead   = RpdFillingHead::create([
                                            'product_id'            => $wo_number->product->id,
                                            'start_filling_date'    => $start_filling,
                                            'rpd_status'            => '0'    
                                        ]);
                    
                    /*  update status wo nya jadi on progress fillpack dan tanggal fillingnya juga sesuai hari ini */
                    $wo_number->wo_status                   = '3';
                    $wo_number->rpd_filling_head_id         = $rpdFillingHead->id;
                    $wo_number->fillpack_date               = $start_filling;
                    $wo_number->save();
                    $cekAkses['rpd_filling_head_id'] = $this->encrypt($rpdFillingHead->id);
                    return $cekAkses;  
                }
                else if($aksesduplik > 0)
                {
                    $wo_number->wo_status                   = '3';
                    $wo_number->rpd_filling_head_id         = $rpd_product->id;
                    $wo_number->fillpack_date               = $start_filling;
                    $wo_number->save();
                    $cekAkses['rpd_filling_head_id'] = $this->encrypt($rpd_product->id);
                    return $cekAkses;     
                }
            }
            else
            {
                /* input data ke rpd filling table nya */
                $rpdFillingHead   = RpdFillingHead::create([
                    'product_id'                => $wo_number->product->id,
                    'start_filling_date'        => $start_filling,
                    'rpd_status'                => '0'    
                ]);
                /*  update status wo nya jadi on progress fillpack dan tanggal fillingnya juga sesuai hari ini */
                $wo_number->wo_status                   = '3';
                $wo_number->rpd_filling_head_id         = $rpdFillingHead->id;
                $wo_number->fillpack_date               = $start_filling;
                $wo_number->save();
                $cekAkses['rpd_filling_head_id'] = $this->encrypt($rpdFillingHead->id);
                return $cekAkses;   
            }
        } 
        else 
        {
            return $cekAkses;
        } 
    }
    public function getFillingSampel($filling_machine_id, $rpd_filling_head_id)
    {
        $filling_machine_id         = $this->decrypt($filling_machine_id);
        $rpd_filling_head_id        = $this->decrypt($rpd_filling_head_id);
        $rpd_filling                = RpdFillingHead::find($rpd_filling_head_id);
        $product_type               = $rpd_filling->product->productType->id;

        $kode_sampel                = FillingSampelCode::where('product_type_id',$product_type)->where('filling_machine_id',$filling_machine_id)->get();
        $kode_sampel                = $this->encryptId($kode_sampel,'product_type_id','filling_machine_id');
        return $kode_sampel;
    }

    public function getWoFilling($jenis_tambah,$rpd_filling_head_id)
    {
        $rpdFillingHead     = RpdFillingHead::find($this->decrypt($rpd_filling_head_id));
        if ($jenis_tambah == '1') 
        {   
            $activeRpd      = RpdFillingHead::where('rpd_status','0')->get();
            if (count($activeRpd) > 1) 
            {
                return ['success'=>false,'message'=>'2 RPD Filling Dengan Mesin Berbeda Sudah Aktif . Harap Selesaikan Proses Filling Terlebih Dahulu'];
            }
            else
            {
                /*ini untuk penambahan WO beda mesin*/
                $woNumbers      = WoNumber::where('wo_status','2')->whereNotIn('product_id',['30','31','32'])->get();
                $arraywo    = array();
                foreach ($woNumbers as $key => $woNumber) 
                {
                    if ($woNumber->product->fillingMachineGroupHead->filling_machine_group_name !== $activeRpd[0]->woNumbers[0]->product->fillingMachineGroupHead->filling_machine_group_name) 
                    {
                        $woNumber->encrypt_id   = $this->encrypt($woNumber->id);
                        unset($woNumber->id);
                        array_push($arraywo, $woNumber);
                    }
                }

                if (count($arraywo) > 0) 
                {
                    return ['success'=>true,'data'=>$arraywo];
                }
                else
                {
                    return ['success'=>false,'message'=>'Tidak Ada Batch Di Mesin Filling Lain Yang Siap Filling'];
                }
            }
        }
        else if($jenis_tambah =='2')
        {
            
            $produk_id          = $rpdFillingHead->woNumbers[0]->product_id;
            $rangesebelum       = date('Y-m-d', strtotime($rpdFillingHead->woNumbers[0]->production_realisation_date. '-2 days'));
            $rangesesudah       = date('Y-m-d', strtotime($rpdFillingHead->woNumbers[0]->production_realisation_date. '+2 days'));
            $woNumbers          = WoNumber::whereBetween('production_realisation_date',[$rangesebelum,$rangesesudah])->where('wo_status','2')->where('product_id',$produk_id)->get();
            if (count($woNumbers) > 0) 
            {
                foreach ($woNumbers as $woNumber) 
                {
                    $product        = $woNumber->product;
                    $woNumber       = $this->encryptId($woNumber,'product_id');
                }
                return ['success'=>true,'data'=>$woNumbers];

            }   
            else
            {
                return ['success'=>false,'message'=>'Tidak Ada Batch Lain Yang Siap Filling'];
            }

        }
    }
    public function addBatchProses(Request $request)
    {
        $cekAkses               = $this->CheckAksesTambah(\Request::getRequestUri(),'rollie.process_data.rpds');
        if ($cekAkses['success'] == true) 
        {
            $startfilling                   = date('Y-m-d');
            if ($request->jenis_tambah == '1') 
            {
                $woNumber                       = WoNumber::find($this->decrypt($request->nomor_wo_tambah));
                $product_id                     = $woNumber->product_id;
                $woNumber->wo_status            = '3';
                /*insert ke head table rpd filling*/
                $insertrpdfillinghead   = RpdFillingHead::create([
                                            'product_id'            => $product_id,
                                            'start_filling_date'    => $startfilling,
                                            'rpd_status'                =>'0'    
                                        ]);
                $woNumber->rpd_filling_head_id  = $insertrpdfillinghead->id;
                $woNumber->fillpack_date        = $startfilling;
                $woNumber->save();
                /*update data wo ubah status dan ubah tanggal fillpack sesuai dengan start filling hari ini.*/ 
                $return                     = $this->encrypt($insertrpdfillinghead->id);
                return redirect('/rollie/rpd-filling/form/'.$return);
            }
            else if ($request->jenis_tambah == '2') 
            {
                $rpd_filling_head_id            = $this->decrypt($request->rpd_filling_head_id);
                $woNumber                       = WoNumber::find($this->decrypt($request->nomor_wo_tambah));
                $woNumber->rpd_filling_head_id  = $rpd_filling_head_id;
                $woNumber->fillpack_date        = $startfilling;
                $woNumber->wo_status               = '3';
                $woNumber->save();
                return redirect('/rollie/rpd-filling/form/'.$request->rpd_filling_head_id);
            }
        } 
        else 
        {
            return redirect()->back()->with('error',$cekAkses['message']);
        }
    }
    public function checkFillingSampel($filling_sampel_id)
    {
        $filling_sampel    =   FillingSampelCode::find($this->decrypt($filling_sampel_id));
        return $this->encryptId($filling_sampel,'product_type_id','filling_machine_id');
    }
    public function addFillingSampel(Request $request)
    {
        $cekAkses               = $this->CheckAksesTambah(\Request::getRequestUri(),'rollie.process_data.rpds');
        if ($cekAkses['success'] == true) 
        {
            $wo_number_id               = $this->decrypt($request->wo_number_id);
            $filling_machine_id         = $this->decrypt($request->filling_machine_id);
            $filling_date               = $request->filling_date;
            $filling_time               = $request->filling_time;
            $filling_sampel_code_id     = $this->decrypt($request->filling_sampel_code_id);
            $keteranganevent            = $request->keteranganevent;
            $rpd_filling_head_id        = $this->decrypt($request->rpd_filling_head_id);
            $berat_kanan                = $request->berat_kanan;
            $berat_kiri                 = $request->berat_kiri;
            switch ($keteranganevent)
            {
                case '0':
                    // jika non event hanya PI aja 
                    $filling_machine            = FillingMachine::find($filling_machine_id);
                    $filling_sampel_code        = FillingSampelCode::find($filling_sampel_code_id);
                    if ($filling_sampel_code->pi < 1 && ($filling_machine->filling_machine_name == 'TBA' || $filling_machine->filling_machine_name == 'A3')) 
                    {
                        /*  jika iya maka analisa PInya akan otomatis terisi oleh ssistem by default */
                        $insertPi                       = RpdFillingDetailPi::create([
                            'rpd_filling_head_id'       => $rpd_filling_head_id,
                            'wo_number_id'              => $wo_number_id,
                            'filling_date'              => $filling_date,
                            'filling_time'              => $filling_time,
                            'filling_machine_id'        => $filling_machine_id,
                            'filling_sampel_code_id'    => $filling_sampel_code_id,
                            'berat_kanan'               => '000.00',
                            'berat_kiri'                => '000.00',
                            'airgap'                    => '-',
                            'ts_accurate_kanan'         => '-',
                            'ts_accurate_kiri'          => '-',
                            'ls_accurate'               => '-',
                            'sa_accurate'               => '-',
                            'surface_check'             => '-',
                            'pinching'                  => '-',
                            'strip_folding'             => '-',
                            'konduktivity_kanan'        => '-',
                            'konduktivity_kiri'         => '-',
                            'design_kanan'              => '-',
                            'design_kiri'               => '-',
                            'dye_test'                  => '-',
                            'residu_h2o2'               => '-',
                            'prod_code_and_no_md'       => '-',
                            'correction'                => '-',
                            'overlap'                   => '00.00',
                            'ls_sa_proportion'          => '-',
                            'volume_kanan'              => '0',
                            'volume_kiri'               => '0',
                            'status_akhir'              => 'OK'
                        ]);

                           
                    }
                    else
                    {
                        $insertPi       = RpdFillingDetailPi::create([
                            'rpd_filling_head_id'           => $rpd_filling_head_id,
                            'wo_number_id'                  => $wo_number_id,
                            'filling_date'                  => $filling_date,
                            'filling_time'                  => $filling_time,
                            'filling_machine_id'            => $filling_machine_id,
                            'filling_sampel_code_id'        => $filling_sampel_code_id,
                            'berat_kanan'                   => $berat_kanan,
                            'berat_kiri'                    => $berat_kiri
                        ]);
                    }
                    $cek        = $insertPi->rpdFillingHead->rpdFillingDetailPis->count();
                    if($cek > 2)
                    {
                        $reload     = false;
                    }
                    else
                    {
                        $reload     = true;
                    }
                    return [ 'success'=>true,'message'=>'Permintaan Analisa Berhasil Diinput','reload'=>$reload];
                break;
                case '1':
                    /*  jika event maka akan input ke at event dan pi */ 
                    $jam_event          = $filling_date.' '.$filling_time;
                    $palets             = DB::connection('transaction_data')->select("SELECT * FROM palets where '".$jam_event."' BETWEEN `start` AND `end`");
                    $cppDetails         = CppDetail::where('wo_number_id',$wo_number_id)->where('filling_machine_id',$filling_machine_id)->get();
                    $filling_sampel_code        = FillingSampelCode::find($filling_sampel_code_id);
                    $filling_machine    = FillingMachine::find($filling_machine_id);
                    /*  disini dilakukan pengecekan apakah sampel tsb adalah sampel F dan diambil dari Mesin filling TBA atau A3 bukan */
                    if ($filling_sampel_code->pi && ($filling_machine->filling_machine_name == 'TBA' || $filling_machine->filling_machine_name == 'A3') ) 
                    {
                        /*  jika iya maka analisa PInya akan otomatis terisi oleh ssistem by default */
                        $insertPi                       = RpdFillingDetailPi::create([
                            'rpd_filling_head_id'       => $rpd_filling_head_id,
                            'wo_number_id'              => $wo_number_id,
                            'filling_date'              => $filling_date,
                            'filling_time'              => $filling_time,
                            'filling_machine_id'        => $filling_machine_id,
                            'filling_sampel_code_id'    => $filling_sampel_code_id,
                            'berat_kanan'               => '000.00',
                            'berat_kiri'                => '000.00',
                            'airgap'                    => '-',
                            'ts_accurate_kanan'         => '-',
                            'ts_accurate_kiri'          => '-',
                            'ls_accurate'               => '-',
                            'sa_accurate'               => '-',
                            'surface_check'             => '-',
                            'pinching'                  => '-',
                            'strip_folding'             => '-',
                            'konduktivity_kanan'        => '-',
                            'konduktivity_kiri'         => '-',
                            'design_kanan'              => '-',
                            'design_kiri'               => '-',
                            'dye_test'                  => '-',
                            'residu_h2o2'               => '-',
                            'prod_code_and_no_md'       => '-',
                            'correction'                => '-',
                            'overlap'                   => '00.00',
                            'ls_sa_proportion'          => '-',
                            'volume_kanan'              => '0',
                            'volume_kiri'               => '0',
                            'status_akhir'              => 'OK'
                        ]);

                           
                    }
                    else 
                    {
                        /* jika tidak dia akan input sampel pi sebagai draft analisa */
                        $insertPi       = RpdFillingDetailPi::create([
                            'rpd_filling_head_id'       => $rpd_filling_head_id,
                            'wo_number_id'              => $wo_number_id,
                            'filling_date'             => $filling_date,
                            'filling_time'              => $filling_time,
                            'filling_machine_id'        => $filling_machine_id,
                            'filling_sampel_code_id'    => $filling_sampel_code_id,
                            'berat_kanan'               => $berat_kanan,
                            'berat_kiri'                => $berat_kiri
                        ]);
                    }
                    if (count($cppDetails) == 0)
                    {
                        /* apabila belum ada cpp yang di proses maka dia akan input event biasa*/
                        $insertEvent                    = RpdFillingDetailAtEvent::create([
                            'rpd_filling_head_id'       => $rpd_filling_head_id,
                            'wo_number_id'              => $wo_number_id,
                            'filling_date'              => $filling_date,
                            'filling_time'              => $filling_time,
                            'filling_machine_id'        => $filling_machine_id,
                            'filling_sampel_code_id'    => $filling_sampel_code_id,
                            // 'user_id_inputer'           => $user_id_inputer,
                            'palet_id'                  => '0'
                        ]);
                    }
                    else
                    {
                        $paletevent     = null;
                        /* apabila sudah ada cpp yang aktif maka dia akan mengecek apakah cpp tsbb sudah menghasilkan palet atau belum*/
                        if ($palets == [] || is_null($palets) || count($palets) == 0) 
                        {
                            /* jika palet dari cpp tersebut masih kosong a.k.a belum menghasilkan sebuah palet maka dia mengambil id dari cpp detail untuk kembali mengecek palet yang ada */
                            $cppDetailIdPalet  = array();
                            foreach ($cppDetails as  $cpp_detail_item) 
                            {
                                array_push($cppDetailIdPalet, $cpp_detail_item->id);
                            }
                            /* disini dia akan mengambil palet berdasar cpp detail id yang aktif dan dia akan mengecek jika jam akhir paletnya kosong dan jam event nya lebih dari jam palet start maka palet itu dinobatkan sebagai palet event */
                            $palets         = Palet::whereIn('cpp_detail_id',$cppDetailIdPalet)->get();
                            foreach ($palets as $palet) 
                            {
                                if (is_null($palet->end) &&   $jam_event >= $palet->start) 
                                {
                                    $paletevent = $palet;
                                }
                            }
                        } 
                        else 
                        {
                            foreach ($palets as $key => $palet) 
                            {
                                foreach ($cppDetails as $key => $cpp_detail_item) 
                                {
                                    if ($palet->cpp_detail_id == $cpp_detail_item->id) 
                                    {
                                        $paletevent     = $palet;
                                    }
                                }
                            }
                        }

                        if ($paletevent == null) 
                        {
                            $paletevent = '0';
                        } 
                        else 
                        {
                            $paletevent = $paletevent->id;
                        }
                        $insertEvent                    = RpdFillingDetailAtEvent::create([
                            'rpd_filling_head_id'       => $rpd_filling_head_id,
                            'wo_number_id'              => $wo_number_id,
                            'filling_date'              => $filling_date,
                            'filling_time'              => $filling_time,
                            'filling_machine_id'        => $filling_machine_id,
                            'filling_sampel_code_id'    => $filling_sampel_code_id,
                            // 'user_id_inputer'           => $user_id_inputer,
                            'palet_id'                  => $paletevent
                        ]);
                        
                    }
                    
                    return [ 'success'=>true,'message'=>'Permintaan Analisa Berhasil Diinput' ];
                break;
            }     
        }
        else 
        {
            return $cekAkses;
        } 
    }
    public function refreshTableSampel($rpd_filling_head_id)
    {
        $id                 = $this->decrypt($rpd_filling_head_id);
        $rpdFillingHead     = RpdFillingHead::find($id);


        $detailnya      = array(); 
        $detailok       = array();
        foreach ($rpdFillingHead->rpdFillingDetailPis as $key => $value) 
        {
           if (
            is_null($value->airgap) && is_null($value->ts_accurate_kanan) && is_null($value->ts_accurate_kiri) && is_null($value->ls_accurate) && is_null($value->sa_accurate) && is_null($value->surface_check) && is_null($value->pinching) && is_null($value->strip_fold) && is_null($value->konduktivity_kanan) && is_null($value->konduktivity_kiri) && is_null($value->design_kanan) && is_null($value->design_kiri) && is_null($value->dye_test) && is_null($value->residu_h2o2) && is_null($value->prod_code_no_md) && is_null($value->correction) ) 
           {
                $detail_pi_nya  = [
                'kode_sampel'           =>  $value->fillingSampelCode->filling_sampel_code,
                'event'                 =>  ucwords($value->fillingSampelCode->filling_sampel_event),
                'mesin_filling'         =>  $value->fillingMachine->filling_machine_code,
                'tanggal_filling'       =>  $value->filling_date,
                'jam_filling'           =>  $value->filling_time,
                // 'detail_id'             =>  $value->id,
                'detail_id_enkripsi'    =>  $this->encrypt($value->id),
                'nama_produk'           =>  $value->woNumber->product->product_name,
                'wo_id'                 =>  $this->encrypt($value->woNumber->id),
                'nomor_wo'              =>  $value->woNumber->wo_number,
                'order'                 =>  $value->filling_date.' '.$value->filling_time,
                'kodenya'               =>  'Bukan Event',
                'mesin_filling_id'      =>  $this->encrypt($value->fillingMachine->id)
                ];
                array_push($detailnya, $detail_pi_nya);
           }
           else
           {

                $detail_pi_ok  = [
                'kode_sampel'           => $value->fillingSampelCode->filling_sampel_code,
                'event'                 => ucwords($value->fillingSampelCode->filling_sampel_event),
                'mesin_filling'         => $value->fillingMachine->filling_machine_code,
                'tanggal_filling'       => $value->filling_date,
                'jam_filling'           => $value->filling_time,
                'detail_id'             => $value->id,
                'detail_id_enkripsi'    => $this->encrypt($value->id),
                'nama_produk'           => $value->woNumber->product->product_name,
                'wo_id'                 => $this->encrypt($value->woNumber->id),
                'nomor_wo'              => $value->woNumber->wo_number,
                'status_akhir'          => $value->status_akhir,
                'order'                 => $value->filling_date.' '.$value->filling_time,
                'kodenya'               => 'Bukan Event',
                'mesin_filling_id'      => $this->encrypt($value->fillingMachine->id)
                ];
                array_push($detailok, $detail_pi_ok);
           }
        }
        foreach ($rpdFillingHead->rpdFillingDetailAtEvents as $key => $value) 
        {
            if (is_null($value->ls_sa_sealing_quality) && is_null($value->ls_sa_proportion) && is_null($value->status_akhir)) 
            {
                $detail_pi_nya  = [
                'detail_id'             => $value->id,
                'detail_id_enkripsi'    => $this->encrypt($value->id),
                'nomor_wo'              => $value->woNumber->wo_number,
                'tanggal_filling'       => $value->filling_date,
                'jam_filling'           => $value->filling_time,
                'kode_sampel'           => $value->fillingSampelCode->filling_sampel_code.' (Event)',
                'kodenya'               => 'Event',
                'wo_id'                 => $this->encrypt($value->woNumber->id),
                'event'                 => $value->fillingSampelCode->filling_sampel_event,
                'order'                 => $value->filling_date.' '.$value->filling_time,
                'mesin_filling'         => $value->fillingMachine->filling_machine_code,
                'mesin_filling_id'      => $this->encrypt($value->fillingMachine->id)
                ];
                array_push($detailnya, $detail_pi_nya);
            } 
            else
            {
                $detail_pi_ok  = [
                'detail_id'             => $value->id,
                'detail_id_enkripsi'    => $this->encrypt($value->id),
                'nomor_wo'              => $value->woNumber->wo_number,
                'wo_id'                 => $this->encrypt($value->woNumber->id),
                'tanggal_filling'       => $value->filling_date,
                'jam_filling'           => $value->filling_time,
                'kode_sampel'           => $value->fillingSampelCode->filling_sampel_code.' (Event)',
                'kodenya'               => 'Event',
                'event'                 => $value->fillingSampelCode->filling_sampel_event,
                'order'                 => $value->filling_date.' '.$value->filling_time,
                'mesin_filling'         => $value->fillingMachine->filling_machine_code,
                'mesin_filling_id'      => $this->encrypt($value->fillingMachine->id),
                'status_akhir'         => $value->status_akhir
                ];
                array_push($detailok, $detail_pi_ok);
            }  
        }        
        unset($rpdFillingHead->rpdFillingDetailPis);
        unset($rpdFillingHead->rpdFillingDetailAtEvents);
        $detailnya  = $this->array_orderby($detailnya,'order',SORT_ASC);
        $detailok   = $this->array_orderby($detailok,'order',SORT_DESC);

        $rpdFillingHead->rpdFillingDetailPi_nya  = $detailnya;
        $rpdFillingHead->rpdFillingDetailPi_ok   =  $detailok;
        $rpdFillingHead->akses_ubah     =  Session::get('ubah');
        $rpdFillingHead->akses_hapus    =  Session::get('hapus');

        return $rpdFillingHead;
    }

    public function submitAnalisaSampelPi(Request $request)
    {
        $rpd_filling_detail_id_pi           = $this->decrypt($request->rpd_filling_detail_id_pi);
        $rpd_filling_detail_pi              = RpdFillingDetailPi::find($rpd_filling_detail_id_pi);
        $rpd_filling_head_id                = $this->decrypt($request->rpd_filling_head_id);
        $wo_number_id                       = $this->decrypt($request->wo_number_id);
        $filling_machine_id                 = $this->decrypt($request->filling_machine_id);
        $filling_machine                    = FillingMachine::find($filling_machine_id);
        $product_name                       = $request->nama_produk_analisa_pi;
        $ls_sa_proportion                   = $request->ls_sa_proportion;
        $volume_kanan                       = $request->volume_kanan;
        $volume_kiri                        = $request->volume_kiri;
        $overlap                            = $request->overlap;
        $airgap                             = $request->airgap;
        $ts_accurate_kanan                  = $request->ts_accurate_kanan;
        $ts_accurate_kiri                   = $request->ts_accurate_kiri;
        $ls_accurate                        = $request->ls_accurate;
        $sa_accurate                        = $request->sa_accurate;
        $surface_check                      = $request->surface_check;
        $pinching                           = $request->pinching;
        $strip_folding                      = $request->strip_folding;
        $konduktivity_kanan                 = $request->konduktivity_kanan;
        $konduktivity_kiri                  = $request->konduktivity_kiri;
        $design_kanan                       = $request->design_kanan;
        $design_kiri                        = $request->design_kiri;
        $dye_test                           = $request->dye_test;
        $residu_h2o2                        = $request->residu_h2o2;
        $prod_code_no_md                    = $request->prod_code_no_md;
        $correction                         = $request->correction;
        /* if #OK gais */
            $ts_accurate_kanan_tidak_ok         = $request->ts_accurate_kanan_tidak_ok;
            $ts_accurate_kiri_tidak_ok          = $request->ts_accurate_kiri_tidak_ok;
            $ls_accurate_tidak_ok               = $request->ls_accurate_tidak_ok;
            $sa_accurate_tidak_ok               = $request->sa_accurate_tidak_ok;
            $surface_check_tidak_ok             = $request->surface_check_tidak_ok;
        /* end if */
        $status_akhir                           = $request->status_akhir;
        /* $user_id_inputer                    = $this->decrypt($request->user_inputer_id); */
        /*  pengecekan kembali / validasi status akhir */
            if ($filling_machine->filling_machine_code == 'TPA A') 
            {
                if 
                (
                    $airgap             == 'OK' && 
                    $ts_accurate_kanan  == 'OK' && 
                    $ts_accurate_kiri   == 'OK' && 
                    $ls_accurate        == 'OK' && 
                    $sa_accurate        == 'OK' && 
                    $surface_check      == 'OK' && 
                    $pinching           == 'OK' && 
                    $strip_folding      == 'OK' && 
                    $konduktivity_kanan == 'OK' && 
                    $konduktivity_kiri  == 'OK' && 
                    $design_kanan       == 'OK' && 
                    $design_kiri        == 'OK' && 
                    $dye_test           == 'OK' && 
                    $residu_h2o2        == 'OK' && 
                    $prod_code_no_md    == 'OK' && 
                    (
                        $ls_sa_proportion !== '10:90' || 
                        $ls_sa_proportion !== '90:10' || 
                        $ls_sa_proportion !== '80:20' || 
                        $ls_sa_proportion !== '70:30'
                    ) && 
                    $volume_kanan       >= 198 && 
                    $volume_kiri        >= 198 /* && 
                    (
                        $overlap >= 4.5 && 
                        $overlap <= 6.0
                    ) */
                ) 
                {
                    $status_akhir_validasi  = 'OK';
                }
                else
                {
                    $status_akhir_validasi  = '#OK';
                }
            }
            else if($filling_machine->filling_machine_code == 'A3CF B' || $filling_machine->filling_machine_code == 'TBA C')
            {
                if 
                (
                    $airgap             == 'OK' && 
                    $ts_accurate_kanan  == 'OK' && 
                    $ts_accurate_kiri   == 'OK' && 
                    $ls_accurate        == 'OK' && 
                    $sa_accurate        == 'OK' && 
                    $surface_check      == 'OK' && 
                    $pinching           == 'OK' && 
                    $strip_folding      == 'OK' && 
                    $konduktivity_kanan == 'OK' && 
                    $konduktivity_kiri  == 'OK' && 
                    $design_kanan       == 'OK' && 
                    $design_kiri        == 'OK' && 
                    $dye_test           == 'OK' && 
                    $residu_h2o2        == 'OK' && 
                    $prod_code_no_md    == 'OK' && 
                    (
                        $ls_sa_proportion !== '10:90' ||
                        $ls_sa_proportion !== '90:10' || 
                        $ls_sa_proportion !== '80:20' || 
                        $ls_sa_proportion !== '70:30'
                    ) && 
                    $volume_kanan       >= 198 && 
                    $volume_kiri        >= 198/*  && 
                    (
                        $overlap >= 3.5 && 
                        $overlap <= 4.5
                    ) */
                ) 
                {
                    $status_akhir_validasi  = 'OK';
                }
                else
                {
                    $status_akhir_validasi  = '#OK';
                }   
            }
        /* end validasi status akhir  */  
        /* ini langsung di update hasil pengamatannya */
        $rpd_filling_detail_pi->airgap                = $airgap;
        $rpd_filling_detail_pi->ts_accurate_kanan     = $ts_accurate_kanan;
        $rpd_filling_detail_pi->ts_accurate_kiri      = $ts_accurate_kiri;
        $rpd_filling_detail_pi->ls_accurate           = $ls_accurate;
        $rpd_filling_detail_pi->sa_accurate           = $sa_accurate;
        $rpd_filling_detail_pi->surface_check         = $surface_check;
        $rpd_filling_detail_pi->pinching              = $pinching;
        $rpd_filling_detail_pi->strip_folding         = $strip_folding;
        $rpd_filling_detail_pi->konduktivity_kanan    = $konduktivity_kanan;
        $rpd_filling_detail_pi->konduktivity_kiri     = $konduktivity_kiri;
        $rpd_filling_detail_pi->design_kanan          = $design_kanan;
        $rpd_filling_detail_pi->design_kiri           = $design_kiri;
        $rpd_filling_detail_pi->dye_test              = $dye_test;
        $rpd_filling_detail_pi->residu_h2o2           = $residu_h2o2;
        $rpd_filling_detail_pi->prod_code_and_no_md   = $prod_code_no_md;
        $rpd_filling_detail_pi->correction            = $correction;
        $rpd_filling_detail_pi->overlap               = $overlap;
        $rpd_filling_detail_pi->ls_sa_proportion      = $ls_sa_proportion;
        $rpd_filling_detail_pi->volume_kanan          = $volume_kanan;
        $rpd_filling_detail_pi->volume_kiri           = $volume_kiri;
        $rpd_filling_detail_pi->status_akhir          = $status_akhir;
        $rpd_filling_detail_pi->save();
        // dd($status_akhir_validasi);
        if ($status_akhir_validasi == 'OK' && $status_akhir == 'OK') 
        {
            /* apabila status akhirnya OK maka dia akan mengecek dulu apakah dia analisa sampel pertama atau bukan */
            $allRpdDetailPi     = RpdFillingDetailPi::where('rpd_filling_head_id',$rpd_filling_detail_pi->rpd_filling_head_id)->where('wo_number_id',$wo_number_id)->where('filling_machine_id',$filling_machine_id)->get();

            foreach ($allRpdDetailPi as $key => $rpd_filling_detail_all) 
            {
                if ($rpd_filling_detail_all->id == $rpd_filling_detail_pi->id) 
                {
                    $activeRpd = $key;
                }
            }
            /* ini dilakukan apakah pengecekan apakah sampel OK yang di analisa merupakan sampel pertama atau bukan */
            if ($activeRpd == '0') 
            {
                return ['success'=>true,'ppq'=>false,'message'=>'Hasil analisanya berhasil diinput'];
            } 
            else 
            {
                /* ini bila sampel itu bukan sampel yang pertama di analisa maka dia akan mengambil dulu sampel sebelum ini */
                $prevRpd        = $allRpdDetailPi[$activeRpd-1];
                if ($prevRpd->status_akhir == 'OK') 
                {
                    /* apabila status akhir sebelumnya adalah OK maka dia akan input seperti biasa aja */
                    return ['success'=>true,'ppq'=>false,'message'=>'Hasil analisanya berhasil diinput'];
                } 
                else 
                {
                    $data       = ['rpd_filling_head_id'=>$this->encrypt($rpd_filling_head_id),'wo_number_id'=>$this->encrypt($wo_number_id),'filling_machine_id'=>$this->encrypt($filling_machine_id),'rpd_filling_detail_pi'=>$this->encrypt($rpd_filling_detail_pi->id)];
                    return ['success'=>true,'ppq'=>true,'isidatanya'=>$data];
                }
            }
        }
        else if($status_akhir_validasi == '#OK' && $status_akhir == '#OK')
        {
            return ['success'=>true, 'ppq'=>false,'message'=>'1'];
        }

    }
    public function submitAnalisaSampelPiAtEvent(Request $request)
    {
        $kode_sampel                        = $request->paketan[0];
        $idevent                            = $this->decrypt($request->paketan[1]);
        $wo_id                              = $this->decrypt($request->paketan[2]);
        $rpdFillingDetailAtEvent            = RpdFillingDetailAtEvent::find($idevent);
        if (strpos($kode_sampel, ' (Event)')) 
        {
            $kode_sampel_baru   = explode(' (Event)', $kode_sampel);
            $kode_sampel        = $kode_sampel_baru[0];
        }

        if (strpos($kode_sampel, '(')) 
        {
            $kode_sampel_baru   = explode('(', $kode_sampel);
            $kode_sampel        = $kode_sampel_baru[0];
        }
        switch ($kode_sampel) 
        {
            case 'B':
                $ls_sa_sealing_quality_event                                = $request->ls_sa_sealing_quality_event;
                $ls_sa_proportion_event                                     = $request->ls_sa_proportion_event;
                $sideway_sealing_alignment_event                            = $request->sideway_sealing_alignment_event;
                $overlap_event                                              = $request->overlap_event;
                $package_length_event                                       = $request->package_length_event;
                $paper_splice_sealing_quality_event                         = $request->paper_splice_sealing_quality_event;
                $status_akhir                                               = $request->status_akhir;
                //update data detail                
                $rpdFillingDetailAtEvent->ls_sa_sealing_quality             = $ls_sa_sealing_quality_event;
                $rpdFillingDetailAtEvent->ls_sa_proportion                  = $ls_sa_proportion_event;
                $rpdFillingDetailAtEvent->sideway_sealing_alignment         = $sideway_sealing_alignment_event;
                $rpdFillingDetailAtEvent->overlap                           = $overlap_event;
                $rpdFillingDetailAtEvent->package_length                    = $package_length_event;
                $rpdFillingDetailAtEvent->paper_splice_sealing_quality      = $paper_splice_sealing_quality_event;
                $rpdFillingDetailAtEvent->status_akhir                      = $status_akhir;
                $rpdFillingDetailAtEvent->save();
                return ['success'=>true,'message'=>'Berhasil']; 
            break;
            case 'C':
                $ls_sa_sealing_quality_event                                = $request->ls_sa_sealing_quality_event;
                $ls_sa_proportion_event                                     = $request->ls_sa_proportion_event;
                $sideway_sealing_alignment_event                            = $request->sideway_sealing_alignment_event;
                $overlap_event                                              = $request->overlap_event;
                $package_length_event                                       = $request->package_length_event;
                $paper_splice_sealing_quality_event                         = $request->paper_splice_sealing_quality_event;
                $status_akhir                                               = $request->status_akhir;
                //update data detail                
                $rpdFillingDetailAtEvent->ls_sa_sealing_quality             = $ls_sa_sealing_quality_event;
                $rpdFillingDetailAtEvent->ls_sa_proportion                  = $ls_sa_proportion_event;
                $rpdFillingDetailAtEvent->sideway_sealing_alignment         = $sideway_sealing_alignment_event;
                $rpdFillingDetailAtEvent->overlap                           = $overlap_event;
                $rpdFillingDetailAtEvent->package_length                    = $package_length_event;
                $rpdFillingDetailAtEvent->paper_splice_sealing_quality      = $paper_splice_sealing_quality_event;
                $rpdFillingDetailAtEvent->status_akhir                      = $status_akhir;
                $rpdFillingDetailAtEvent->save();
                return ['success'=>true,'message'=>'Berhasil'];
            break;
            case 'D':
                $ls_sa_sealing_quality_event                                = $request->ls_sa_sealing_quality_event;
                $ls_sa_proportion_event                                     = $request->ls_sa_proportion_event;
                $ls_sa_sealing_quality_strip                                = $request->ls_sa_sealing_quality_strip;
                $status_akhir                                               = $request->status_akhir;
                //update data detail                
                $rpdFillingDetailAtEvent->ls_sa_sealing_quality             = $ls_sa_sealing_quality_event;
                $rpdFillingDetailAtEvent->ls_sa_proportion                  = $ls_sa_proportion_event;
                $rpdFillingDetailAtEvent->ls_sa_sealing_quality_strip       = $ls_sa_sealing_quality_strip;
                $rpdFillingDetailAtEvent->status_akhir                      = $status_akhir;
                $rpdFillingDetailAtEvent->save();
                return ['success'=>true,'message'=>'Berhasil'];
            break;
            case 'E':
                $ls_sa_sealing_quality_event                                = $request->ls_sa_sealing_quality_event;
                $ls_sa_proportion_event                                     = $request->ls_sa_proportion_event;
                $ls_sa_sealing_quality_strip                                = $request->ls_sa_sealing_quality_strip;
                $status_akhir                                               = $request->status_akhir;
                //update data detail                
                $rpdFillingDetailAtEvent->ls_sa_sealing_quality             = $ls_sa_sealing_quality_event;
                $rpdFillingDetailAtEvent->ls_sa_proportion                  = $ls_sa_proportion_event;
                $rpdFillingDetailAtEvent->ls_sa_sealing_quality_strip       = $ls_sa_sealing_quality_strip;
                $rpdFillingDetailAtEvent->status_akhir                      = $status_akhir;
                $rpdFillingDetailAtEvent->save();
                return ['success'=>true,'message'=>'Berhasil'];
            break;
            case 'F':
                $ls_sa_sealing_quality_event                        = $request->ls_sa_sealing_quality_event;
                $ls_sa_proportion_event                             = $request->ls_sa_proportion_event;
                $ls_short_stop_quality                              = $request->ls_short_stop_quality;
                $sa_short_stop_quality                              = $request->sa_short_stop_quality;
                $status_akhir                                       = $request->status_akhir;
                //update data detail                
                $rpdFillingDetailAtEvent->ls_sa_sealing_quality     = $ls_sa_sealing_quality_event;
                $rpdFillingDetailAtEvent->ls_sa_proportion          = $ls_sa_proportion_event;
                $rpdFillingDetailAtEvent->ls_short_stop_quality     = $ls_short_stop_quality;
                $rpdFillingDetailAtEvent->sa_short_stop_quality     = $sa_short_stop_quality;
                $rpdFillingDetailAtEvent->status_akhir              = $status_akhir;
                $rpdFillingDetailAtEvent->save();
                return ['success'=>true,'message'=>'Berhasil'];            
            break;
            case 'G':
                $ls_sa_sealing_quality_event                        = $request->ls_sa_sealing_quality_event;
                $ls_sa_proportion_event                             = $request->ls_sa_proportion_event;
                $ls_short_stop_quality                              = $request->ls_short_stop_quality;
                $sa_short_stop_quality                              = $request->sa_short_stop_quality;
                $status_akhir                                       = $request->status_akhir;
                //update data detail                
                $rpdFillingDetailAtEvent->ls_sa_sealing_quality     = $ls_sa_sealing_quality_event;
                $rpdFillingDetailAtEvent->ls_sa_proportion          = $ls_sa_proportion_event;
                $rpdFillingDetailAtEvent->ls_short_stop_quality     = $ls_short_stop_quality;
                $rpdFillingDetailAtEvent->sa_short_stop_quality     = $sa_short_stop_quality;
                $rpdFillingDetailAtEvent->status_akhir              = $status_akhir;
                $rpdFillingDetailAtEvent->save();
                return ['success'=>true,'message'=>'Berhasil'];            
            break;
        }
    }
    public function hapusSampelAnalisa(Request $request)
    {
        $cekAkses       = $this->CheckAksesHapus(\Request::getRequestUri(),'rollie.process_data.rpds');
        if ($cekAkses['success'] == true)
        {
            $sampel_id      = $this->decrypt($request->sampel_id);
            $event          = $request->event;

            if ($event == 'true') 
            {
                // ini apabila status sampelnya itu event , maka dia ngehapus dari tabel at event
                $rpd_filling_detail_id_event                = RpdFillingDetailAtEvent::find($sampel_id);
                $rpd_filling_id_pi                          = RpdFillingDetailPi::where('rpd_filling_head_id',$rpd_filling_detail_id_event->rpd_filling_head_id)->where('wo_number_id',$rpd_filling_detail_id_event->wo_number_id)->where('filling_time',$rpd_filling_detail_id_event->filling_time)->where('filling_date',$rpd_filling_detail_id_event->filling_date)->first();
                $rpd_filling_detail_id_event->deleted_by    = Auth::user()->id;    
                $rpd_filling_detail_id_event->save();
                $rpd_filling_detail_id_event->delete();
                if (!is_null($rpd_filling_id_pi)) 
                {
                    $rpd_filling_id_pi->deleted_by    = Auth::user()->id;    
                    $rpd_filling_id_pi->save();
                    $rpd_filling_id_pi->delete();
                }
                return ['success'=>true,'message'=>'Data berhasil dihapus'];
            }
            else
            {
                $rpd_filling_detail_id_pi                       = RpdFillingDetailPi::find($sampel_id);
                $rpd_filling_detail_id_event                    = RpdFillingDetailAtEvent::where('rpd_filling_head_id',$rpd_filling_detail_id_pi->rpd_filling_head_id)->where('wo_number_id',$rpd_filling_detail_id_pi->wo_number_id)->where('filling_time',$rpd_filling_detail_id_pi->filling_time)->where('filling_date',$rpd_filling_detail_id_pi->filling_date)->first();
                $rpd_filling_detail_id_pi->deleted_by           = Auth::user()->id;
                $rpd_filling_detail_id_pi->save();
                $rpd_filling_detail_id_pi->delete();
                if (!is_null($rpd_filling_detail_id_event)) 
                {
                    $rpd_filling_detail_id_event->deleted_by           = Auth::user()->id;
                    $rpd_filling_detail_id_event->save();
                    $rpd_filling_detail_id_event->delete();
                }
                return ['success'=>true,'message'=>'Data berhasil dihapus'];
            }
        } 
        else 
        {
            return $cekAkses;
        }
    }
    public function closeRpdFilling(Request $request)
    {
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'rollie.process_data.rpds');        
        if ($cekAkses['success'] == true) 
        {
            $rpdFillingHead         = RpdFillingHead::find($this->decrypt($request->rpd_filling_head_id));
            /* dilakukan pengecekan apakah seluruh sampel sudah dianalisa atau belum*/
            foreach ($rpdFillingHead->rpdFillingDetailPis as $rpdFillingDetailPi) 
            {
                if (is_null($rpdFillingDetailPi->status_akhir)) 
                {
                    return ['success' => false,'draft_ppq'=>false, 'message' => 'Harap selesaikan seluruh draft analisa sampel PI'];
                }
            }
            foreach ($rpdFillingHead->rpdFillingDetailAtEvents as $rpdFillingDetailAtEvent) 
            {
                if (is_null($rpdFillingDetailAtEvent->status_akhir)) 
                {
                    return ['success' => false,'draft_ppq'=>false, 'message' => 'Harap selesaikan seluruh draft analisa sampel PI At event'];
                }
            }
            /* dilakukan pengecekan untuk draft ppq */
            $rpdFillingDetailPiPpq  = array();
            foreach ($rpdFillingHead->rpdFillingDetailPis as $rpdFillingDetailPi) 
            {
                array_push($rpdFillingDetailPiPpq, $rpdFillingDetailPi->id);
            }
            $ppqs   = Ppq::whereIn('rpd_filling_detail_pi_id',$rpdFillingDetailPiPpq)->where('status_akhir','5')->orWhere('jumlah_pack','0')->get();
            if (count($ppqs) == 0) 
            {
                $rpdFillingHead->rpd_status     = '1';
                $rpdFillingHead->save();
                foreach ($rpdFillingHead->woNumbers as $woNumber) 
                {
                    if (!is_null($woNumber->cppHead)) 
                    {
                        if ($woNumber->cppHead->cpp_status == '1') 
                        {
                            $woNumber->wo_status   = '4';
                            $woNumber->save();
                        }
                    }
                    $jumlah_psr     =0;
                    foreach ($woNumber->rpdFillingDetailPis as $rpdFillingDetailPi) 
                    {
                        $jumlah_psr += $rpdFillingDetailPi->fillingSampelCode->jumlah;
                    }
                    $nomor_psr              = $this->getNomorPsr();
                    // dd($nomor_psr);
                    $psr                    = Psr::create([
                        'psr_number'        => $nomor_psr,
                        'wo_number_id'      => $woNumber->id,
                        'psr_qty'           => $jumlah_psr,
                        'psr_status'        => '0'
                    ]);
                }
                return ['success'=>true, 'draft_ppq' => false,'message'=>'RPD filling berhasil di close'];
            }
            else
            {
                $return     = ['success' => false,'draft_ppq' => true,'message' => 'Harap selesaikan draft ppq terlebih dahulu'];
                return $return;
            }

        } 
        else 
        {
            return $cekAkses;
        }
        
    }

    public function filterTanggalReport($tanggal_produksi)
    {
        $tanggal_produksi   = explode(' s.d ',$tanggal_produksi);
        $tanggal_awal       = date('Y-m-d',strtotime($tanggal_produksi[0]));
        $tanggal_akhir      = date('Y-m-d',strtotime($tanggal_produksi[1]));

        $woNumbers          = WoNumber::whereBetween('production_realisation_date',[$tanggal_awal,$tanggal_akhir])->whereIn('wo_status',['4','5'])->groupBy('product_id')->get();
        foreach ($woNumbers as $woNumber) 
        {
            $product                = $this->encryptId($woNumber->product);
            foreach ($woNumber->rpdFillingDetailPis as $rpdFillingDetailPi) 
            {
                $kode_sampel        = $rpdFillingDetailPi->fillingSampelCode;
                $mesin_filling      = $rpdFillingDetailPi->fillingMachine;
            }
        }        
        $woNumbers  = $this->encryptId($woNumbers,'product_id');
        $return     = array();
        // $return['woNumbers'] = $woNumbers;
        array_push($return,$woNumbers);
        return $return;
        
    }

    public function filterProductReport($product_id, $production_date)
    {
        $explode            = explode(',',$product_id);

        $return             = array();
        foreach ($explode as $product_id) 
        {
            $product_id         = $this->decrypt($product_id);
            $tanggal_produksi   = explode(' s.d ',$production_date);
            $tanggal_awal       = date('Y-m-d',strtotime($tanggal_produksi[0]));
            $tanggal_akhir      = date('Y-m-d',strtotime($tanggal_produksi[1]));

            $woNumbers          = WoNumber::whereBetween('production_realisation_date',[$tanggal_awal,$tanggal_akhir])->whereIn('wo_status',['4','5'])->where('product_id',$product_id)->groupBy('product_id')->get();
            foreach ($woNumbers as $woNumber) 
            {
                $product                = $this->encryptId($woNumber->product);
                foreach ($woNumber->rpdFillingDetailPis as $rpdFillingDetailPi) 
                {
                    $kode_sampel        = $rpdFillingDetailPi->fillingSampelCode;
                    $mesin_filling      = $rpdFillingDetailPi->fillingMachine;
                }
            }        
            $woNumbers = $this->encryptId($woNumbers,'product_id');
            array_push($return,$woNumbers);
        }
        
        return $return;
    }
    public function filterWoNumberReport($wo_number_id)
    {
        $explode            = explode(',',$wo_number_id);
        $return             = array();
        foreach ($explode as $wo_number_id) 
        {
            $wo_number_id       = $this->decrypt($wo_number_id);
            $woNumbers          = WoNumber::find($wo_number_id);
            foreach ($woNumbers as $woNumber) 
            {
                $product                = $this->encryptId($woNumber->product);
                foreach ($woNumber->rpdFillingDetailPis as $rpdFillingDetailPi) 
                {
                    $kode_sampel        = $rpdFillingDetailPi->fillingSampelCode;
                    $mesin_filling      = $rpdFillingDetailPi->fillingMachine;
                }
            }        
            $woNumbers = $this->encryptId($woNumbers,'product_id');
            array_push($return,$woNumbers);
        }
        
        return $return;
    }
    public function exportReportExcel($production_date,$product_id,$wo_number_id)
    {
        $production_date            = explode(' s.d ',$production_date);
        $production_date_start      = date('Y-m-d',strtotime($production_date[0]));
        $production_date_end        = date('Y-m-d',strtotime($production_date[1]));
        $product_id                 = explode(',',$product_id);
        $wo_number_id               = explode(',',$wo_number_id);
        if ($product_id[0] == 'null') 
        {
            $product_id = null;
        }
        if ($wo_number_id[0] == 'null') 
        {
            $wo_number_id = null;
        }
        $woNumbers                  = WoNumber::whereBetween('production_realisation_date',[$production_date_start,$production_date_end])->whereIn('wo_status',['4','5'])->get();
        if (!is_null($product_id)) 
        {
            $woNumbers      = $woNumbers->whereIn('product_id',$product_id);
        }
        if (!is_null($wo_number_id)) 
        {
            $woNumbers      = $woNumbers->whereIn('wo_nu$wo_number_id',$wo_number_id);
        }
        
        return Excel::download(new ReportRpdFilling($woNumbers), 'Report Rpd Filling '.$production_date_start.' - '.$production_date_end.'.xlsx');
    }
}
