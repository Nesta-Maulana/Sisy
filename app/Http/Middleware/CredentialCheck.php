<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Master\Application;
use App\Models\Master\ApplicationPermission;
use App\Models\Master\Menu;
use App\Models\Master\MenuPermission;
use App\Http\Middleware\Route;
use Session;
use Auth;
class CredentialCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $url                = \Request::getRequestUri();
        $data               = explode('/',$url);
        $application        = Application::where('application_link',$data[1])->first();
        if ($application->is_active) 
        {
            $application_permission     = $application->applicationPermissions->where('user_id',Auth::user()->id)->first()->is_active;
            if ($application_permission) 
            {
                $route_name  = request()->route()->getName();
                if (!is_null($route_name)) 
                {
                    $menu       = Menu::where('menu_route',$route_name)->where('application_id',$application->id)->first();
                    
                    if ($menu->is_active) 
                    {

                        // dd(Auth::user());
                        $menu_permission    = $menu->menuPermissions->where('user_id',Auth::user()->id)->first();
                        if ($menu_permission->view) 
                        {
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
                            
                            return $next($request);
                        } 
                        else 
                        {
                        dd($menu->menuPermissions);

                            return redirect(url()->previous())->with('error', 'Anda tidak memiliki hak akses ke menu ini. Harap hubungi Administrator Aplikasi atau Mengisi Form Request Hak Akses untuk request hak akses pada menu tersebut');
                        }
                        
                    } 
                    else 
                    {
                        return redirect()->route('credential_access.home-page')->with('error', 'Menu yang anda akses tidak tersedia untuk sementara ini. Harap hubungi administrator aplikasi terkait untuk follow up masalah tersebut.');            
                    }
                    
                }
                else
                {
                    return $next($request);
                }
            } 
            else 
            {
                return redirect()->route('credential_access.home-page')->with('error', 'Anda tidak memiliki hak untuk mengakses aplikasi ini, Harap hubungi administrator untuk memberikan akses pada aplikasi atau klik tautan Help Page dan Klik Request Akses Aplikasi');
            }
            
        }
        else
        {
            return redirect()->route('credential_access.home-page')->with('error', 'Aplikasi yang ada akses telah di nonaktifkan. Harap hubungi administrator aplikasi terkait atau administrator di ext. 57156 apabila hal tersebut tidak seharusnya terjadi .');
        }
    }
}
