<?php

namespace App\Http\Controllers\Master\MasterApp;

use App\Models\Master\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\ResourceController;
class ApplicationController extends ResourceController
{

    public function manageApplication(Request $request)
    {
        if (is_null($request->application_id)) 
        {
            $cekAkses   = $this->checkAksesTambah(\Request::getRequestUri(),'master_app.manage_applications');
            if ($cekAkses['success']) 
            {
                $application    = Application::create([
                    'application_name'          => $request->application_name,
                    'application_description'   => $request->application_description,
                    'application_link'          => $request->application_link,
                    'is_active'                 => $request->application_status
                ]);
                if ($application) 
                {
                    return redirect(route('master_app.manage_applications'))->with('success',$application->name.' berhasil ditambahkan harap konfigurasi file pendukung dan manajemen hak akses secara manual');
                }
            } 
            else 
            {
                return redirect()->back()->with('error',$cekAkses['message']);
            }
        }
        else
        {
            $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'master_app.manage_applications');
            if ($cekAkses['success']) 
            {
                $application    = Application::find($this->decrypt($request->application_id));
                $application->application_name          = $request->application_name;
                $application->application_description   = $request->application_description;
                $application->application_link          = $request->application_link;
                $application->is_active                 = $request->application_status;
                $application->save();
                return redirect(route('master_app.manage_applications'))->with('success','Data aplikasi '.$application->name.' berhasil diubah');
            } 
            else 
            {
                return redirect()->back()->with('error',$cekAkses['message']);
            }
        }
        
    }

    public function editApplication($application_id)
    {
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'master_app.manage_applications');
        if ($cekAkses['success']) 
        {
            $application    = Application::find($this->decrypt($application_id));
            $application    = $this->encryptId($application);
            $application->success   = true;
            return $application;
        } 
        else 
        {
            return $cekAkses;
        }
        
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
     * @param  \App\Models\Master\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        //
    }
}
