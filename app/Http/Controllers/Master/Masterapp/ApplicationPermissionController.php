<?php

namespace App\Http\Controllers\Master\Masterapp;

use App\Models\Master\ApplicationPermission;
use App\Models\Master\Application;
use App\Models\Master\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ResourceController;
class ApplicationPermissionController extends ResourceController
{
    public function getApplicationPermission($user_id)
    {
        $cekAkses   = $this->checkAksesLihat(\Request::getRequestUri(),'master_app.application_permissions');
        if ($cekAkses['success']) 
        {
            $user_id    = $this->decrypt($user_id);
            if (strpos($user_id,',') !== false) 
            {
            
            } 
            else 
            {
                if ($user_id == 'all') 
                {
                    $applications        = Application::where('is_active','1')->get();
                    foreach ($applications as $application) 
                    {
                        $application->application_permission = 'all';
                        unset($application->applicationPermissions);
                        $appplication   = $this->encryptId($application);

                    }

                    return $applications;
                } 
                else 
                {
                    $applications        = Application::where('is_active','1')->get();
                    foreach ($applications as $application) 
                    {
                        $applicationPermissions =  $application->applicationPermissions->where('user_id',$user_id)->first();
                        $appplication   = $this->encryptId($application);
                        // dd($applicationPermissions);
                        if (is_null($applicationPermissions)) 
                        {
                            $application->application_permission = 'all';
                        }
                        else
                        {
                            $application->application_permission   = $applicationPermissions;
                        }
                        unset($application->applicationPermissions);
                    }
                    return $applications;
                }
                
            }
            
        } 
        else 
        {
            return $cekAkses;
        }
        
    }

    public function manageApplicationPermission(Request $request)
    {
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'master_app.application_permissions');
        if ($cekAkses['success'])
        {
            $users          = $request->user_id;
            $userakses      = ""; 
            unset($request['user_id']);
            unset($request['_token']);
            foreach ($request->all() as $application_id => $application_access) 
            {
                $application_id     = explode('_',$application_id);
                $application_id     = end($application_id);
                $application        = Application::find($this->decrypt($application_id));
                foreach ($users as $user_id) 
                {
                    $user_id    = $this->decrypt($user_id);
                    if ($user_id == 'all') 
                    {
                        $pengguna           = User::where('is_active','1')->get();
                        $userakses          .=  'seluruh user ';
                        foreach ($pengguna as $user) 
                        {
                            $applicationPermission  = $application->applicationPermissions->where('user_id',$user->id)->first();
                            if (!is_null($applicationPermission))
                            {
                                $applicationPermission->is_active   = $application_access;
                                $applicationPermission->save();
                            } 
                            else 
                            {
                                if ($application_access == '1') 
                                {
                                    ApplicationPermission::create([
                                        'application_id'    => $application->id,
                                        'user_id'           => $user->id,
                                        'is_active'         => $application_access
                                    ]);
                                }                         
                            }       
                        }
                    }
                    else 
                    {
                        $user    = User::find($user_id);
                        if (strpos($userakses,$user->employee->fullname.', ') === false) 
                        {
                            $userakses      .=  $user->employee->fullname.', ';
                        }
                        $applicationPermission  = $application->applicationPermissions->where('user_id',$user_id)->first();
                        if (!is_null($applicationPermission))
                        {
                            $applicationPermission->is_active   = $application_access;
                            $applicationPermission->save();
                        } 
                        else 
                        {
                            if ($application_access == '1') 
                            {
                                ApplicationPermission::create([
                                    'application_id'    => $application->id,
                                    'user_id'           => $user->id,
                                    'is_active'         => $application_access
                                ]);
                            } 
                            
                        }
                        
                    }
                    
                }
            }
            return redirect()->route('master_app.application_permissions')->with('success','Hak Akses Aplikasi Berhasil untuk user '.rtrim($userakses,', ').' berhasil diubah');
        } 
        else 
        {
            return redirect(route('master_app.application_permissions')->with('error',$cekAkses['message']));
        }
        
    }

    public function changeApplicationPermission(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\ApplicationPermission  $applicationPermission
     * @return \Illuminate\Http\Response
     */
    public function show(ApplicationPermission $applicationPermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\ApplicationPermission  $applicationPermission
     * @return \Illuminate\Http\Response
     */
    public function edit(ApplicationPermission $applicationPermission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\ApplicationPermission  $applicationPermission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApplicationPermission $applicationPermission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\ApplicationPermission  $applicationPermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApplicationPermission $applicationPermission)
    {
        //
    }
}
