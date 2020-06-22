<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ResourceController;

use App\Models\Master\Menu;
use App\Models\Master\MenuPermission;
use App\Models\Master\Application;
use App\Models\Master\ApplicationPermission;
use App\Models\Master\User;

use App\Models\energy_monitoring\Bagian;
use App\Models\energy_monitoring\KategoriMeteran;
use App\Models\energy_monitoring\Pengamatan;
use App\Models\energy_monitoring\Penggunaan;
use App\Models\energy_monitoring\Workcenter;

use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Jenssegers\Agent\Agent;
use \Carbon\Carbon;
use DB;
use Auth;
class EmonController extends ResourceController
{
	
	public function __construct()
	{
		$this->application 	= Application::where('application_name','Energy Monitoring')->first();
    	$this->menus 		= $this->application->menus->where('parent_id','0')->where('is_active','1');  		
    }
	public function homeOperator()
	{
		$bagian 	= Bagian::all();
        $now 		= Carbon::today('Asia/Jakarta');
        foreach ($bagian as $key => $meteran) 
        {
        	$pengamatan 	= Pengamatan::where('bagian_id',$meteran->id)->whereDate('waktu_pengamatan',$now)->first();
        	if (!is_null($pengamatan)) 
        	{
        		unset($bagian[$key]);
        	}
        }
		$akses        	= Menu::where('application_id',$this->application->id)->whereIn('id',['42','43','44','45'])->where('is_active','1')->get();
		
        // $aksesmenu 		= array();
        foreach ($akses as $menu) 
        {
        	foreach ($menu->menuPermissions as $hak_akses_menu) 
	        {
	        	if ($hak_akses_menu->user_id == Auth::user()->id) 
	        	{
	        		$array_menu['menu'] 	= $menu;
					$array_menu['akses'] 	= $hak_akses_menu->view;
	        		$namanya 				= explode(' ',$menu->menu_name);
					$namanya 				= $namanya[1];
					$aksesmenu[strtolower($namanya)] =  $array_menu;
					unset($array_menu);
				}
	        }
		}
		return view('energy_monitoring.home-operator',['menus'=>$this->menus,'bagian'=>$bagian,'akses'=>$aksesmenu]);
	}
	public function showPengamatanAir()
	{
		$workcenter = Workcenter::where('status','1')->get();
		foreach ($workcenter as $key => $work) 
		{
			if ($work->kategoriMeteran->kategori !== 'Air') 
			{
				unset($workcenter[$key]);
			}
		}
		return view('energy_monitoring.home-pengamatan',['menus'=>$this->menus,'workcenter'=>$workcenter]);
	}
	public function showAirFilter($workcenter_id,$jenis_kirim)
	{
		$workcenter_id 	= $this->decrypt($workcenter_id);
		$jenis_kirim 	= $this->decrypt($jenis_kirim);
		switch ($jenis_kirim) 
		{
			case 'ajax':
				$workcenter 	= Workcenter::find($workcenter_id);
        		$now 			= Carbon::today('Asia/Jakarta');
				foreach ($workcenter->Bagian as $key => $bagian)
				{
					$bagian->protected_id 	= $this->encrypt($bagian->id);
					$bagian->satuan 		= $bagian->satuan;
        			$pengamatan 			= Pengamatan::where('bagian_id',$bagian->id)->whereDate('waktu_pengamatan',$now)->first();
        			$bagian->pengamatan 	= $pengamatan;
				}
				return $workcenter;
			break;
			case 'page':
				$workcenter = Workcenter::where('status','1')->get();
				foreach ($workcenter as $key => $work) 
				{
					if ($work->kategoriMeteran->kategori !== 'Air') 
					{
						unset($workcenter[$key]);
					}
				}
				$filterworkcenter 	= Workcenter::find($workcenter_id);
				return view('energy_monitoring.home-pengamatan',['menus'=>$this->menus,'workcenter'=>$workcenter,'workcenter_active'=>$filterworkcenter]);
			break;
		}
	}
	public function showPengamatanGas()
	{
		$workcenter = Workcenter::where('status','1')->get();
		foreach ($workcenter as $key => $work) 
		{
			if ($work->kategoriMeteran->kategori !== 'Gas') 
			{
				unset($workcenter[$key]);
			}
		}
		return view('energy_monitoring.home-pengamatan',['menus'=>$this->menus,'workcenter'=>$workcenter]);
	}
	public function showGasFilter($workcenter_id,$jenis_kirim)
	{
		$workcenter_id 	= $this->decrypt($workcenter_id);
		$jenis_kirim 	= $this->decrypt($jenis_kirim);
		switch ($jenis_kirim) 
		{
			case 'ajax':
				$workcenter 	= Workcenter::find($workcenter_id);
        		$now 		= Carbon::today('Asia/Jakarta');

				foreach ($workcenter->Bagian as $key => $bagian)
				{
					$bagian->protected_id 	= $this->encrypt($bagian->id);
					$bagian->satuan 		= $bagian->satuan;
        			$pengamatan 			= Pengamatan::where('bagian_id',$bagian->id)->whereDate('waktu_pengamatan',$now)->first();
        			$bagian->pengamatan 	= $pengamatan;
				}
				return $workcenter;
			break;
			case 'page':
				$workcenter = Workcenter::where('status','1')->get();
				foreach ($workcenter as $key => $work) 
				{
					if ($work->kategoriMeteran->kategori !== 'Gas') 
					{
						unset($workcenter[$key]);
					}
				}
				$filterworkcenter 	= Workcenter::find($workcenter_id);
				return view('energy_monitoring.home-pengamatan',['menus'=>$this->menus,'workcenter'=>$workcenter,'workcenter_active'=>$filterworkcenter]);
			break;
			
			
		}
	}
	public function showPengamatanListrik()
	{
		$workcenter = Workcenter::where('status','1')->get();
		foreach ($workcenter as $key => $work) 
		{
			if ($work->kategoriMeteran->kategori !== 'Listrik') 
			{
				unset($workcenter[$key]);
			}
		}
		return view('energy_monitoring.home-pengamatan',['menus'=>$this->menus,'workcenter'=>$workcenter]);
	}
	public function showListrikFilter($workcenter_id,$jenis_kirim)
	{
		$workcenter_id 	= $this->decrypt($workcenter_id);
		$jenis_kirim 	= $this->decrypt($jenis_kirim);
		switch ($jenis_kirim) 
		{
			case 'ajax':
				$workcenter 	= Workcenter::find($workcenter_id);
        		$now 		= Carbon::today('Asia/Jakarta');

				foreach ($workcenter->Bagian as $key => $bagian)
				{
					$bagian->protected_id 	= $this->encrypt($bagian->id);
					$bagian->satuan 		= $bagian->satuan;
        			$pengamatan 			= Pengamatan::where('bagian_id',$bagian->id)->whereDate('waktu_pengamatan',$now)->first();
        			$bagian->pengamatan 	= $pengamatan;
				}
				return $workcenter;
			break;
			case 'page':
				$workcenter = Workcenter::where('status','1')->get();
				foreach ($workcenter as $key => $work) 
				{
					if ($work->kategoriMeteran->kategori !== 'listrik') 
					{
						unset($workcenter[$key]);
					}
				}
				$filterworkcenter 	= Workcenter::find($workcenter_id);
				return view('energy_monitoring.home-pengamatan',['menus'=>$this->menus,'workcenter'=>$workcenter,'workcenter_active'=>$filterworkcenter]);
			break;
			
			
		}
	}
	public function showDatabasePengamatan()
	{
		$jenis_pengamatan 	= KategoriMeteran::where('status','1')->get(); 	
		return view('energy_monitoring.home-database',['menus'=>$this->menus,'jenis_pengamatan'=>$jenis_pengamatan]);
	}

	public function databaseFilterWorkcenter($jenis_pengamatan_id)
	{
		$jenis_pengamatan_id	= $this->decrypt($jenis_pengamatan_id);
		$workcenter 			= Workcenter::where('kategori_id',$jenis_pengamatan_id)->get();
		foreach ($workcenter as $wc) 
		{
			$wc->protected_id = $this->encrypt($wc->id);
		}
		return $workcenter;
	}
	public function databaseFilterTable($workcenter_id,$tanggal_filter)
	{
		$workcenter_id 	= $this->decrypt($workcenter_id);
		if ($tanggal_filter == 'all') 
		{
			$bagian 	= Bagian::where('workcenter_id',$workcenter_id)->get();

			foreach ($bagian as $bagians) 
			{
				$bagians->protected_id 	= $this->encrypt($bagians->id);
				$bagians->satuannya 	= $bagians->satuan->satuan;
				foreach ($bagians->Pengamatan as $pengamatan) 
				{
					$pengamatan->protected_id = $this->encrypt($pengamatan->id);
				
				}
			}
			return $bagian;
		}
		else
		{
			$bagian 	= Bagian::where('workcenter_id',$workcenter_id)->get();
			// dd($bagian);
			foreach ($bagian as $bagians) 
			{
				$bagians->satuannya 	= $bagians->satuan->satuan;
				$bagians->protected_id 	= $this->encrypt($bagians->id);
				
				$pengamatan = Pengamatan::where('bagian_id',$bagians->id)->whereDate('waktu_pengamatan',$tanggal_filter)->get();
				foreach ($pengamatan as $pengamatans) 
				{
					$pengamatans->protected_id = $this->encrypt($pengamatans->id);
 				}
				$bagians->pengamatan = $pengamatan;
				
			}
			return $bagian;
		}
	}

	public function showHomeHariKerja()
	{
		return view('energy_monitoring.home-hari-kerja',['menus'=>$this->menus]);
	} 
	public function ambilHariKerja()
	{
		# code...
	}

	/*Start Report Controller*/
	public function showDashboardReportWater()
	{
		$workcenter 	= Workcenter::find('13');
		// $workcenter->meteran =[];
		$return = array();
		foreach ($workcenter->Bagian as $bagian) 
		{
			$bagian->nilai_penggunaan  = 0;

			foreach ($bagian->Penggunaan as $penggunaan) 
			{
				$bagian->nilai_penggunaan += $penggunaan->nilai;	
			}
			array_push($return, $bagian);
		}
		// return $return;
		return view('energy_monitoring.reports.dashboard-water',['menus'=>$this->menus,'water_distribution'=>$return]);
	}
	public function showDeepweelReportWater()
	{
		// return $return;
		$workcenter 	= Workcenter::find('11');
		$month 			= ['1','2','3','4','5','6','7','8','9','10','11','12'];
		$return 		= array();
		foreach ($workcenter->bagian as $key => $bagian) 
		{
			$bagian_penggunaan = array();
			foreach ($month as $bulan) 
			{
				$penggunaan 	= Penggunaan::whereMonth('tanggal_penggunaan',$bulan)->where('bagian_id',$bagian->id)->avg('nilai');
				if (is_null($penggunaan)) 
				{
					$penggunaan = 0;
				}
				array_push($bagian_penggunaan,$penggunaan);
			}
			$bagian->penggunaan = $bagian_penggunaan;
			array_push($return,$bagian);
		}
		return view('energy_monitoring.reports.deepwell-complaince',['menus'=>$this->menus,'deepwell'=>$return]);
	}
	/*End Report Controller*/
}
