<?php

namespace App\Http\Controllers\Master\Emon;

use App\Models\Master\Emon\FlowmeterLocationPermissions;
use App\Models\Master\Emon\FlowmeterLocation;
use App\Models\Master\Emon\FlowmeterCategory;
use App\Http\Controllers\ResourceController;
use App\Models\Master\User;
use App\Models\Master\Menu;

use Illuminate\Http\Request;

class FlowmeterLocationPermissionsController extends ResourceController
{
    public function getFlowmeter($flowmeterCategory,$user_id)
    {
        $flowmeterCategories    = explode(',',$flowmeterCategory);
        foreach ($flowmeterCategories as $key => $flowmeterCategory) 
        {
            $flowmeterCategories[$key]  = $this->decrypt($flowmeterCategory);
        }
        $users                  = explode(',',$user_id);
        foreach ($users as $key => $user) 
        {
            $users[$key]  = $this->decrypt($user);
        }
        $users  = User::whereIn('id',$users)->get();
        
        $flowmeterLocations     = FlowmeterLocation::whereIn('flowmeter_category_id',$flowmeterCategories)->get();
        if (count($users) == 1) 
        {
            /* ini kalo user yang dipilih cuma 1 maka akan di cek dia user nya semua pengguna atau bukan */
            $user_id    = $this->decrypt($users[0]);
            if ($user_id == 'all') 
            {
                /*  ini jika user yang dipilih adalah all */
                foreach ($flowmeterLocations as $flowmeterLocation) 
                {
                    $flowmeterLocation->permissions = 'all';
                }
            } 
            else 
            {
                /* ini jika yang dipilih bukan all */
                foreach ($flowmeterLocations as $flowmeterLocation) 
                {
                    $flowmeterLocationPermissions       = $flowmeterLocation->flowmeterLocationPermissions->where('user_id',$user_id)->first();
                    if (is_null($flowmeterLocationPermissions))
                    {
                        $flowmeterLocation->permissions     = 'all';
                    } 
                    else 
                    {
                        $flowmeterLocation->permissions     = $flowmeterLocationPermissions->is_allow;
                    }
                }
            }
        }
        else
        {
            foreach ($flowmeterLocations as $flowmeterLocation) 
            {
                $flowmeterLocation->permissions = 'all';
            }
        }
        foreach ($flowmeterLocations as $flowmeterLocation) 
        {
            $flowmeterCategory  =  $flowmeterLocation->flowmeterCategory; 
        }
        $flowmeterLocations     = $this->encryptId($flowmeterLocations,'flowmeter_category_id');
        return $flowmeterLocations;
    }

    public function grantAccess(Request $request)
    {
        $cekAkses   = $this->checkAksesTambah(\Request::getRequestUri(),'master_app.master_data.manage_flowmeter_location_permissions');
        if ($cekAkses['success'] == true) 
        {
            $user_id                                = $request->location_permission_user;
            $flowmeter_location_permissions         = $request->except(['_token','location_permission_user','flowmeter_category_id']);
            foreach ($flowmeter_location_permissions as $location_id => $permissions) 
            {
                $location_id        = explode('_',$location_id);
                $flowmeterLocation  = FlowmeterLocation::find($this->decrypt(end($location_id)));
                if (count($user_id) == 1) 
                {
                    
                    if ($this->decrypt($user_id[0]) == 'all')
                    {
                        $aksesPengamatans 		= Menu::find('70')->childMenus;
                        $users                = array();
                        foreach ($aksesPengamatans as $childMenu) 
                        {
                            if (strpos($childMenu->menu_name,$flowmeterLocation->flowmeterCategory->flowmeter_category) !== false) 
                            {
                                $aksesMenus  = $childMenu->menuPermissions->where('view','1')->where('edit','1')->where('create','1');
                                foreach ($aksesMenus as $aksesMenu) 
                                {
                                    if (!in_array($aksesMenu->user_id,$users)) 
                                    {
                                        array_push($users,$aksesMenu->user_id);
                                    }
                                }
                            }
                        }
                        foreach ($users as $user) 
                        {
                            $flowmeterLocationPermission    = $flowmeterLocation->flowmeterLocationPermissions->where('user_id',$user)->first();
                            if (is_null($flowmeterLocationPermission)) 
                            {
                                FlowmeterLocationPermissions::create([
                                    'flowmeter_location_id'     => $flowmeterLocation->id,
                                    'user_id'                   => $user,
                                    'is_allow'                  => $permissions
                                ]);
                            } 
                            else 
                            {
                                $flowmeterLocationPermission->is_allow  = $permissions;
                                $flowmeterLocationPermission->save();
                            }
                            
                        }
                    } 
                    else 
                    {
                        $user   = $this->decrypt($user_id[0]);
                        $flowmeterLocationPermission    = $flowmeterLocation->flowmeterLocationPermissions->where('user_id',$user)->first();
                        if (is_null($flowmeterLocationPermission)) 
                        {
                            FlowmeterLocationPermissions::create([
                                'flowmeter_location_id'     => $flowmeterLocation->id,
                                'user_id'                   => $user,
                                'is_allow'                  => $permissions
                            ]);
                        } 
                        else 
                        {
                            $flowmeterLocationPermission->is_allow  = $permissions;
                            $flowmeterLocationPermission->save();
                        }
                    }
                    
                } 
                else
                {
                    foreach ($user_id as $user) 
                    {
                        $flowmeterLocationPermission    = $flowmeterLocation->flowmeterLocationPermissions->where('user_id',$user)->first();
                        if (is_null($flowmeterLocationPermission)) 
                        {
                            FlowmeterLocationPermissions::create([
                                'flowmeter_location_id'     => $flowmeterLocation->id,
                                'user_id'                   => $user,
                                'is_allow'                  => $permissions
                            ]);
                        } 
                        else 
                        {
                            $flowmeterLocationPermission->is_allow  = $permissions;
                            $flowmeterLocationPermission->save();
                        }
                    }
                }
                
            }
            return redirect(route('master_app.master_data.manage_flowmeter_location_permissions'))->with('success','Akses lokasi flowmeter telah berhasil disetting ulang');
        } 
        else 
        {
            return redirect()->back()->with('error',$cekAkses['message']);
        }
        
    }

    public function changeAccess(Request $request)
    {
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'master_app.master_data.manage_flowmeter_location_permissions');
        if ($cekAkses['success'] == true)
        {
            $flowmeter_location_permission_id       = $this->decrypt($request->flowmeter_location_permission_id);
            $is_allow                               = $request->access;
            $flowmeterLocationPermission            = FlowmeterLocationPermissions::find($flowmeter_location_permission_id);
            $flowmeterLocationPermission->is_allow  = $is_allow;
            $flowmeterLocationPermission->save();
            return ['success'=>true,'message'=>"Perubahan akses untuk lokasi flowmeter".$flowmeterLocationPermission->flowmeterLocation->flowmeter_location." pada user ".$flowmeterLocationPermission->user->employee->fullname." berhasil diubah"];
        } 
        else 
        {
            return $cekAkses;
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Emon\FlowmeterLocationPermissions  $flowmeterLocationPermissions
     * @return \Illuminate\Http\Response
     */
    public function show(FlowmeterLocationPermissions $flowmeterLocationPermissions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\Emon\FlowmeterLocationPermissions  $flowmeterLocationPermissions
     * @return \Illuminate\Http\Response
     */
    public function edit(FlowmeterLocationPermissions $flowmeterLocationPermissions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Emon\FlowmeterLocationPermissions  $flowmeterLocationPermissions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FlowmeterLocationPermissions $flowmeterLocationPermissions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Emon\FlowmeterLocationPermissions  $flowmeterLocationPermissions
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlowmeterLocationPermissions $flowmeterLocationPermissions)
    {
        //
    }
}
