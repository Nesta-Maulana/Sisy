<?php

namespace App\Http\Controllers\Master\Emon;

use App\Models\Master\Emon\FlowmeterLocationPermissions;
use App\Models\Master\Emon\FlowmeterLocation;
use App\Models\Master\Emon\FlowmeterCategory;
use App\Http\Controllers\ResourceController;
use App\Models\Master\User;
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
        
        $flowmeterLocations  = FlowmeterLocation::whereIn('flowmeter_category_id',$flowmeterCategories)->get();
        foreach ($flowmeterLocations as $flowmeterLocation) 
        {
            foreach ($users as $user) 
            {
                $flowmeterLocationPermission    = $flowmeterLocation->flowmeterLocationPermissions->where('user_id',$user->id);
                dd();
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
