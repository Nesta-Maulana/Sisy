<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Master\Application;
use App\Models\Master\Menu;
use App\Models\Master\MenuPermission;
use App\Models\Transaction\Rollie\Ppq;
use App\Models\Transaction\Rollie\Psr;

use Auth;
use Session;
class ResourceController extends Controller
{
	public function encrypt($string)
	{
		$output = false;
	    $encrypt_method = "AES-256-CBC";
	    $secret_key = 'sentul-apps';
	    $secret_iv = 'sentul-apps';
	 
	    // hash
	    $key = hash('sha256', $secret_key);
	     
	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);
	 
	    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	    $output = base64_encode($output);
	 
	    return $output;
	}
	public function decrypt($string)
	{
		$output = false;
	    $encrypt_method = "AES-256-CBC";
	    $secret_key = 'sentul-apps';
	    $secret_iv = 'sentul-apps';
	    
	    // hash
	    $key = hash('sha256', $secret_key);
	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);
	    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	    return $output;
	}
	public function array_orderby()
    {
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $n => $field) {
            if (is_string($field)) {
                $tmp = array();
                foreach ($data as $key => $row)
                    $tmp[$key] = $row[$field];
                $args[$n] = $tmp;
                }
        }
        $args[] = &$data;
        call_user_func_array('array_multisort', $args);
        return array_pop($args);
    }
    public function checkAksesLihat($url,$route_name)
	{
        $this->regenerateSession($route_name);
		$data       = explode('/',$url);
        // data index 1 aplikasi , index 2 menu dalam aplikasi
        $application           	= Application::where('application_link',$data[1])->first();
        $application_permission = $application->applicationPermissions->where('user_id',Auth::user()->id)->first()->is_active;
        // pengecekan apakah dia mempunyai hak akses ke aplikasi tersebut 
        if ($application_permission) 
        {
        	$menu       = $application->menus->where('menu_route',$route_name)->first();
            if ($menu->is_active)
            {
            	// pengecekan hak akses menu untuk user 
                $menu_permission     = $menu->menuPermissions->where('user_id',Auth::user()->id)->first()->view;
                // apabila tidak memiliki hak akses untuk lihat maka akan redirect ke halaman sebelumnya
                if ($menu_permission) 
                {
		        	return ['success'=>true,'message'=>'success'];
                }
                else
                {
	        		return ['success'=>false,'message'=>'Anda tidak memiliki akses pada menu ini. Harap hubungi Administrator Aplikasi untuk Request Akses Tambah Data.'];

                }
            }
            else
            {
	        	return ['success'=>false,'message'=>'Menu yang anda akses tidak tersedia untuk sementara ini. Harap hubungi Administrator Aplikasi untuk perbaikan.'];
            }
        }
        else
        {
        	return ['success'=>false,'message'=>'Anda Tidak Memiliki Akses Untuk Aplikasi Ini'];
        }
	}
    public function checkAksesTambah($url,$route_name)
	{
        $this->regenerateSession($route_name);
		$data       = explode('/',$url);
        // data index 1 aplikasi , index 2 menu dalam aplikasi
        $application           	= Application::where('application_link',$data[1])->first();
        $application_permission = $application->applicationPermissions->where('user_id',Auth::user()->id)->first()->is_active;
        // pengecekan apakah dia mempunyai hak akses ke aplikasi tersebut 
        if ($application_permission) 
        {
        	$menu       = $application->menus->where('menu_route',$route_name)->first();
            if ($menu->is_active)
            {
            	// pengecekan hak akses menu untuk user 
                $menu_permission     = $menu->menuPermissions->where('user_id',Auth::user()->id)->first()->create;
                // apabila tidak memiliki hak akses untuk lihat maka akan redirect ke halaman sebelumnya
                if ($menu_permission) 
                {
		        	return ['success'=>true,'message'=>'success'];
                }
                else
                {
	        		return ['success'=>false,'message'=>'Anda tidak memiliki akses untuk Tambah Data pada menu ini. Harap hubungi Administrator Aplikasi untuk Request Akses Tambah Data.'];

                }
            }
            else
            {
	        	return ['success'=>false,'message'=>'Menu yang anda akses tidak tersedia untuk sementara ini. Harap hubungi Administrator Aplikasi untuk perbaikan.'];
            }
        }
        else
        {
        	return ['success'=>false,'message'=>'Anda Tidak Memiliki Akses Untuk Aplikasi Ini'];
        }
	}
    public function checkAksesUbah($url,$route_name)
	{
        $this->regenerateSession($route_name);
		$data       = explode('/',$url);
        // data index 1 aplikasi , index 2 menu dalam aplikasi
        $application           	= Application::where('application_link',$data[1])->first();
        $application_permission = $application->applicationPermissions->where('user_id',Auth::user()->id)->first()->is_active;
        // pengecekan apakah dia mempunyai hak akses ke aplikasi tersebut 
        if ($application_permission) 
        {
        	$menu       = $application->menus->where('menu_route',$route_name)->first();
            if ($menu->is_active)
            {
            	// pengecekan hak akses menu untuk user 
                $menu_permission     = $menu->menuPermissions->where('user_id',Auth::user()->id)->first()->edit;
                // apabila tidak memiliki hak akses untuk lihat maka akan redirect ke halaman sebelumnya
                if ($menu_permission) 
                {
		        	return ['success'=>true,'message'=>'success'];
                }
                else
                {
	        		return ['success'=>false,'message'=>'Anda tidak memiliki akses untuk Edit Data pada menu ini. Harap hubungi Administrator Aplikasi untuk Request Akses Edit Data.'];

                }
            }
            else
            {
	        	return ['success'=>false,'message'=>'Menu yang anda akses tidak tersedia untuk sementara ini. Harap hubungi Administrator Aplikasi untuk perbaikan.'];
            }
        }
        else
        {
        	return ['success'=>false,'message'=>'Anda Tidak Memiliki Akses Untuk Aplikasi Ini'];
        }
	}

    public function checkAksesHapus($url,$route_name)
	{
        $this->regenerateSession($route_name);
		$data       = explode('/',$url);
        // data index 1 aplikasi , index 2 menu dalam aplikasi
        $application           	= Application::where('application_link',$data[1])->first();
        $application_permission = $application->applicationPermissions->where('user_id',Auth::user()->id)->first()->is_active;
        // pengecekan apakah dia mempunyai hak akses ke aplikasi tersebut 
        if ($application_permission) 
        {
        	$menu       = $application->menus->where('menu_route',$route_name)->first();
            if ($menu->is_active)
            {
            	// pengecekan hak akses menu untuk user 
                $menu_permission     = $menu->menuPermissions->where('user_id',Auth::user()->id)->first()->delete;
                // apabila tidak memiliki hak akses untuk lihat maka akan redirect ke halaman sebelumnya
                if ($menu_permission) 
                {
		        	return ['success'=>true,'message'=>'success'];
                }
                else
                {
	        		return ['success'=>false,'message'=>'Anda tidak memiliki akses untuk Hapus Data pada menu ini. Harap hubungi Administrator Aplikasi untuk Request Akses Hapus Data.'];

                }
            }
            else
            {
	        	return ['success'=>false,'message'=>'Menu yang anda akses tidak tersedia untuk sementara ini. Harap hubungi Administrator Aplikasi untuk perbaikan.'];
            }
        }
        else
        {
        	return ['success'=>false,'message'=>'Anda Tidak Memiliki Akses Untuk Aplikasi Ini'];
        }
    }
    public function regenerateSession($route_name)
    {
        $menu                       = Menu::where('menu_route',$route_name)->first();
        $menu_permission            = $menu->menuPermissions->where('user_id',Auth::user()->id)->first();
        Session::put('lihat','true');
        if ($menu_permission->create) 
        {
            Session::put('tambah','show');
        }
        else
        {
            Session::put('tambah','hidden');
        }

        if ($menu_permission->edit) 
        {
            Session::put('ubah','show');
        }
        else
        {
            Session::put('ubah','hidden');
        }                

        if ($menu_permission->delete) 
        {
            Session::put('hapus','show');
        }
        else
        {
            Session::put('hapus','hidden');
        }
    }
    public function encryptId($arrays,$child1 ='',$child2='',$child3='',$child4='',$child5='',$child6='',$child7='')
    {
        if (isset($arrays[0])) 
        {
            foreach ($arrays as $array) 
            {
                $array->enkripsi_id 	= $this->encrypt($array->id);
                unset($array->id);
                if ($child1 !== '') 
                {
                    $array['enkripsi_'.$child1]     = $this->encrypt($array[$child1]);
                    unset($array[$child1]);
                }
                
                if ($child2 !== '') 
                {
                    $array['enkripsi_'.$child2]     = $this->encrypt($array[$child2]);
                    unset($array[$child2]);
                }
                
                if ($child3 !== '') 
                {
                    $array['enkripsi_'.$child3]     = $this->encrypt($array[$child3]);
                    unset($array[$child3]);
                }

                if ($child4 !== '') 
                {
                    $array['enkripsi_'.$child4]     = $this->encrypt($array[$child4]);
                    unset($array[$child4]);
                }

                if ($child5 !== '') 
                {
                    $array['enkripsi_'.$child5]     = $this->encrypt($array[$child5]);
                    unset($array[$child5]);
                }
                if ($child6 !== '') 
                {
                    $array['enkripsi_'.$child6]     = $this->encrypt($array[$child6]);
                    unset($array[$child6]);
                }

                if ($child7 !== '') 
                {
                    $array['enkripsi_'.$child7]     = $this->encrypt($array[$child7]);
                    unset($array[$child7]);
                }
            }
        }
        else
        {
            $arrays->enkripsi_id 	= $this->encrypt($arrays->id);
            unset($arrays->id);
            if ($child1 !== '') 
            {
                $arrays['enkripsi_'.$child1]     = $this->encrypt($arrays[$child1]);
                unset($arrays[$child1]);
            }
            
            if ($child2 !== '') 
            {
                $arrays['enkripsi_'.$child2]     = $this->encrypt($arrays[$child2]);
                unset($arrays[$child2]);
            }
            
            if ($child3 !== '') 
            {
                $arrays['enkripsi_'.$child3]     = $this->encrypt($arrays[$child3]);
                unset($arrays[$child3]);
            }

            if ($child4 !== '') 
            {
                $arrays['enkripsi_'.$child4]     = $this->encrypt($arrays[$child4]);
                unset($arrays[$child4]);
            }
            if ($child5 !== '') 
            {
                $arrays['enkripsi_'.$child5]     = $this->encrypt($arrays[$child5]);
                unset($arrays[$child5]);
            }

            if ($child6 !== '') 
            {
                $arrays['enkripsi_'.$child6]     = $this->encrypt($arrays[$child6]);
                unset($arrays[$child6]);
            }

            if ($child7 !== '') 
            {
                $arrays['enkripsi_'.$child7]     = $this->encrypt($arrays[$child7]);
                unset($arrays[$child7]);
            }
        }
        return $arrays;
    }
    
	public function tahunKeHuruf($years)
	{
		$length	= strlen($years);
		$index 	= $length-1;
		$tahunambil = $years[$index];
		$arrayHuruf 	= [
				'0'	=> 'K',
				'1'	=> 'L',
				'2'	=> 'M',
				'3'	=> 'N',
				'4'	=> 'O',
				'5'	=> 'P',
				'6'	=> 'Q',
				'7'	=> 'R',
				'8'	=> 'S',
				'9'	=> 'T'
		];
		return $arrayHuruf[$tahunambil];
	}
    public function getNomorPpq()
    {
        $ppqs            	= Ppq::all();
        $ppqakhir       	= $ppqs->last();
        if ($ppqakhir !== null) 
        {      
            $nomor_ppq      = explode('/', $ppqakhir->nomor_ppq);
        }
        else
        {
            $nomor_ppq 		= null;
        }

        if($nomor_ppq == null)
        {
            $nomor_ppq   = 1;
        }
        else
        {
            $nomor_ppq   = $nomor_ppq['0']+1;
        }

        if (strlen($nomor_ppq) == 1) 
        {
            $nomor_ppq = '00'.$nomor_ppq;
        }
        else if(strlen($nomor_ppq) == 2)
        {
            $nomor_ppq = '0'.$nomor_ppq;
        }
        else if (strlen($nomor_ppq) == 3) 
        {
            $nomor_ppq = $nomor_ppq;
        }
        
        $bulan          = ['01'=>'I','02'=>'II','03'=>'III','04'=>'IV','05'=>'V','06'=>'VI','07'=>'VII','08'=>'VIII','09'=>'IX','10'=>'X','11'=>'XI','12'=>'XII'];
        $nomor_ppq      = $nomor_ppq.'/PPQ/'.$bulan[date('m')].'/'.date('Y');
        return $nomor_ppq;
    }
    public function getNomorPsr()
    {
        $psrs               = Psr::all();
        $psrakhir           = $psrs->last();
        if ($psrakhir !== null) 
        {      
            $nomor_psr      = explode('/', $psrakhir->psr_number);
        }
        else
        {
            $nomor_psr      = null;
        }
        if($nomor_psr == null)
        {
            $nomor_psr   = 1;
        }
        else
        {
            $nomor_psr   = $nomor_psr['0']+1;
        }

        if (strlen($nomor_psr) == 1) 
        {
            $nomor_psr = '00'.$nomor_psr;
        }
        else if(strlen($nomor_psr) == 2)
        {
            $nomor_psr = '0'.$nomor_psr;
        }
        else if (strlen($nomor_psr) == 3) 
        {
            $nomor_psr = $nomor_psr;
        }

        $bulan          = ['01'=>'I','02'=>'II','03'=>'III','04'=>'IV','05'=>'V','06'=>'VI','07'=>'VII','08'=>'VIII','09'=>'IX','10'=>'X','11'=>'XI','12'=>'XII'];
        $nomor_psr      = $nomor_psr.'/PSR/FQC/'.$bulan[date('m')].'/'.date('Y');
        return $nomor_psr;
    }
    public function cekChild($menu_id)
	{
		$menu_id 	= $this->decrypt($menu_id);
		$cekChild 	= Menu::where('parent_id',$menu_id)->where('is_active','1')->orderBy('menu_position','asc')->get();
		$hitungchild = 0;
		foreach ($cekChild as $key => $child) 
		{
			foreach ($child->menuPermissions as $menuPermission) 
			{
				$child->hak_akses 	= $menuPermission;
				$menuPermission 	= $menuPermission;
				if ($menuPermission->user_id == Auth::user()->id && $menuPermission->view == '1') 
				{
					$hitungchild++;
				}
			
			}
		}
		$return 	= array('jumlahchild' => $hitungchild, 'child' => $cekChild);
		return $return;
    }
    Public function daysInMonth($month,$years) 
    {
        $list=array();
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $month, $d, $years);
            if (date('m', $time)==$month)
                $list[]=date('Y-m-d', $time);
        }
        return $list;
    }
   /*  public function getMenu($application_name)
    {
        $application    = Application::where('application_name',$application_name)->first();
        $menus          = $application->menus->where('parent_id','0')->where('is_active','1');
        foreach ($menus as $menu) 
        {
            $menuPermission     = $menu->menuPermissions->where('user_id',Auth::user()->id)->where('view','1');
            if (!is_null($menuPermission)) 
            {
                $child1     = $this->cekChild($this->encrypt($menu->id));
                if ($chil) 
                {
                
                } 
                
            } 
            else
            {
                unset($menu);
            }
        }
    } */
}
