<?php

namespace App\Http\Controllers\Master\MasterApp;
use App\Http\Controllers\ResourceController;
use App\Models\Master\MenuPermission;
use App\Models\Master\Menu;
use App\Models\Master\Application;
use App\Models\Master\ApplicationPermission;
use App\Models\Master\User;
use Illuminate\Http\Request;

class MenuPermissionController extends ResourceController
{

    public function changePermission(Request $request)
    {
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'master_app.menu_permissions');
        if ($cekAkses['success']) 
        {
            $menu_permission     = MenuPermission::find($this->decrypt($request->menu_permission_id));
            switch ($request->method_access) 
            {
                case 'view':
                    $menu_permission->view          = $request->menu_permission;
                break;
                case 'create':
                    $menu_permission->create        = $request->menu_permission;
                break;
                case 'edit':
                    $menu_permission->edit          = $request->menu_permission;
                break;
                case 'delete':
                    $menu_permission->delete        = $request->menu_permission;
                break;
            }
            $menu_permission->save();
            if ($request->menu_permission == '1') 
            {
                $cekAkses['message']    = "Akses ".$request->method_access." pada menu ".$menu_permission->menu->menu_name." di aplikasi ".$menu_permission->menu->application->application_name." untuk user ".$menu_permission->user->employee->fullname." telah diberikan";
            }
            else
            {
                $cekAkses['message']    = "Akses ".$request->method_access." pada menu ".$menu_permission->menu->menu_name." di aplikasi ".$menu_permission->menu->application->application_name." untuk user ".$menu_permission->user->employee->fullname." telah dibatasi";
            }
            return $cekAkses;
        } 
        else 
        {
            return $cekAkses;
        }
    }
    public function getMenuPermission($application_id,$user_id)
    {
        $menus               = Menu::where('application_id',$this->decrypt($application_id))->get();
        foreach ($menus as $menu) 
        {
            $menu->enkripsi_id      = $this->encrypt($menu->id);
            
            if ($this->decrypt($user_id) == 'all' || strpos($user_id,',') !== false ) 
            {
                $menu->menu_permission      = 'all';
            } 
            else 
            {
                if (count($menu->menuPermissions) == 0) 
                {
                    $menu->menu_permission                  = 'kosong';
                }
                else
                {
                    $menu->menu_permission                  = $menu->menuPermissions->where('user_id',$this->decrypt($user_id))->first();
                    $menu->menu_permission->enkripsi_id      = $this->encrypt($menu->menuPermissions->where('user_id',$this->decrypt($user_id))->first()->id);
                    unset($menu->menu_permission->id);
                    unset($menu->menu_permissions);
                    unset($menu->id);
                }
            }
        }
        

        return $menus;
    }

    public function manageMenuPermissionForm(Request $request)
    {
        $application_id         = $this->decrypt($request->menu_permission_application);
        $application            = Application::find($application_id);
        $menu_permission_user   = $request->menu_permission_user;
        unset($request['menu_permission_user']);
        unset($request['menu_permission_application']);
        unset($request['_token']);
        /* Ini untuk penambahan akses ke semua user */
        foreach ($request->all() as $key => $menu) 
        {
            $get_menu_id    = explode('_',$key);
            $menu_id        = end($get_menu_id);
            $menu_id        = $this->decrypt($menu_id);
            $menu_data      = Menu::find($menu_id);    
            /* ini apabila menu permissionnya adalah array atau multiple user */
            foreach ($menu_permission_user as $user_id) 
            {
                $user_id    = $this->decrypt($user_id);
                if($user_id == 'all')
                {
                    $users  = User::where('is_active','1')->get();
                    foreach ($users as $user) 
                    {
                        if(is_null($menu_data->menuPermissions))
                        {
                            if ($menu['view'] == '2') 
                            {
                                $view           = '0';
                            }
                            else 
                            {
                                $view           = $menu['view'];
                            }
                            if ($menu['create'] == '2') 
                            {
                                $create         = '0';
                            }
                            else 
                            {
                                $create         = $menu['create'];
                            }
                            if ($menu['edit'] == '2') 
                            {
                                $edit           = '0';
                            }
                            else 
                            {
                                $edit           = $menu['edit'];
                            }
                            if ($menu['delete'] == '2') 
                            {
                                $delete         = '0';
                            }
                            else 
                            {
                                $delete         = $menu['delete'];
                            }
                            /* ini apabila menu baru yang memang semuanya belom punya aksesnya maka input semua menu permission untuk semua penggunanya*/
                            MenuPermission::create([
                                'user_id'   => $user->id,
                                'menu_id'   => $menu_data->id,
                                'view'      => $view,
                                'create'    => $create,
                                'edit'      => $edit,
                                'delete'    => $delete
                            ]);
                        }
                        else if(!is_null($menu_data->menuPermissions))
                        {
                            /* ini apabila menemukan menu permission nya  */
                            $menu_permission    = $menu_data->menuPermissions->where('user_id',$user->id)->first();
                            if (is_null($menu_permission)) 
                            {
                                if ($menu['view'] == '2') 
                                {
                                    $view           = '0';
                                }
                                else 
                                {
                                    $view           = $menu['view'];
                                }
                                if ($menu['create'] == '2') 
                                {
                                    $create         = '0';
                                }
                                else 
                                {
                                    $create         = $menu['create'];
                                }
                                if ($menu['edit'] == '2') 
                                {
                                    $edit           = '0';
                                }
                                else 
                                {
                                    $edit           = $menu['edit'];
                                }
                                if ($menu['delete'] == '2') 
                                {
                                    $delete         = '0';
                                }
                                else 
                                {
                                    $delete         = $menu['delete'];
                                }
                                /* ini kalo ga ada menu permission untuk user tersebut maka akan dibuatkan baru */
                                MenuPermission::create([
                                    'user_id'   => $user->id,
                                    'menu_id'   => $menu_data->id,
                                    'view'      => $view,
                                    'create'    => $create,
                                    'edit'      => $edit,
                                    'delete'    => $delete
                                ]);
                            } 
                            else 
                            {
                                if ($menu['view'] == '2') 
                                {
                                    $view           = $menu_permission->view;
                                }
                                else 
                                {
                                    $view           = $menu['view'];
                                }
                                if ($menu['create'] == '2') 
                                {
                                    $create         = $menu_permission->create;
                                }
                                else 
                                {
                                    $create         = $menu['create'];
                                }
                                if ($menu['edit'] == '2') 
                                {
                                    $edit           = $menu_permission->edit;
                                }
                                else 
                                {
                                    $edit           = $menu['edit'];
                                }
                                if ($menu['delete'] == '2') 
                                {
                                    $delete         = $menu_permission->delete;
                                }
                                else 
                                {
                                    $delete         = $menu['delete'];
                                }
                                $menu_permission->view      = $view; 
                                $menu_permission->create    = $create; 
                                $menu_permission->edit      = $edit; 
                                $menu_permission->delete    = $delete;
                                $menu_permission->save(); 
                            }
                            
                        } 
                    }
                }
                else
                {
                    $user   = User::find($user_id);
                    if(is_null($menu_data->menuPermissions))
                    {
                        dd('ada');
                        if ($menu['view'] == '2') 
                        {
                            $view           = '0';
                        }
                        else 
                        {
                            $view           = $menu['view'];
                        }
                        if ($menu['create'] == '2') 
                        {
                            $create         = '0';
                        }
                        else 
                        {
                            $create         = $menu['create'];
                        }
                        if ($menu['edit'] == '2') 
                        {
                            $edit           = '0';
                        }
                        else 
                        {
                            $edit           = $menu['edit'];
                        }
                        if ($menu['delete'] == '2') 
                        {
                            $delete         = '0';
                        }
                        else 
                        {
                            $delete         = $menu['delete'];
                        }
                        /* ini apabila menu baru yang memang semuanya belom punya aksesnya maka input semua menu permission untuk semua penggunanya*/
                        MenuPermission::create([
                            'user_id'   => $user->id,
                            'menu_id'   => $menu_data->id,
                            'view'      => $view,
                            'create'    => $create,
                            'edit'      => $edit,
                            'delete'    => $delete
                        ]);
                    }
                    else if(!is_null($menu_data->menuPermissions))
                    {
                        /* ini apabila menemukan menu permission nya  */
                        $menu_permission    = $menu_data->menuPermissions->where('user_id',$user->id)->first();
                        if (is_null($menu_permission)) 
                        {
                            if ($menu['view'] == '2') 
                            {
                                $view           = '0';
                            }
                            else 
                            {
                                $view           = $menu['view'];
                            }
                            if ($menu['create'] == '2') 
                            {
                                $create         = '0';
                            }
                            else 
                            {
                                $create         = $menu['create'];
                            }
                            if ($menu['edit'] == '2') 
                            {
                                $edit           = '0';
                            }
                            else 
                            {
                                $edit           = $menu['edit'];
                            }
                            if ($menu['delete'] == '2') 
                            {
                                $delete         = '0';
                            }
                            else 
                            {
                                $delete         = $menu['delete'];
                            }
                            /* ini kalo ga ada menu permission untuk user tersebut maka akan dibuatkan baru */
                            MenuPermission::create([
                                'user_id'   => $user->id,
                                'menu_id'   => $menu_data->id,
                                'view'      => $view,
                                'create'    => $create,
                                'edit'      => $edit,
                                'delete'    => $delete
                            ]);
                        } 
                        else 
                        {
                            if ($menu['view'] == '2') 
                            {
                                $view           = $menu_permission->view;
                            }
                            else 
                            {
                                $view           = $menu['view'];
                            }
                            if ($menu['create'] == '2') 
                            {
                                $create         = $menu_permission->create;
                            }
                            else 
                            {
                                $create         = $menu['create'];
                            }
                            if ($menu['edit'] == '2') 
                            {
                                $edit           = $menu_permission->edit;
                            }
                            else 
                            {
                                $edit           = $menu['edit'];
                            }
                            if ($menu['delete'] == '2') 
                            {
                                $delete         = $menu_permission->delete;
                            }
                            else 
                            {
                                $delete         = $menu['delete'];
                            }
                            $menu_permission->view      = $view; 
                            $menu_permission->create    = $create; 
                            $menu_permission->edit      = $edit; 
                            $menu_permission->delete    = $delete;
                            $menu_permission->save(); 
                        }
                        
                    } 
    
                }
            }
            
        }
        return redirect(route('master_app.menu_permissions'))->with('success','Hak akses menu pada aplikasi '.$application->application_name.' untuk beberapa user berhasil diubah');
        
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\MenuPermission  $menuPermission
     * @return \Illuminate\Http\Response
     */
    public function show(MenuPermission $menuPermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\MenuPermission  $menuPermission
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuPermission $menuPermission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\MenuPermission  $menuPermission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuPermission $menuPermission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\MenuPermission  $menuPermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuPermission $menuPermission)
    {
        //
    }
}
