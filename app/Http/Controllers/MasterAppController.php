<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ResourceController;

use App\Models\Master\Menu;
use App\Models\Master\MenuPermission;

use App\Models\Master\Application;
use App\Models\Master\ApplicationPermission;

use App\Models\Master\User;
use App\Models\Master\Icon;

use App\Models\Master\Product;
use App\Models\Master\ProductType;

use App\Models\Master\Subbrand;
use App\Models\Master\Brand;

use App\Models\Master\fillingMachine;
use App\Models\Master\fillingMachineGroupHead;
use App\Models\Master\fillingMachineGroupDetail;

use App\Models\Master\Emon\Flowmeter;
use App\Models\Master\Emon\FlowmeterCategory;
use App\Models\Master\Emon\FlowmeterWorkcenter;
use App\Models\Master\Emon\FlowmeterUnit;
use App\Models\Master\Emon\FlowmeterLocation;


use DB;
use Auth;
class MasterAppController extends ResourceController
{
	public function __construct()
	{
		$this->application 	= Application::where('application_name','Master Apps')->first();
    	$this->menus 		= $this->application->menus->where('parent_id','0')->where('is_active','1');  		
    }
    public function index()
    {
		$menus 	= $this->menus;
		return view('master_app.home', compact('menus',$menus));
    }

    /*library */
	public function cekChild($menu_id)
	{
		$menu_id 	= $this->decrypt($menu_id);
		$cekChild 	= Menu::where('parent_id',$menu_id)->where('is_active','1')->orderBy('menu_position','asc')->get();
		$hitungchild = 0;
		foreach ($cekChild as $key => $child) 
		{
			if (!is_null($child->menuPermissions->where('user_id',Auth::user()->id)->where('view','1')->first() )) 
			{
				$hitungchild = $hitungchild+1;
			} 
			else
			{
				unset($cekChild[$key]);
			}
		}
		$return 	= array('jumlahchild' => $hitungchild, 'child' => $cekChild);
		return $return;
	}

	public function manageMenu()
	{
		$applications 				= Application::where('is_active','1')->get();
		$icons 						= Icon::all();
		$menus_data					= Menu::all();
		return view('master_app.manage_menu.form',['menus'=>$this->menus, 'applications'=>$applications,'icons'=>$icons,'menus_data'=>$menus_data]);
	}
	public function manageMenuPermission()
	{
		$users		= User::where('is_active','1')->get();
		foreach ($users as $user) 
		{
			$id 					= $this->encrypt($user->id);
			$user->enkripsi_id 		= $id;
		}
		return view('master_app.manage_menu.manage_menu_permission',['menus'=>$this->menus,'users'=>$users]);	
	}
	public function addMenuPermissionForm()
	{
		$users 				= User::where('is_active','1')->get();
		$applications 		= Application::where('is_active','1')->get();
		return view('master_app.manage_menu.add_menu_permission_form',['menus'=>$this->menus,'users'=>$users,'applications'=>$applications]);	
	}
	
	public function manageApplication()
	{
		$cekAkses 	= $this->checkAksesLihat(\Request::getRequestUri(),'master_app.manage_applications');
		if ($cekAkses['success']) 
		{
			$applications	= Application::all();
			return view('master_app.manage_application.dashboard',['menus'=>$this->menus,'applications'=>$applications]);
		} 
		else 
		{
			return redirect()->back()->with('error',$cekAkses['message']);
		}
		
	}

	public function manageApplicationPermission()
	{
		$cekAkses 	= $this->checkAksesLihat(\Request::getRequestUri(),'master_app.application_permissions');
		if ($cekAkses['success']) 
		{
			$users		= User::where('is_active','1')->get();
			return view('master_app.manage_application.dashboard-manage-permissions',['menus'=>$this->menus,'users'=>$users]);
		} 
		else 
		{
			return redirect()->back()->with('error',$cekAkses['message']);
		}
		
	}
	public function manageApplicationPermissionForm()
	{
		$cekAkses 	= $this->checkAksesTambah(\Request::getRequestUri(),'master_app.application_permissions');
		if ($cekAkses['success']) 
		{
			$users		= User::where('is_active','1')->get();
			return view('master_app.manage_application.form-manage-permissions',['menus'=>$this->menus,'users'=>$users]);
		} 
		else 
		{
			return redirect()->back()->with('error',$cekAkses['message']);
		}
		
	}

	public function manageProduct()
	{
		$cekAkses 	= $this->checkAksesLihat(\Request::getRequestUri(),'master_app.master_data.manage_products');
		if ($cekAkses['success']) 
		{
			$products 				= Product::all();
			$subbrands				= Subbrand::where('is_active','1')->get();
			$productTypes			= ProductType::where('is_active','1')->get();
			$fillingMachineGroups	= fillingMachineGroupHead::where('is_active','1')->get();
			return view('master_app.manage_product.dashboard',['menus'=>$this->menus,'products'=>$products,'subbrands'=>$subbrands,'productTypes'=>$productTypes,'fillingMachineGroups'=>$fillingMachineGroups]);
		} 
		else 
		{
			return redirect()->back()->with('error',$cekAkses['message']);
		}
		
	}

	public function manageFillingMachine()
	{
		$cekAkses	 = $this->checkAksesLihat(\Request::getRequestUri(),'master_app.master_data.manage_filling_machines');
		if ($cekAkses['success']) 
		{
			$fillingMachines 	= FillingMachine::all();
			return view('master_app.manage_filling_machine.dashboard',['menus'=>$this->menus,'fillingMachines'=>$fillingMachines]);
		} 
		else
		{
			return redirect()->back()->with('error',$cekAkses['message']);
		}
	}


	/* Emon */
	public function manageFlowmeterCategory()
	{
		$cekAkses 		= $this->checkAksesLihat(\Request::getRequestUri(),'master_app.master_data.manage_flowmeter_categories');
		if ($cekAkses['success']) 
		{
			$flowmeterCategories 	= FlowmeterCategory::all();
			return view('master_app.manage_flowmeter_categories.dashboard',['menus'=>$this->menus,'flowmeterCategories'=>$flowmeterCategories]);
		} 
		else 
		{
			return redirect()->back()->with('error',$cekAkses['message']);
		}
				
	}

	public function manageFlowmeterWorkcenter()
	{
		$cekAkses 		= $this->checkAksesLihat(\Request::getRequestUri(),'master_app.master_data.manage_flowmeter_categories');
		if ($cekAkses['success']) 
		{
			$flowmeterWorkcenters 	= FlowmeterWorkcenter::all();
			$flowmeterCategories 	= FlowmeterCategory::where('is_active','1')->get();
			return view('master_app.manage_flowmeter_workcenter.dashboard',['menus'=>$this->menus,'flowmeterWorkcenters'=>$flowmeterWorkcenters,'flowmeterCategories'=>$flowmeterCategories]);
		} 
		else 
		{
			return redirect()->back()->with('error',$cekAkses['message']);
		}
	}

	public function manageFlowmeterUnit()
	{
		$cekAkses 		= $this->checkAksesLihat(\Request::getRequestUri(),'master_app.master_data.manage_flowmeter_units');
		if ($cekAkses['success']) 
		{
			$flowmeterUnits 	= FlowmeterUnit::all();
			return view('master_app.manage_flowmeter_unit.dashboard',['menus'=>$this->menus,'flowmeterUnits'=>$flowmeterUnits]);
		} 
		else 
		{
			return redirect()->back()->with('error',$cekAkses['message']);
		}
	}

	public function manageFlowmeterLocation()
	{
		$cekAkses 		= $this->checkAksesLihat(\Request::getRequestUri(),'master_app.master_data.manage_flowmeter_locations');
		if ($cekAkses['success']) 
		{
			$flowmeterCategories 	= FlowmeterCategory::where('is_active','1')->get();
			$flowmeterLocations 	= FlowmeterLocation::all();
			
			return view('master_app.manage_flowmeter_location.dashboard',['menus'=>$this->menus,'flowmeterLocations'=>$flowmeterLocations,'flowmeterCategories'=>$flowmeterCategories]);
		} 
		else 
		{
			return redirect()->back()->with('error',$cekAkses['message']);
		}
	}
	public function manageFlowmeter()
	{
		$cekAkses 		= $this->checkAksesLihat(\Request::getRequestUri(),'master_app.master_data.manage_flowmeters');
		if ($cekAkses['success']) 
		{
			$flowmeters 			= Flowmeter::all();
			$flowmeterLocations 	= FlowmeterLocation::where('is_active','1')->get();
			$flowmeterUnits 		= FlowmeterUnit::where('is_active','1')->get();
			$flowmeterWorkcenters 	= FlowmeterWorkcenter::where('is_active','1')->get();

			return view('master_app.manage_flowmeter.dashboard',['menus'=>$this->menus,'flowmeters'=>$flowmeters,'flowmeterLocations'=>$flowmeterLocations,'flowmeterUnits'=>$flowmeterUnits,'flowmeterWorkcenters'=>$flowmeterWorkcenters]);
		} 
		else 
		{
			return redirect()->back()->with('error',$cekAkses['message']);
		}
	}

	public function perhitunganPernggunaan()
	{
		return view('master_app.perhitungan_penggunaan',['menus'=>$this->menus]);	
	}



}
