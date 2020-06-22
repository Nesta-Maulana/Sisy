<?php

namespace App\Http\Controllers\Transaction\Rollie;

use App\Models\Transaction\Rollie\AnalisaKimia;
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
class AnalisaKimiaController extends ResourceController
{
    public function analisaFisikokimia(Request $request)
    {
        $params     = $this->decrypt($request->params);
        $cekAkses           = $this->CheckAksesTambah(\Request::getRequestUri(),'rollie.analysis_data.'.$params);
        if ($cekAkses['success'] == true) 
        {
            $cpp_head_id        = $this->decrypt($request->cpp_head_id);
            $cppHead            = cppHead::find($cpp_head_id);
            $analisaKimia       = AnalisaKimia::create([
                'progress_status'        => '0',
                'cpp_head_id'   => $cppHead->id,
            ]);
            $cppHead->analisa_kimia_id    = $analisaKimia->id;
            $cppHead->save();
            return ['success'=>true, 'message' => 'Form analisa kimia siap diisi, anda akan dialihkan secara otomatis oleh sistem kami','analisa_kimia_id'=>$this->encrypt($analisaKimia->id),'params'=>$request->params];               
        } 
        else 
        {
            return $cekAkses;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inputAnalisaKimia(Request $request)
    {
        $params     = $this->decrypt($request->params);
        $cekAkses   = $this->CheckAksesUbah(\Request::getRequestUri(),'rollie.analysis_data.'.$params);                    
        if ($cekAkses['success']) 
        {
            $analisa_kimia_id               = $request->analisa_kimia_id;
            $product_name                   = $request->product_name;
            $oracle_code                    = $request->oracle_code;
            $spek_ts_min                    = $request->spek_ts_min;
            $spek_ts_max                    = $request->spek_ts_max;
            $spek_ph_min                    = $request->spek_ph_min;
            $spek_ph_max                    = $request->spek_ph_max;
            $wo_number                      = $request->wo_number;
            $production_realisation_date    = $request->production_realisation_date;
            $filling_machine                = $request->filling_machine;
            $lot_number                     = $request->lot_number;
            $ts_awal_1                      = $request->ts_awal_1;
            $ts_awal_2                      = $request->ts_awal_2;
            $ts_awal_avg                    = $request->ts_awal_avg;
            $ts_tengah_1                    = $request->ts_tengah_1;
            $ts_tengah_2                    = $request->ts_tengah_2;
            $ts_tengah_avg                  = $request->ts_tengah_avg;
            $ts_akhir_1                     = $request->ts_akhir_1;
            $ts_akhir_2                     = $request->ts_akhir_2;
            $ts_akhir_avg                   = $request->ts_akhir_avg;
            $ph_awal                        = $request->ph_awal;
            $ph_tengah                      = $request->ph_tengah;
            $ph_akhir                       = $request->ph_akhir;
            $sensori_awal                   = $request->sensori_awal;
            $sensori_tengah                 = $request->sensori_tengah;
            $sensori_akhir                  = $request->sensori_akhir;
            $visko_awal                     = $request->visko_awal;
            $visko_tengah                   = $request->visko_tengah;
            $visko_akhir                    = $request->visko_akhir;
            $jam_filling_awal               = $request->jam_filling_awal;
            $jam_filling_tengah             = $request->jam_filling_tengah;
            $jam_filling_akhir              = $request->jam_filling_akhir;
            $kode_batch_standar             = $request->kode_batch_standar;
            $analisa_kimia_status           = $request->analisa_kimia_status;
            $type_input                     = $request->type_input;
            $ambil_palet                    = ''; /* ini digunakan untuk parameter ketidak sesuaian ada di rentang palet mana awal atau tengah atau akhir */
            $keterangan_awal                = ''; /* ini digunakan untuk keterangan awal palet apabila ada ketidaksesuaian */
            $keterangan_tengah              = ''; /* ini digunakan untuk keterangan tengah palet apabila ada ketidaksesuaian */
            $keterangan_akhir               = '';/* ini digunakan untuk keterangan akhir palet apabila ada ketidaksesuaian */
            if ($ts_awal_avg < $spek_ts_min ) 
            {
                if (strpos($ambil_palet,'Awal')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Awal ";
                }

                if (strpos($keterangan_awal,'TS DROP'))
                {
                    $keterangan_awal = $keterangan_awal;
                }
                else
                {
                    $keterangan_awal = $keterangan_awal."TS DROP ";
                }
            }
            if ($ts_tengah_avg < $spek_ts_min ) 
            {
                if (strpos($ambil_palet,'Tengah')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Tengah ";
                }

                if (strpos($keterangan_tengah,'TS DROP'))
                {
                    $keterangan_tengah = $keterangan_tengah;
                }
                else
                {
                    $keterangan_tengah = $keterangan_tengah."TS DROP ";
                }
            }
            if ($ts_akhir_avg < $spek_ts_min ) 
            {
                if (strpos($ambil_palet,'Akhir')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Akhir ";
                }

                if (strpos($keterangan_akhir,'TS DROP'))
                {
                    $keterangan_akhir = $keterangan_akhir;
                }
                else
                {
                    $keterangan_akhir = $keterangan_akhir."TS DROP ";
                }
            }

            if ($ts_awal_avg > $spek_ts_max ) 
            {
                if (strpos($ambil_palet,'Awal')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Awal ";
                }

                if (strpos($keterangan_awal,'TS OVER'))
                {
                    $keterangan_awal = $keterangan_awal;
                }
                else
                {
                    $keterangan_awal = $keterangan_awal."TS OVER ";
                }
            }
            if ($ts_tengah_avg > $spek_ts_max ) 
            {
                if (strpos($ambil_palet,'Tengah')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Tengah ";
                }

                if (strpos($keterangan_tengah,'TS OVER'))
                {
                    $keterangan_tengah = $keterangan_tengah;
                }
                else
                {
                    $keterangan_tengah = $keterangan_tengah."TS OVER ";
                }
            }
            if ($ts_akhir_avg > $spek_ts_max ) 
            {
                if (strpos($ambil_palet,'Akhir')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Akhir ";
                }

                if (strpos($keterangan_akhir,'TS Akhir'))
                {
                    $keterangan_akhir = $keterangan_akhir;
                }
                else
                {
                    $keterangan_akhir = $keterangan_akhir."TS Akhir ";
                }
            }

            if ($ph_awal < $spek_ph_min ) 
            {
                if (strpos($ambil_palet,'Awal')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Awal ";
                }

                if (strpos($keterangan_awal,'pH DROP'))
                {
                    $keterangan_awal = $keterangan_awal;
                }
                else
                {
                    $keterangan_awal = $keterangan_awal."pH DROP ";
                }
            }
            if ($ph_tengah < $spek_ph_min ) 
            {
                if (strpos($ambil_palet,'Tengah')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Tengah ";
                }

                if (strpos($keterangan_tengah,'pH DROP'))
                {
                    $keterangan_tengah = $keterangan_tengah;
                }
                else
                {
                    $keterangan_tengah = $keterangan_tengah."pH DROP ";
                }
            }
            if ($ph_akhir < $spek_ph_min ) 
            {
                if (strpos($ambil_palet,'Akhir')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Akhir ";
                }

                if (strpos($keterangan_akhir,'pH DROP'))
                {
                    $keterangan_akhir = $keterangan_akhir;
                }
                else
                {
                    $keterangan_akhir = $keterangan_akhir."pH DROP ";
                }
            }
            
            if ($ph_awal > $spek_ph_max ) 
            {
                if (strpos($ambil_palet,'Awal')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Awal ";
                }

                if (strpos($keterangan_awal,'pH OVER'))
                {
                    $keterangan_awal = $keterangan_awal;
                }
                else
                {
                    $keterangan_awal = $keterangan_awal."pH OVER ";
                }
            }
            if ($ph_tengah > $spek_ph_max ) 
            {
                if (strpos($ambil_palet,'Tengah')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Tengah ";
                }

                if (strpos($keterangan_tengah,'pH OVER'))
                {
                    $keterangan_tengah = $keterangan_tengah;
                }
                else
                {
                    $keterangan_tengah = $keterangan_tengah."pH OVER ";
                }
            }
            if ($ph_akhir > $spek_ph_max ) 
            {
                if (strpos($ambil_palet,'Akhir')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Akhir ";
                }

                if (strpos($keterangan_akhir,'pH Over'))
                {
                    $keterangan_akhir = $keterangan_akhir;
                }
                else
                {
                    $keterangan_akhir = $keterangan_akhir."pH Over ";
                }
            }

            if ($sensori_awal === '#OK' ) 
            {
                if (strpos($ambil_palet,'Awal')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Awal ";
                }

                if (strpos($keterangan_awal,'Sensori Awal #OK'))
                {
                    $keterangan_awal = $keterangan_awal;
                }
                else
                {
                    $keterangan_awal = $keterangan_awal."Sensori Awal #OK ";
                }
            }
            if ($sensori_tengah === '#OK' ) 
            {
                if (strpos($ambil_palet,'Tengah')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Tengah ";
                }

                if (strpos($keterangan_tengah,'Sensori Tengah #OK'))
                {
                    $keterangan_tengah = $keterangan_tengah;
                }
                else
                {
                    $keterangan_tengah = $keterangan_tengah."Sensori Tengah #OK ";
                }
            }
            if ($sensori_akhir === '#OK' ) 
            {
                if (strpos($ambil_palet,'Akhir')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Akhir ";
                }

                if (strpos($keterangan_akhir,'Sensori Akhir #OK'))
                {
                    $keterangan_akhir = $keterangan_akhir;
                }
                else
                {
                    $keterangan_akhir = $keterangan_akhir."Sensori Akhir #OK ";
                }
            }
            if (strpos($analisa_kimia_status, '#OK') !== false && $ambil_palet !== '') 
            {
                $analisa_kimia_status                   = '0';
            }
            else
            {
                $analisa_kimia_status                   = '1';
            }
            $analisaKimia                       = AnalisaKimia::find($this->decrypt($analisa_kimia_id));
            $analisaKimia->ts_awal_1            = $ts_awal_1;
            $analisaKimia->ts_awal_2            = $ts_awal_2;
            $analisaKimia->ts_awal_avg          = $ts_awal_avg;
            $analisaKimia->ts_tengah_1          = $ts_tengah_1;
            $analisaKimia->ts_tengah_2          = $ts_tengah_2;
            $analisaKimia->ts_tengah_avg        = $ts_tengah_avg;
            $analisaKimia->ts_akhir_1           = $ts_akhir_1;
            $analisaKimia->ts_akhir_2           = $ts_akhir_2;
            $analisaKimia->ts_akhir_avg         = $ts_akhir_avg;
            $analisaKimia->ph_awal              = $ph_awal;
            $analisaKimia->ph_tengah            = $ph_tengah;
            $analisaKimia->ph_akhir             = $ph_akhir;
            $analisaKimia->sensori_awal         = $sensori_awal;
            $analisaKimia->sensori_tengah       = $sensori_tengah;
            $analisaKimia->sensori_akhir        = $sensori_akhir;
            $analisaKimia->visko_awal           = $visko_awal;
            $analisaKimia->visko_tengah         = $visko_tengah;
            $analisaKimia->visko_akhir          = $visko_akhir;
            $analisaKimia->jam_filling_awal     = $jam_filling_awal;
            $analisaKimia->jam_filling_tengah   = $jam_filling_tengah;
            $analisaKimia->jam_filling_akhir    = $jam_filling_akhir;
            $analisaKimia->kode_batch_standar   = $kode_batch_standar;
            $analisaKimia->analisa_kimia_status = $analisa_kimia_status;
            $analisaKimia->save();
            /* dd($type_input); */
            switch ($type_input) 
            {
                case 'draft':
                    return redirect(route('rollie.analysis_data.'.$params))->with('success','Data analisa fisikokimia produk '.$analisaKimia->cppHead->product->product_name.' dengan tanggal produksi '.$production_realisation_date.' berhasil di update');
                break;
                
                case 'save':
                    $analisaKimia->progress_status      = '1';
                    $analisaKimia->save();
                    if ($analisa_kimia_status == '1')
                    {
                        return redirect(route('rollie.analysis_data.'.$params))->with('success','Data analisa fisikokimia produk '.$analisaKimia->cppHead->product->product_name.' dengan tanggal produksi '.$production_realisation_date.' berhasil di input');
                    }
                    else
                    {
                        $route  = route('rollie.analysis_data.'.$params);
                        $route  = explode('rollie/',$route);
                        return redirect('/rollie/'.$route[1].'/'.'form/'.$this->encrypt($analisaKimia->id))->with('infonya','Data analisa kimia produk '.$analisaKimia->cppHead->product->product_name." #OK . Harap melengkapi form PPQ untuk tindakan Koreksi");
                    }

                break;
                
            }    
        } 
        else 
        {
            return redirect()->back()->with('error',$cekAkses['message']);
        }
        
    }
    public function editAnalisaKimia(Request $request)
    {
        $cekAkses       = $this->checkAksesUbah(\Request::getRequestUri(),'rollie.analysis_data.'.$this->decrypt($request->params));
        if ($cekAkses['success'])
        {
            $analisaKimia                   = AnalisaKimia::find($this->decrypt($request->analisa_kimia_id));
            if ($analisaKimia->analisa_kimia_status == '1') 
            {
                $analisaKimia->progress_status  = '0';
                $analisaKimia->save();
                return ['success'=>true,'message'=>'Analisa fisikokimia siap untuk diinput kembali, harap input data sesuai dengan data real dilapangan','params'=>$request->params,'analisa_kimia_id'=>$request->analisa_kimia_id];
            }
            else
            {
                return ['success'=>false,'message'=>'Status analisa fisikokimia tidak OK . Untuk merevisi hasil analisa bila tidak sesuai harap hubungi administrator aplikasi'];
            }
        } 
        else 
        {
            return $cekAkses;
        }
        
    }

    public function updateTsOven(Request $request)
    {
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'rollie.analysis_data.fiskokimias_qc_penyelia');
        if ($cekAkses['success']) 
        {
            $analisaKimia                   = AnalisaKimia::find($this->decrypt($request->analisa_kimia_id));
            $analisaKimia->ts_oven_awal     = $request->ts_oven_awal; 
            $analisaKimia->ts_oven_tengah   = $request->ts_oven_tengah; 
            $analisaKimia->ts_oven_akhir    = $request->ts_oven_akhir; 
            $analisaKimia->save();
            return ['success'=>true,'message'=>'Data ts oven berhasil di update'];
        } 
        else 
        {
            return $cekAkses;
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction\Rollie\AnalisaKimia  $analisaKimia
     * @return \Illuminate\Http\Response
     */
    public function show(AnalisaKimia $analisaKimia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction\Rollie\AnalisaKimia  $analisaKimia
     * @return \Illuminate\Http\Response
     */
    public function edit(AnalisaKimia $analisaKimia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction\Rollie\AnalisaKimia  $analisaKimia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnalisaKimia $analisaKimia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction\Rollie\AnalisaKimia  $analisaKimia
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnalisaKimia $analisaKimia)
    {
        //
    }
}
