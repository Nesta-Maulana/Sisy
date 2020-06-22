<?php

namespace App\Http\Controllers\energy_monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\ResourceController;

use App\Models\energy_monitoring\Bagian;
use App\Models\energy_monitoring\Pengamatan;
use App\Models\energy_monitoring\Penggunaan;
use App\Models\energy_monitoring\Workcenter;

use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Jenssegers\Agent\Agent;
use \Carbon\Carbon;
use DB;
use Auth;
class PengamatanController extends ResourceController
{
    public function simpanPengamatan(Request $request)
    {
    	$bagian_id 			= $this->decrypt($request->bagian_id);
    	$hasil_pengamatan	= $request->hasil_pengamatan;
    	$nilai_pengamatan_sebelum 	= Pengamatan::where('bagian_id',$bagian_id)->latest()->first();
    	if (!is_null($nilai_pengamatan_sebelum) && $nilai_pengamatan_sebelum->nilai_meteran > $hasil_pengamatan) 
    	{
    		return ['success' => false,'message' => 'Nilai meteran anda lebih kecil dari nilai meteran dipengamatan terakhir. Harap periksa kembali nilai meteran yang anda masukan.'];
    	}
    	else
    	{
    		$now 			= Carbon::now('Asia/Jakarta');
	        $waktu_sekarang = $now->toTimeString();
	        // ini pengaturan tanggal berdasar pergantian waktu dari jam 6 a.m ke jam 5.59 am esok hari cut off nya jam 6
	        if($waktu_sekarang > '06:00')
	        {
	            $tanggal_sekarang =  Carbon::today('Asia/Jakarta');
	            $tanggal_besok =  Carbon::tomorrow('Asia/Jakarta');
	        }
	        else
	        {
	            $tanggal_sekarang =  Carbon::yesterday('Asia/Jakarta');
	            $tanggal_besok =  Carbon::today('Asia/Jakarta');
	        }
			// Input Pengamatan dan penggunaan
	        $pengamatanbagiansebelum = Pengamatan::where('bagian_id', $bagian_id)->latest()->first();
	        if($pengamatanbagiansebelum)
	        {
	            $nilai_penggunaan = $hasil_pengamatan - $pengamatanbagiansebelum->nilai_meteran;
	        }
	        else
	        {
	            $nilai_penggunaan = $hasil_pengamatan;
	        }
	        Pengamatan::create([
	            'bagian_id' 	=> $bagian_id,
	            'nilai_meteran' => $hasil_pengamatan,
	            'waktu_pengamatan' => Carbon::now(),
	            'user_id' 		=> Auth::user()->id,
	        ]);

	        $yesterday = Carbon::yesterday('Asia/Jakarta');
	        Penggunaan::create([
	            'bagian_id' => $bagian_id,
	            'nilai' => $nilai_penggunaan,
	            'tanggal_penggunaan' => $yesterday
	        ]);

	        $cekCoolingTower = Penggunaan::where('bagian_id', '69')->whereBetween('tanggal_penggunaan', [$tanggal_sekarang . ' 06:00:00', $tanggal_besok . ' 05:59:59']);
	        $cekDeminWaterProduksiNfi = Penggunaan::where('bagian_id', '117')->whereBetween('tanggal_penggunaan', [$tanggal_sekarang . ' 06:00:00', $tanggal_besok . ' 05:59:59']);
	        $cekSoftWaterNfi = Penggunaan::where('bagian_id', '118')->whereBetween('tanggal_penggunaan', [$tanggal_sekarang . ' 06:00:00', $tanggal_besok . ' 05:59:59']);
	        $cekNfiProduksi = Penggunaan::where('bagian_id', '119')->whereBetween('tanggal_penggunaan', [$tanggal_sekarang . ' 06:00:00', $tanggal_besok . ' 05:59:59']);
	        // Plant Utility    
	        if($bagian_id == '50')
	        {

	            if($cekCoolingTower->count() == '0')
	            {
	                Penggunaan::create([
	                    'bagian_id' => '69',
	                    'nilai' => $hasil_pengamatan,
	                    'tanggal_penggunaan' => Carbon::now()
	                ]);
	            } 
	            else
	            {
	                $penggunaan 		= $cekCoolingTower->first();
	                $penggunaan->nilai 	= $penggunaan->nilai + $hasil_pengamatan;
	                $penggunaan->save();
	            }
	        }
	        // Plant Chiller, Boiler, Compesasor
	        else if ($bagian_id == '51' || $bagian_id == '52' || $bagian_id == '53' || $bagian_id == '54')
	        {
	            if($cekCoolingTower->count() == '0')
	            {
	                Penggunaan::create([
	                    'bagian_id' => '69',
	                    'nilai' => '-' . $hasil_pengamatan,
	                    'tanggal_penggunaan' => Carbon::now()
	                ]);
	            } 
	            else
	            {
	                $penggunaan = $cekCoolingTower->first();
	                $penggunaan->nilai = $penggunaan->nilai - $hasil_pengamatan;
	                $penggunaan->save();
	            }
	        }


	        else if($bagian_id == '88')
	        {
	            if($cekDeminWaterProduksiNfi->count() == '0')
	            {
	                Penggunaan::create([
	                    'bagian_id' => '117',
	                    'nilai' => $hasil_pengamatan,
	                    'tanggal_penggunaan' => Carbon::now()
	                ]);
	            } 
	            else
	            {
	                $penggunaan 		= $cekDeminWaterProduksiNfi->first();
	                $penggunaan->nilai 	= $penggunaan->nilai + $hasil_pengamatan;
	                $penggunaan->save();
	            }
	        }
	                    // Demin Water Boiler, Demin Water HB, Demin Water Ruby
	        else if ($bagian_id == '89' || $bagian_id == '90' || $bagian_id == '91' )
	        {
	            if($cekDeminWaterProduksiNfi->count() == '0')
	            {
	                Penggunaan::create([
	                    'bagian_id' => '117',
	                    'nilai' => '-' . $hasil_pengamatan,
	                    'tanggal_penggunaan' => $tanggal_sekarang
	                ]);
	            } 
	            else
	            {
	                $penggunaan = $cekDeminWaterProduksiNfi->first();
	                $penggunaan->nilai = $penggunaan->nilai - $hasil_pengamatan;
	                $penggunaan->save();
	            }
	        }
	        // Soft Water Produksi NFI
	        else if($bagian_id == '92' || $bagian_id == '93')
	        {
	            if($cekSoftWaterNfi->count() == '0')
	            {
	                Penggunaan::create([
	                    'bagian_id' => '118',
	                    'nilai' => $hasil_pengamatan,
	                    'tanggal_penggunaan' => $tanggal_sekarang
	                ]);
	            } 
	            else
	            {
	                $penggunaan = $cekSoftWaterNfi->first();
	                $penggunaan->nilai = $penggunaan->nilai + $hasil_pengamatan;
	                $penggunaan->save();
	            }
	        }
	        // Soft Water Ruby, Non Produksi, Gedung Depan, kantin, lubrikasi, cooling tower
	        else if ($bagian_id == '94' || $bagian_id == '95' || $bagian_id == '96' || $bagian_id == '97' || $bagian_id == '98' || $bagian_id == '99' || $bagian_id == '100' || $bagian_id == '102'){
	            if($cekSoftWaterNfi->count() == '0')
	            {
	                Penggunaan::create([
	                    'bagian_id' => '118',
	                    'nilai' => '-' . $hasil_pengamatan,
	                    'tanggal_penggunaan' => $tanggal_sekarang
	                ]);
	            } 
	            else
	            {
	                $penggunaan = $cekSoftWaterNfi->first();
	                $penggunaan->nilai = $penggunaan->nilai - $hasil_pengamatan;
	                $penggunaan->save();
	            }
	        }
	        // NFI Produksi -> workcenter gas(steam)
	        else if($bagian_id == '112')
	        {
	            if($cekNfiProduksi->count() == '0')
	            {
	                Penggunaan::create([
	                    'bagian_id' => '119',
	                    'nilai' => $hasil_pengamatan,
	                    'tanggal_penggunaan' => $tanggal_sekarang
	                ]);
	            } 
	            else
	            {
	                $penggunaan = $cekNfiProduksi->first();
	                $penggunaan->nilai = $penggunaan->nilai + $hasil_pengamatan;
	                $penggunaan->save();
	            }
	        }
	        // HNI Ruby
	        else if ($bagian_id == '113')
	        {
	            if($cekNfiProduksi->count() == '0')
	            {
	                Penggunaan::create([
	                    'bagian_id' => '119',
	                    'nilai' => '-' . $hasil_pengamatan,
	                    'tanggal_penggunaan' => $tanggal_sekarang
	                ]);
	            } 
	            else
	            {
	                $penggunaan = $cekNfiProduksi->first();
	                $penggunaan->nilai = $penggunaan->nilai - $hasil_pengamatan;
	                $penggunaan->save();
	            }
	        }

	        return ['success' => true,'message' => 'Hasil Pengamtan Berhasil disimpan'];	
    	}
    	
        
    }
    public function editPengamatan(Request $request)
    {
    	if ($request->pengamatan_id_edit !== '0') 
    	{
    		$now 			= Carbon::now('Asia/Jakarta');
    		$pengamatanbagian 			= Pengamatan::where('id', $this->decrypt($request->pengamatan_id_edit))->latest()->first();
	        $pengamatan 				= Pengamatan::find($this->decrypt($request->pengamatan_id_edit));
	        $nilailama  				= $pengamatan->nilai_meteran;
	        $pengamatan->nilai_meteran 	= $request->nilai_pengamatan;
	        $pengamatan->user_update 	= Auth::user()->id;
	        $pengamatan->save();

	        $penggunaan 				= Penggunaan::where('bagian_id',$this->decrypt($request->bagian_id_edit))->latest()->first();
	        // if ($nilailama > $request->nilai_pengamatan) 
	        // {
	        	
	        // }
	        $nilai 						= $penggunaan->nilai + $pengamatanbagian->nilai_meteran;
	        $nilai 						= $nilai - $request->nilai_pengamatan;
	        $penggunaan->nilai 			= $nilai;
	        $penggunaan->save();
	        return $now;
    	}
    	else
    	{
    		$pengamatanbagian = Pengamatan::where('bagian_id', $this->decrypt($request->bagian_id_edit))->latest()->first();
        	$now = Carbon::now('Asia/Jakarta');
	        $time = $now->toTimeString();
	        $pengamatan 				= new Pengamatan();
	        $pengamatan->nilai_meteran 	= $request->nilai_pengamatan;
	        $pengamatan->user_id 		= Auth::user()->id;
	        $pengamatan->bagian_id      =$this->decrypt($request->bagian_id_edit);
	        $pengamatan->waktu_pengamatan   = $request->waktu_pengamatan_edit . ' ' . $time;
	        $pengamatan->save(['timestamps' => true]);

	        $yesterday = $pengamatan->created_at;
	        $yesterday = $yesterday->toDateString();
	        $yesterday = explode('-', $yesterday);
	        $yesterday = Carbon::createFromDate($yesterday[0], $yesterday[1], $yesterday[2]);
	        $yesterday = $yesterday->addDay('-1');
	        $yesterday = $yesterday->toDateString();

	        if($pengamatanbagian)
	        {
	            $nilai = $pengamatanbagian->nilai_meteran - $request->nilai_pengamatan;
	            
	        }
	        else
	        {
	            $nilai = $request->nilai_pengamatan;
	        }
	    
	        Penggunaan::create([
	            'bagian_id' => $this->decrypt($request->bagian_id_edit),
	            'nilai' => $nilai,
	            'tanggal_penggunaan' => $yesterday
	        ]);

	        return $now;
    	}
    }
}
