<?php

namespace App\Http\Controllers\Master\MasterApp;
use App\Http\Controllers\ResourceController;
use App\Models\Master\Menu;
use Illuminate\Http\Request;

class MenuController extends ResourceController
{
    public function changeApplication($application_id)
    {
        $parents    = Menu::where('application_id',$this->decrypt($application_id))->where('parent_id','0')->where('is_active','1')->orderBy('menu_position','asc')->get();
        $parentsmenu    = array();
        foreach ($parents as $parent) 
        {
            $parent_id          = $this->encrypt($parent->id);
            $parent->idnya      = $parent_id;
            array_push($parentsmenu,$parent);
            if (!is_null($parent->childMenus)) 
            {
                $childs1            = $parent->childMenus->where('is_active','1')->sortBy('menu_position');
                foreach ($childs1 as $child1) 
                {
                    $child1_id      = $this->encrypt($child1->id);
                    $child1->idnya  = $child1_id;
                    $menu           = $child1->menu_name; 
                    $parentnya      = $parent->menu_name; 
                    unset($child1->menu_name);
                    $child1->menu_name   = $parentnya.' >> '.$menu;
                    array_push($parentsmenu,$child1);
                    if (!is_null($child1->childMenus)) 
                    {
                        $childs2  = Menu::where('parent_id',$child1->id)->where('is_active','1')->orderBy('menu_position','asc')->get();
                        foreach ($childs2 as $child2) 
                        {

                            $child2_id      = $this->encrypt($child2->id);
                            $child2->idnya  = $child2_id;
                            $menunya        = $child2->menu_name; 
                            $parentnyaa     = $child1->menu_name; 
                            unset($child2->menu_name);
                            $child2->menu_name   = $parentnyaa.' >> '.$menunya;
                            array_push($parentsmenu, $child2);
                        }
                    }
                }
            
            }
        }
        return $parentsmenu;
    }

    public function changeParent($parent_menu_id,$application_id)
    {
        $urutan = Menu::where('parent_id',$this->decrypt($parent_menu_id))->where('application_id',$this->decrypt($application_id))->where('is_active','1')->orderBy('menu_position','asc')->get();;
        return $urutan;
    }

    public function manageMenu(Request $request)
    {
        if (is_null($request->id)) 
        {
            $cekAkses   = $this->checkAksesTambah(\Request::getRequestUri(),'master_app.manage_menu');
            if ($cekAkses['success'] == true) 
            {
                // apa bila user memiliki akses untuk menambahkan 
                $menu     = Menu::create([
                    'menu_name'     => ucwords(strtolower($request->menu)),
                    'menu_route'    => strtolower($request->route_name),
                    'menu_icon'     => $request->icon,
                    'parent_id'     => $this->decrypt($request->parent_menu),
                    'application_id'=> $this->decrypt($request->aplikasi_id),
                    'is_active'     => $request->status,
                    'menu_position' => $request->urutan
                ]);
                /*// apabila sudah insert ke tabel menu maka akan langsung memberikan seluruh user akses menu tersebut namun dengan default tidak memiliki akses
                $listUser       = User::all();
                foreach ($listUser as $user) 
                {
                    $cekAksesMenu   = HakAksesMenu::where('user_id',$user->id)->where('menu_id',$menu->id)->count();
                    if ($cekAksesMenu == 0) 
                    {
                        HakAksesMenu::Create([
                            'user_id'   => $user->id,
                            'menu_id'   => $menu->id,
                            'lihat' => '0',
                            'tambah' => '0',
                            'ubah' => '0',
                            'hapus' => '0',
                        ]);
                    }
                    
                }*/
                return redirect()->route('master_app.manage_menu')->with('success','Menu '.ucwords(strtolower($request->menu)).' pada aplikasi '.$menu->application->application_name.' telah berhasil dibuat');
            }
            else 
            {
                return redirect()->back()->with('error',$cekAkses['message']);
            }
        }
        else
        {
            $cekAkses     = $this->CheckAksesUbah(\Request::getRequestUri(),'master_app.manage_menu');
            if ($cekAkses['success'] == true) 
            {
                // ini update
                $menu                   = Menu::find($this->decrypt($request->id));
                $menu->menu_name        = ucwords(strtolower($request->menu));
                $menu->menu_route       = strtolower($request->route_name);
                $menu->menu_icon        = $request->icon;
                $menu->parent_id        = $this->decrypt($request->parent_menu);
                $menu->application_id   = $this->decrypt($request->aplikasi_id);
                $menu->is_active        = $request->status;
                $menu->menu_position    = $request->urutan;
                $menu->save();  
                return redirect()->route('master_app.manage_menu')->with('success','Menu '.ucwords(strtolower($request->menu)).' telah berhasil edit');

            } 
            else 
            {
                return redirect()->back()->with('error',$cekAkses['message']);
            }
        }
    }

    public function editMenu($menu_id)
    {
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'master_app.manage_menu');
        if ($cekAkses['success']) 
        {
            $menu               = Menu::find($this->decrypt($menu_id));
            $menu               = $this->encryptId($menu,'application_id','parent_id');
            $menu->success      = true;
            return $menu;
        } 
        else
        {
            return $cekAkses;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
