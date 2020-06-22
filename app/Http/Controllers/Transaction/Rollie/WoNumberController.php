<?php

namespace App\Http\Controllers\Transaction\Rollie;
use App\Http\Controllers\ResourceController;
use App\Models\Transaction\Rollie\WoNumber;
use App\Models\Master\Product;

use App\Imports\Rollie\ProductionSchedule\UploadMtol;
use App\Imports\Rollie\ProductionSchedule\ImportMtol;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;

class WoNumberController extends ResourceController
{
    public function addProductionSchedule(Request $request)
    {
        $cekAkses   = $this->CheckAksesTambah(\Request::getRequestUri(),'rollie.production_schedules');
        if ($cekAkses['success']) 
        {
            if ($request->hasFile('mtol_excel'))
            {
                $arrayekstensi  = ['xls','xlsx'];
                if (in_array($request->mtol_excel->getClientOriginalExtension(), $arrayekstensi)) 
                {
                    $filejadwal         = $request->file('mtol_excel');
                    $uploadjadwal       =   Excel::toArray(new UploadMtol, $filejadwal);
                    $cektidaknull       = array();
                    for ($i=4; $i < count($uploadjadwal['Mampu Telusur Produk Online (MT']) ; $i++) 
                    { 
                        if ($uploadjadwal['Mampu Telusur Produk Online (MT'][$i][3] !== "" && !is_null($uploadjadwal['Mampu Telusur Produk Online (MT'][$i][3]) && $uploadjadwal['Mampu Telusur Produk Online (MT'][$i][9] && !is_null($uploadjadwal['Mampu Telusur Produk Online (MT'][$i][9]) && $uploadjadwal['Mampu Telusur Produk Online (MT'][$i][8] !== "" && !is_null($uploadjadwal['Mampu Telusur Produk Online (MT'][$i][8])) 
                        {
                            if (strpos($uploadjadwal['Mampu Telusur Produk Online (MT'][$i][3], '/')) 
                            {
                                $patahkan           = explode('/',$uploadjadwal['Mampu Telusur Produk Online (MT'][$i][3]);
                                $kode_trial         = end($patahkan);
                                $cekproduk          = Product::where('trial_code',$kode_trial)->first();
                                if (is_null($cekproduk)) 
                                {
                                    
                                    return response()->json(['success' => false,'message'=>'Item '.$uploadjadwal['Mampu Telusur Produk Online (MT'][$i][9].' dengan kode oracle '.$uploadjadwal['Mampu Telusur Produk Online (MT'][$i][8].' belum terdaftar. Harap hubungi administrator mendaftarkan produk tersebut']);
                                }                            
                            } 
                            else
                            {
                                if ($uploadjadwal['Mampu Telusur Produk Online (MT'][$i][8] !== '7500147M' && $uploadjadwal['Mampu Telusur Produk Online (MT'][$i][8] !== '7500150M') 
                                {
                                    $cekproduk  = Product::where('oracle_code',$uploadjadwal['Mampu Telusur Produk Online (MT'][$i][8])->first();
                                    if (is_null($cekproduk)) 
                                    {
                                        return response()->json(['success'=>false,'message'=>'Item '.$uploadjadwal['Mampu Telusur Produk Online (MT'][$i][9].' dengan kode oracle '.$uploadjadwal['Mampu Telusur Produk Online (MT'][$i][8].' belum terdaftar. Harap hubungi administrator mendaftakan produk tersebut']);
                                    }
                                }
                                
                            }

                        }   
                    }
                    $uploadjadwal   = Excel::import(new UploadMtol, $filejadwal);
                    $draft_jadwal   = WoNumber::where('upload_status','0')->where('wo_status','0')->get();
                    return $data    = ['success'=>true,'message'=>"File Mtol Berhasil Di upload",'schedules'=>$draft_jadwal];
                    return response()->json($data);
                }
                else
                {
                    return back()->with('error','Harap Attach File Excel Mtol dengan Format XLS atau XLSX');
                }
            }
            else
            {
                return back()->with('error','Harap Attach File Excel Mtol');
            }
        }
        else
        {
            return redirect()->back()->with('error',$cekAkses['message']);
        }
    }

    public function getDetailWo($wo_id)
    {
        $wo_id                          = $this->decrypt($wo_id);
        $wo_number                      = WoNumber::find($wo_id);
        $wo_number->enkripsi_id         = $this->encrypt($wo_number->id);
        $product                        = $wo_number->product;
        $product->enkripsi_id           = $this->encrypt($wo_number->product->id);
        unset($wo_number->id);
        unset($wo_number->product->id);
        // $wo_number->id          = $enkripsi_id;
        return $wo_number;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateDataWo(Request $request)
    {

        $cekAkses       = $this->checkAksesUbah(\Request::getRequestUri(),'rollie.production_schedules');
        if ($cekAkses['success']) 
        {
            if ($request->params == 'draft') 
            {
                $wo_id                              = $this->decrypt($request->wo_number_id);
                $wo_number                          = WoNumber::find($wo_id);
                $wo_sebelum                         = $wo_number->wo_number;
                $plan_sebelum                       = $wo_number->production_plan_date;
                $wo_number->wo_number               = $request->wo_number;
                $wo_number->production_plan_date    = $request->production_plan_date;
                $wo_number->save();
                return ['success'=>true,'message'=>'Data Wo dengan nomor wo sebelumnya '.$wo_sebelum.' dan production plan date sebelumnya '.$plan_sebelum.'berhasil diubah menjadi nomor wo '.$wo_number->wo_number.' dan production plan date menjadi '.$wo_number->production_plan_date];   
            }
            else
            {
                // disini else
                $wo_id                                      = $this->decrypt($request->wo_number_id);
                $wo_number                                  = WoNumber::find($wo_id);
                $wo_sebelum                                 = $wo_number->wo_number;
                $wo_number->wo_number                       = $request->wo_number;
                $wo_number->production_realisation_date     = $request->production_realisation_date;
                $wo_number->wo_status                       = '2';
                $wo_number->save();
                return ['success'=>true,'message'=>'Data Wo '.$wo_sebelum.' berhasil diubah'];   
            }
        }
        else
        {
            return $cekAkses;
        }
    }

    public function finalizeWo(Request $request)
    {
        if (!is_null($request->wo_number[0])) 
        {
            /* ini untuk input data kalo memamng ada tambahan data wo*/
            $cekAkses       = $this->CheckAksesTambah(\Request::getRequestUri(),'rollie.production_schedules');
            if ($cekAkses['success']) 
            {
                $cek = WoNumber::all()->count();
                for ($i=0; $i < count($request->wo_number); $i++)
                { 
                    WoNumber::create([
                        "wo_number"             => $request->wo_number[$i],
                        "product_id"            => $request->product_id[$i],
                        "production_plan_date"  => $request->production_plan_date[$i],
                        "wo_status"             => '0',
                        "upload_status"         => '1',
                        "plan_id"               => '1'
                    ]);
                }
                $ceklagi = WoNumber::all()->count();

                if ($ceklagi <= $cek) 
                {
                    $input      = 'Gagal';
                    $message    = 'Ada kesalahan saat input, harap hubungi administrator aplikasi';
                }
                else
                {
                    if (!is_null($request->draft_id)) 
                    {
                        $wo_id          = explode(',',$request->draft_id);
                        foreach ($wo_id as $idnya) 
                        {
                            $wo = WoNumber::find($this->decrypt($idnya));
                            $wo->upload_status  ='1';
                            $wo->save();
                        }
                    }
                    $input      = 'Berhasil';
                    $message    = 'Yeaayy Berhasil';   
                }
            } 
            else 
            {
                $input      = 'gagal'; 
                $message    = $cekAkses['message'];
            }
            if ($input == 'Berhasil') 
            {
                return redirect(route('rollie.production_schedules'))->with('success','Jadwal produksi berhasil dibuat');
            }
            else
            {
                return redirect(route('rollie.production_schedules'))->with('error',$message);
            }
        }
        else
        {

            if ($request->draft_id == '' || is_null($request->draft_id)) 
            {
                return redirect()->back()->with('error','Harap input wo dengan mengklik tambah jadwal atau upload mtol untuk ditambahkan ke jadwal');
            }
            else
            {
                $wo_id          = explode(',',$request->draft_id);
                foreach ($wo_id as $idnya) 
                {
                    $wo = WoNumber::find($this->decrypt($idnya));
                    $wo->upload_status  ='1';
                    $wo->save();
                }
                return redirect(route('rollie.production_schedules'))->with('success','Jadwal produksi berhasil dibuat');

            }
        }

    }
    public function hapusWo(Request $request)
    {
        $cekAkses   = $this->checkAksesHapus(\Request::getRequestUri(),'rollie.production_schedules');
        if ($cekAkses['success']) 
        {
            $wo_number_id   = $request->wo_number_id;
            $woNumberData   = WoNumber::find($this->decrypt($wo_number_id)); 
            $woNumber       = WoNumber::destroy($this->decrypt($wo_number_id));
            return ['success'=>true,'message'=>'Produk '.$woNumberData->product->product_name.' dengan nomor wo '.$woNumberData->wo_number.' telah berhasil dihapus'];
        } 
        else 
        {
            return $cekAkses;
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction\Rollie\WoNumber  $woNumber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WoNumber $woNumber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction\Rollie\WoNumber  $woNumber
     * @return \Illuminate\Http\Response
     */
    public function destroy(WoNumber $woNumber)
    {
        //
    }
}
