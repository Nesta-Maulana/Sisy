<?php

namespace App\Http\Controllers\Transaction\Rollie;

use App\Http\Controllers\ResourceController;
use Illuminate\Http\Request;

use App\Models\Transaction\Rollie\CppHead;
use App\Models\Transaction\Rollie\CppDetail;
use App\Models\Transaction\Rollie\Palet;
use App\Models\Transaction\Rollie\PaletPpq;
use App\Models\Transaction\Rollie\WoNumber;
use App\Models\Transaction\Rollie\RpdFillingHead;
use App\Models\Transaction\Rollie\RpdFillingDetailPi;
use App\Models\Transaction\Rollie\RpdFillingDetailAtEvent;

use App\Models\Master\Product;
use App\Models\Master\FillingMachine;
use App\Models\Master\FillingSampelCode;
use App\Models\Master\FillingMachineGroupHead;
use App\Models\Master\FillingMachineGroupDetail;

use Session;
use Auth;
class CppProductController extends ResourceController
{
    public function prosesCppProduk(Request $request)
    {
        $cekAkses               = $this->CheckAksesTambah(\Request::getRequestUri(),'rollie.process_data.cpps');
        if ($cekAkses['success'] == true) 
        {   
            $wo_number_id                   = $this->decrypt($request->wo_number_id);
            $wo_number                      = WoNumber::find($wo_number_id);
            $start_packing                  = date('Y-m-d');
            $cekCppAktif                    = CppHead::where('cpp_status','0')->get();
            if (count($cekCppAktif) > 0) 
            {
                $aksestambah                    = 0;        
                $aksesduplik                    = 0;
                foreach ($cekCppAktif as $cpp_aktif) 
                {
                    if ($cpp_aktif->product->filling_machine_group_head_id == $wo_number->product->filling_machine_group_head_id || $cpp_aktif->product_id !== $wo_number->product->id) 
                    {
                        return ['success'=>false,'message'=>'Harap Selesaikan Proses CPP Packing '.$cpp_aktif->product->fillingMachineGroupHead->filling_machine_group_name.' yang sedang akif terlebih dahulu'];
                    }
                    else if($cpp_aktif->product->filling_machine_group_head_id == $wo_number->product->filling_machine_group_head_id && $cpp_aktif->product_id == $wo_number->product->id) 
                    {
                        $cpp_produk     = $cpp_aktif;
                        $aksesduplik++;
                    }
                    else if($cpp_aktif->product->filling_machine_group_head_id !== $wo_number->product->filling_machine_group_head_id && count($cekCppAktif) == 1)
                    {
                        $aksestambah++;
                    }
                }
                if ($aksestambah == 0 && $aksesduplik == 0) 
                {
                    return ['success'=>false,'message'=>'Harap Selesaikan Proses CPP Packing Terlebih Dahulu'];
                }
                else if ($aksestambah > 0 )
                {
                    $cppHead                        =   CppHead::create([
                                                            'product_id'        => $wo_number->product_id,
                                                            'packing_date'      => $start_packing,
                                                            'cpp_status'        => '0'
                                                        ]);
                    $wo_number->cpp_head_id         = $cppHead->id;
                    $wo_number->expired_date        = date('Y-m-d',strtotime("+".$wo_number->product->expired_range." months", strtotime($wo_number->production_realisation_date)));
                    $wo_number->save();
                    $return                         = $this->encrypt($cppHead->id);
                    return ['success'=>true,'cpp_head_id'=>$return];
                }
                else if ($aksesduplik > 0) 
                {
                    $wo_number->cpp_head_id        = $cpp_produk->id;
                    $wo_number->expired_date       = date('Y-m-d',strtotime("+".$wo_number->product->expired_range." months", strtotime($wo_number->production_realisation_date)));
                    $wo_number->save();
                    $return                 = $this->encrypt($cpp_produk->id);
                    return ['success'=>true,'cpp_head_id'=>$return];
                }
            }
            else
            {
                $cppHead                                = CppHead::create([
                                                            'product_id'        => $wo_number->product_id,
                                                            'packing_date'      => $start_packing,
                                                            'cpp_status'        => '0'
                                                        ]);
                $wo_number->cpp_head_id                 = $cppHead->id;
                $wo_number->expired_date                = date('Y-m-d',strtotime("+".$wo_number->product->expired_range." months", strtotime($wo_number->production_realisation_date)));
                $wo_number->save();
                $return                 = $this->encrypt($cppHead->id);
                return ['success'=>true,'cpp_head_id'=>$return];
            }
        }
        else
        {
            return redirect()->back()->with('error',$cekAkses['message']);
        }
    }
    public function addPalet(Request $request)
    {
        $cekAkses   = $this->CheckAksesTambah(\Request::getRequestUri(),'rollie.process_data.cpps');
        if ($cekAkses['success']) 
        {
            $wo_number              = WoNumber::find($this->decrypt($request->wo_number_id));
            $filling_machine        = FillingMachine::find($this->decrypt($request->filling_machine_id));
            $cppHead                = CppHead::find($this->decrypt($request->cpp_head_id));
            $cppDetails             = $cppHead->cppDetails->where('filling_machine_id',$filling_machine->id)->where('wo_number_id',$wo_number->id);

            if (is_null($cppDetails) || count($cppDetails) == 0) 
            {
                $this->addNewLotNumber($wo_number,$filling_machine,$cppHead);
            }
            else
            {
                $cppDetailnya   = '';
                foreach ($cppDetails as $cppDetail) 
                {
                    if ($cppDetail->wo_number_id === $wo_number->id) 
                    {
                        /* Apabila nomor wonya sama  */
                        $cppDetailnya   = $cppDetail; 
                        break;
                    } 
                }
                if ($cppDetailnya === '') 
                {
                    $this->addNewLotNumber($wo_number,$filling_machine,$cppHead);
                } 
                else 
                {
                    $cekpalet           = $cppDetailnya->palets->last();
                    $now                = date('Y-m-d H:i:s');
                    if (is_null($cekpalet)) 
                    {
                        if (strpos($wo_number->product->product_name,'Gundam')) 
                        {    
                            Palet::create([
                                'cpp_detail_id' => $cppDetailnya->id,
                                'palet'         => 'P01G',
                                'start'         => $now
                            ]);
                        }
                        else
                        {
                            Palet::create([
                                'cpp_detail_id' => $cppDetailnya->id,
                                'palet'         => 'P01',
                                'start'         => $now
                            ]);   
                        }
                    }
                    elseif (!is_null($cekpalet)) 
                    {
                        /* $cekpalet->end      = $now;
                        $cekpalet->save(); */
                    
                        if (strpos($wo_number->product->product_name,'Gundam')) 
                        {    
                            $pecah  = explode('G',$cekpalet->palet);
                            $pecah  = explode('P',$pecah[0]);
                            $palet  = $pecah[1]+1;
                            if (strlen($palet) == 1) 
                            {
                                $palet = "0".$palet;
                            }
                            $palet  = 'P'.$palet.'G';
                            Palet::create([
                                'cpp_detail_id' => $cppDetailnya->id,
                                'palet'         => $palet,
                                'start'         => $now
                            ]);
                        }
                        else
                        {
                            $pecah  = explode('P',$cekpalet->palet);
                            $palet  = $pecah[1]+1;
                            if (strlen($palet) == 1) 
                            {
                                $palet = "0".$palet;
                            }
                            $palet  = 'P'.$palet;
                            Palet::create([
                                'cpp_detail_id' => $cppDetailnya->id,
                                'palet'         => $palet,
                                'start'         => $now
                            ]);   
                        }   
                    }
                }
                
                
            }
            return ['success'=>true];
        } 
        else 
        {
            return $cekAkses;
        }
        
    
    }
    function addNewLotNumber($wo_number,$filling_machine,$cppHead)
    {
        $tahunproduksi              =   explode('-', $wo_number->production_realisation_date);
        $expired_date               =   explode('-', $wo_number->expired_date);
        // dd($expired_date);
        $huruf                      =   $this->tahunKeHuruf($tahunproduksi[0]);
        $length                     =   strlen($filling_machine->filling_machine_code);
        $index                      =   $length-1; 
        $filling_machine_code       =   $filling_machine->filling_machine_code[$index];
        $huruf_akhir                =   ['A','B','C','D','E','F','G','H','I','J'];
        $i                          =   0;
        while($i < count($huruf_akhir)) 
        { 
            //$ceklot     =  $huruf.$filling_machine_code.$expired_date[1].$expired_date[2].$huruf_akhir[$i];
            /* LOGIC Lot = Tahun Produksi + Kode Mesin Filling + Tanggal Produksi + Bulan Produksi + Urutan produksi */
            $urutan_proses          =  $tahunproduksi[2].$tahunproduksi[1].$huruf_akhir[$i];

            $ceklot                 = CppDetail::where('lot_number','like','%'.$urutan_proses)->first();
                // dd($ceklot->cppHead->id);
            
            if (is_null($ceklot) || $ceklot->cppHead->id == $cppHead->id) 
            {
                $lot_number         =  $huruf.$filling_machine_code.$expired_date[2].$expired_date[1].$huruf_akhir[$i];

                break;
            }
            else
            {
                $i++;
            }
        }
        $cppDetail     =   CppDetail::create([
                                'cpp_head_id'               => $cppHead->id,
                                'wo_number_id'              => $wo_number->id,
                                'filling_machine_id'        => $filling_machine->id,
                                'lot_number'                => $lot_number
                            ]);
        // ini untuk mengecek palet nantinya yang mesinya sama. maka Nomor Palet akan continous
        //$cppDetail_lot     = CppDetail::where('lot_number',$lot_number)->where('cpp_head_id',$cppHead->id)->where('wo_id',$wo_number_id)->where('filling_machine_id',$filling_machine_id)->first();
        //cek jumlah cpp jika nomor lot sama lebih dari satu maka paletnya akan continous deh
        $cekpalet           = $cppDetail->palets->last();
        $now                = date('Y-m-d H:i:s');
        if (is_null($cekpalet)) 
        {
            if (strpos($wo_number->product->product_name,'Gundam')) 
            {    
                $paletbaru = Palet::create([
                    'cpp_detail_id' => $cppDetail->id,
                    'palet'         => 'P01G',
                    'start'         => $now
                ]);
            }
            else
            {
                $paletbaru = Palet::create([
                    'cpp_detail_id' => $cppDetail->id,
                    'palet'         => 'P01',
                    'start'         => $now
                ]);   
            }
        }
        elseif (!is_null($cekpalet)) 
        {
            /* fungsi jam palet akhir di matikan karena ada concern apabila end palet sebelum berbeda dengan start palet sesudah */
            // $cekpalet->end      = $now;
            // $cekpalet->save();
            if (strpos($wo_number->product->product_name,'Gundam')) 
            {    
                $pecah  = explode('G',$cekpalet->palet);
                $pecah  = explode('P',$pecah[0]);
                $palet  = $pecah[1]+1;
                if (strlen($palet) == 1) 
                {
                    $palet = "0".$palet;
                }
                $palet  = 'P'.$palet.'G';
                $paletbaru = Palet::create([
                    'cpp_detail_id' => $cppDetail->id,
                    'palet'         => $palet,
                    'start'         => $cekpalet->end
                ]);
            }
            else
            {
                $pecah  = explode('P',$cekpalet->palet);
                $palet  = $pecah[1]+1;
                if (strlen($palet) == 1) 
                {
                    $palet = "0".$palet;
                }
                $palet  = 'P'.$palet;
                $paletbaru = Palet::create([
                    'cpp_detail_id' => $cppDetail->id,
                    'palet'         => $palet,
                    'start'         => $now
                ]);

            }   
        }

        return ['success'=>true,'message'=>'berhasil'];
    }
    public function refreshCppTable($cpp_head_id,$wo_number_id)
    {
        $cpp_head_id    = $this->decrypt($cpp_head_id);
        $wo_number_id   = $this->decrypt($wo_number_id);

        $cppHead        = CppHead::find($cpp_head_id);
        foreach ($cppHead->product->fillingMachineGroupHead->fillingMachineGroupDetails as $key => $fillingMachineGroupDetail) 
        {
            $fillingMachineGroupDetail->filling_machine             = $fillingMachineGroupDetail->fillingMachine->filling_machine_name;
            $fillingMachineGroupDetail->fillingMachine->short_name  = strtolower($fillingMachineGroupDetail->fillingMachine->filling_machine_name);
            $fillingMachineGroupDetail->fillingMachine->short_code  = $fillingMachineGroupDetail->fillingMachine->filling_machine_code[strlen($fillingMachineGroupDetail->fillingMachine->filling_machine_code)-1];
            $this->encryptId($cppHead->product,'subbrand_id','product_type_id','filling_machine_group_head_id');
            $this->encryptId($cppHead->product->fillingMachineGroupHead);
            $this->encryptId($fillingMachineGroupDetail,'filling_machine_group_head_id','filling_machine_id');
            $this->encryptId($fillingMachineGroupDetail->fillingMachine);

        }
        foreach ($cppHead->cppDetails as $key => $cppDetail) 
        {
            if ($cppDetail->wo_number_id == $wo_number_id) 
            {
                foreach ($cppDetail->palets as $key => $palet) 
                {
                    $this->encryptId($palet,'cpp_detail_id');
                    foreach ($palet->atEvents as $key => $atEvent) 
                    {
                        $this->encryptId($atEvent,'rpd_filling_head_id','wo_number_id','filling_machine_id','filling_sampel_code_id','verifier_id','palet_id');
                    }
                }
            }
            else
            {
                $cppDetail->palet          = null; 
            }
            $this->encryptId($cppDetail,'filling_machine_group_head_id','filling_machine_id','cpp_head_id','wo_number_id');
        }
        $this->encryptId($cppHead,'product_id','analisa_kimia_id');
        $cppHead->akses_ubah           = Session::get('ubah');;
        $cppHead->akses_hapus          = Session::get('hapus');;
        return $cppHead;
    }
    public function changePalet(Request $request)
    {
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'rollie.process_data.cpps');
        if ($cekAkses['success']) 
        {
            $palet_id           = $this->decrypt($request->palet_id);
            $palet              = Palet::find($palet_id);
            $palet->palet       = $request->palet;
            $palet->save();
            return ['success'=>true,'message'=>'Nomor Palet berhasil diubah'];
        } 
        else 
        {
            return $cekAkses;
        }   
    }
    public function changeStart(Request $request)
    {
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'rollie.process_data.cpps');
        if ($cekAkses['success']) {
            $palet_id           = $this->decrypt($request->palet_id);
            $palet              = Palet::find($palet_id);
            $start              = $request->start;
            $allPalet           = $palet->cppDetail->palets;
            foreach ($allPalet as $key => $active) 
            {
                if ($active->id === $palet->id) 
                {
                    $keyaktif   = $key;
                }
            }
            if ($keyaktif == 0) 
            {
                $start_tanggal      = substr($palet->start,11);
                $pi_at_event        = $palet->cppDetail->woNumber->rpdFillingAtEvents;
                if (!is_null($pi_at_event))
                {
                    $pi_at_event = $pi_at_event->where('filling_machine_id',$palet->cppDetail->filling_machine_id)->where('palet_id','0')->where('filling_time','>=',$start_tanggal)->get();
                    foreach ($pi_at_event as $at_event) 
                    {
                        $at_event->palet_id      = $palet->id;
                        $at_event->save();
                    }
                }
                if (!is_null($palet->end)) 
                {
                    if ($start >= $palet->end) 
                    {
                        return ['success'=>false,'message'=>'Jam awal palet tidak boleh melebihi dari jam akhir palet . Harap menyesuaikan jam akhir palet terlebih dahulu'];
                    }   
                    else if($start < $palet->end)
                    {
                        $palet->start           = $start;
                        $palet->save();
                        return ['success'=>true,'message'=>'Jam Awal Berhasil Diubah'];
                    }
                }
                else
                {
                    $palet->start           = $start;
                    $palet->save();
                    return ['success'=>true,'message'=>'Jam Awal Berhasil Diubah'];
                }
            } 
            else 
            {
                if (!is_null($palet->end)) 
                {
                    if ($start > $palet->end) 
                    {
                        // ini jika jam start > dari jam end
                        return ['success'=>false,'message'=>'Jam awal palet tidak boleh melebihi dari jam akhir palet . Harap menyesuaikan jam akhir palet terlebih dahulu'];
                    }   
                    else if ($start < $allPalet[$keyaktif-1]->end)
                    {
                        return ['success'=>false,'message'=>'Jam awal palet tidak boleh kurang dari jam end palet sebelumnya. Harap menyesuaikan jam palet lebih awal terlebih dahulu'];
                    }
                    else if($start < $palet->end && $start >= $allPalet[$keyaktif-1]->end)
                    {
                        $palet->start           = $start;
                        $palet->save();
                        $start_tanggal      = substr($palet->start,11);
                        $pi_at_event        = $palet->cppDetail->woNumber->rpdFillingAtEvents;
                        if (!is_null($pi_at_event))
                        {
                            $pi_at_event = $pi_at_event->where('filling_machine_id',$palet->cppDetail->filling_machine_id)->where('palet_id','0')->where('filling_time','>=',$start_tanggal)->get();
                            foreach ($pi_at_event as $at_event) 
                            {
                                $at_event->palet_id      = $palet->id;
                                $at_event->save();
                            }
                        }
                        return ['success'=>true,'message'=>'Jam Awal Berhasil Diubah'];

                    }
                }
                else
                {
                    if ($start > $allPalet[$keyaktif-1]->end)
                    {
                        return ['success'=>false,'message'=>'Jam awal palet tidak boleh kurang dari jam end palet sebelumnya. Harap menyesuaikan jam palet lebih awal terlebih dahulu'];
                    }
                    else if($start >= $allPalet[$keyaktif-1]->end)
                    {
                        $palet->start           = $start;
                        $palet->save();
                        return ['success'=>true,'message'=>'Jam Awal Berhasil Diubah'];

                    }
                }
            }
        } 
        else 
        {
            return $cekAkses;
        }
    }
    public function changeEnd(Request $request)
    {
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'rollie.process_data.cpps');
        if ($cekAkses['success']) {
            $palet_id           = $this->decrypt($request->palet_id);
            $palet              = Palet::find($palet_id);
            $end                = $request->end;
            $allPalet           = $palet->cppDetail->palets;
            foreach ($allPalet as $key => $active) 
            {
                if ($active->id === $palet->id) 
                {
                    $keyaktif   = $key;
                }
            }
            if ($keyaktif == 0) 
            {
                if (!is_null($palet->start)) 
                {
                    if ($end <= $palet->start) 
                    {
                        return ['success'=>false,'message'=>'Jam akhir palet tidak boleh kurang dari jam awal palet . Harap menyesuaikan jam awal palet terlebih dahulu'];
                    }   
                    else if($end > $palet->start)
                    {
                        $palet->end           = $end;
                        $palet->save();
                        return ['success'=>true,'message'=>'Jam Awal Berhasil Diubah'];
                    }
                }
            } 
            else 
            {
                if ($keyaktif+1 == count($allPalet)) 
                {
                    if ($end <= $palet->start) 
                    {
                        /*  ini jika jam start > dari jam end */
                        return ['success'=>false,'message'=>'Jam Akhir palet tidak boleh lebih awal dari jam awal palet . Harap menyesuaikan jam awal palet terlebih dahulu'];
                    }
                    else if($end > $palet->start)
                    {
                        $palet->end           = $end;
                        $palet->save();
                        return ['success'=>true,'message'=>'Jam Akhir Berhasil Diubah'];

                    }
                }
                else
                {
                    // dd($end);
                    if ($end <= $palet->start) 
                    {
                        /*  ini jika jam start > dari jam end */
                        return ['success'=>false,'message'=>'Jam Akhir palet tidak boleh lebih awal dari jam awal palet . Harap menyesuaikan jam awal palet terlebih dahulu'];
                    }   
                    else if ($end > $allPalet[$keyaktif+1]->start)
                    {
                        return ['success'=>false,'message'=>'Jam Akhir palet tidak boleh lebih dari jam mulai palet sesudah. Harap menyesuaikan jam palet lebih akhir terlebih dahulu'];
                    }
                    else if($end > $palet->start && $end <= $allPalet[$keyaktif+1]->start)
                    {
                        $palet->end           = $end;
                        $palet->save();
                        return ['success'=>true,'message'=>'Jam Akhir Berhasil Diubah'];

                    }
                }
            }
            
        } else {
            return $cekAkses;
        }
        
    }
    public function changeBox(Request $request) 
    {
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'rollie.process_data.cpps');
        if ($cekAkses['success']) 
        {
            $palet_id               = $this->decrypt($request->palet_id);
            $jumlah_box             = $request->jumlah_box;
            // ini mengambil palet nya 
            $palet                  = Palet::find($palet_id);
            $palet->jumlah_box      = $jumlah_box;
            $palet->jumlah_pack     = $jumlah_box*24;
            $palet->save();
            return ['success'=>true,'message'=>'Jumlah box berhasil di update'];
        } 
        else 
        {
            return $cekAkses;
        }
        
    }
    public function getWoPacking($jenis_tambah,$cpp_head_id)
    {
        $cppHead                = CppHead::find($this->decrypt($cpp_head_id));
        if ($jenis_tambah == '1') 
        {   
            $activeCpp          = CppHead::where('cpp_status','0')->get();
            if (count($activeCpp) > 1) 
            {
                return ['success'=>false,'message'=>'2 Cpp Packing Dengan Mesin Berbeda Sudah Aktif . Harap Selesaikan Proses Filling Terlebih Dahulu'];
            }
            else
            {
                /*ini untuk penambahan WO beda mesin*/
                $woNumbers      = WoNumber::where('wo_status','2')->whereNotIn('product_id',['30','31','32'])->get();
                $arraywo    = array();
                foreach ($woNumbers as $key => $woNumber) 
                {
                    if ($woNumber->product->fillingMachineGroupHead->filling_machine_group_name !== $activeCpp[0]->woNumbers[0]->product->fillingMachineGroupHead->filling_machine_group_name) 
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
            $product_id         = $cppHead->woNumbers[0]->product_id;
            $rangesebelum       = date('Y-m-d', strtotime($cppHead->woNumbers[0]->production_realisation_date. '-2 days'));
            $rangesesudah       = date('Y-m-d', strtotime($cppHead->woNumbers[0]->production_realisation_date. '+2 days'));
            $woNumbers          = WoNumber::whereBetween('production_realisation_date',[$rangesebelum,$rangesesudah])->where('wo_status','3')->where('product_id',$product_id)->whereNull('cpp_head_id')->get();
            if (count($woNumbers) > 0) 
            {
                foreach ($woNumbers as $woNumber) 
                {
                    $product        = $woNumber->product;
                    $woNumber       = $this->encryptId($woNumber,'cpp_head_id','rpd_filling_head');
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
        $cekAkses               = $this->CheckAksesTambah(\Request::getRequestUri(),'rollie.process_data.cpps');
        if ($cekAkses['success'] == true) 
        {
            $tanggal_packing               = date('Y-m-d');
            if ($request->jenis_tambah == '1') 
            {
                $woNumber                       = WoNumber::find($this->decrypt($request->nomor_wo_tambah));
                $product_id                     = $woNumber->product_id;
                $woNumber->wo_status            = '3';
                //insert ke head table cpp
                $insertCppHead                  = CppHead::create([
                                                    'product_id'        => $product_id,
                                                    'packing_date'      => $tanggal_packing,
                                                    'cpp_status'        => '0'    
                                                ]);
    
                $woNumber->cpp_head_id        = $insertCppHead->id;
                $woNumber->expired_date       = date('Y-m-d',strtotime("+".$woNumber->product->expired_range." months", strtotime($woNumber->production_realisation_date)));
                $woNumber->save();
                //update data wo ubah status dan ubah tanggal fillpack sesuai dengan start filling hari ini. 
                $return                     = $this->encrypt($insertCppHead->id);
                return redirect('/rollie/cpp-produk/form/'.$return);
            }
            else if ($request->jenis_tambah == '2') 
            {
                $cpp_head_id                    = $this->decrypt($request->cpp_head_id);
                $woNumber                       = WoNumber::find($this->decrypt($request->nomor_wo_tambah));
                $woNumber->cpp_head_id          = $cpp_head_id;
                // $woNumber->tanggal_fillpack   = $startfilling;
                $woNumber->expired_date       = date('Y-m-d',strtotime("+".$woNumber->product->expired_range." months", strtotime($woNumber->production_realisation_date)));
    
                $woNumber->wo_status             = '3';
                $woNumber->save();
                return redirect('/rollie/cpp-produk/form/'.$request->cpp_head_id);
            }
        }
        else
        {
            return redirect()->back()->with('error',$cekAkses['message']);
        }
    }
    public function hapusPalet(Request $request)
    {
        $cekAkses       = $this->CheckAksesHapus(\Request::getRequestUri(),'rollie.process_data.cpps');
        if ($cekAkses['success'] == true)
        {
            $palet      = Palet::find($this->decrypt($request->palet_id));
            $palet->deleted_by    = Auth::user()->id;    
            $palet->save();
            $palet->delete();
            return ['success'=>true,'message'=>'Palet '.$palet->cppDetail->lot_number.'-'.$palet->palet.' telah berhasil dihapus'];
        }
        else
        {
            return $cekAkses;
        }

    }
    public function closeCppProduct(Request $request)
    {
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'rollie.process_data.cpps');
        if ($cekAkses['success']) {
            $cpp_head_id    = $this->decrypt($request->cpp_head_id);
            $cppHead        = CppHead::find($cpp_head_id);

            foreach ($cppHead->cppDetails as $cppDetail)
            {
                foreach ($cppDetail->palets as $palet) 
                {
                    if ($palet->start=='' || is_null($palet->start) || empty($palet->start) || $palet->end=='' || is_null($palet->end) || empty($palet->end) || $palet->jumlah_box=='' || is_null($palet->jumlah_box) || empty($palet->jumlah_box)) 
                    {
                        return ['false'=>true,'message'=>'Harap lengkapi Start Palet, End Palet dan Jumlah Box terlebih dahulu dari seluruh data packing terlebih dahulu.'];       
                    }
                }
            }   
        
            $cppHead->cpp_status='1';
            $cppHead->save();

            foreach ($cppHead->woNumbers as $woNumber) 
            {
                $wo_number         = WoNumber::find($woNumber->id);
                if ($wo_number->rpdFillingHead->rpd_status == '1') 
                {
                    $wo_number->wo_status = '4';
                    $wo_number->save();
                }
            }
            return ['success'=>true,'message'=>'CPP Packing sudah terselesaikan.'];
        } else {
            return $cekAkses;
        }
        
    }
}