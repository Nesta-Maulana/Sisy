<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ResourceController;

use App\Models\Master\Menu;
use App\Models\Master\MenuPermission;
use App\Models\Master\Application;
use App\Models\Master\ApplicationPermission;

use App\Models\Master\Emon\Flowmeter;
use App\Models\Master\Emon\FlowmeterCategory;
use App\Models\Master\Emon\FlowmeterUnit;
use App\Models\Master\Emon\FlowmeterWorkcenter;
use App\Models\Master\Emon\FlowmeterLocation;

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

    public function index()
    {
    	$home 	= $this->menus->where('menu_name','Home')->first();
    	return redirect(route($home->menu_route));
    }

	public function homeOperator()
	{
		return view('energy_monitoring.home.home-operator',['menus'=>$this->menus]);
	}

	public function showMonitoringAir()
	{
		$flowmeterLocations = FlowmeterLocation::where('flowmeter_category_id','1')->get();
		return view('energy_monitoring.monitoring_air.dashboard',['menus'=>$this->menus,'flowmeterLocations'=>$flowmeterLocations]);
	}
	public function showMonitoringFormAir($location_id)
	{
		$flowmeters 		= Flowmeter::where('flowmeter_location_id',$this->decrypt($location_id))->where('is_active','1')->get();
		$flowmeterLocations = FlowmeterLocation::where('is_active','1')->get();
		$flowmeterLain 		= array();
 		foreach ($flowmeters as $key => $flowmeter) 
		{
			if ($flowmeter->flowmeterWorkcenter->flowmeterCategory->flowmeter_category !== 'Air') 
			{
				array_push($flowmeterLain, $flowmeter);
				unset($flowmeters[$key]);
			}
		}
		return view('energy_monitoring.monitoring_air.form',['menus'=>$this->menus,'flowmeters'=>$flowmeters,'flowmeterLain'=>$flowmeterLain,'flowmeterLocations'=>$flowmeterLocations]); 
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
	
	public function showMonitoringHistory()
	{
		// $flowmeter 		=
		return view('energy_monitoring.monitoring_history.dashboard',['menus'=>$this->menus]);
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
