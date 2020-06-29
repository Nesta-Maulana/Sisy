<?php
namespace App\Http\Controllers\Master\Emon;

use App\Http\Controllers\ResourceController;
use App\Models\Master\Emon\FlowmeterLocation;
use Illuminate\Http\Request;

class FlowmeterLocationController extends ResourceController
{
    public function manageFlowmeterLocation(Request $request)
    {
        $flowmeter_location_id          = $this->decrypt($request->flowmeter_location_id);
        $flowmeter_category_id          = $this->decrypt($request->flowmeter_category_id);
        $flowmeter_location             = $request->flowmeter_location;
        $is_active                      = $request->is_active;

        if (is_null($request->flowmeter_location_id)) 
        {
            /* ini untuk penambahan flowmeter */
            $cekAkses   = $this->checkAksesTambah(\Request::getRequestUri(),'master_app.master_data.manage_flowmeter_locations');
            if ($cekAkses['success']) 
            {
                $checkData              = FlowmeterLocation::where('flowmeter_location',$flowmeter_location)->where('flowmeter_category_id',$flowmeter_category_id)->first();
                if (is_null($checkData)) 
                {
                    // ini untuk penginputan data nya
                    FlowmeterLocation::create([
                        'flowmeter_category_id'     => $flowmeter_category_id,
                        'flowmeter_location'        => $flowmeter_location,
                        'is_active'                 => $is_active
                    ]);
                    return redirect(route('master_app.master_data.manage_flowmeter_locations'))->with('success','Workcenter Flowmeter Baru : '.$flowmeter_location.' Berhasil ditambahkan');
                } 
                else 
                {
                    return redirect()->back()->with('error','Satuan Flowmeter sudah terdaftar');
                }
                
            } 
            else 
            {
                return redirect()->back()->with('error',$cekAkses['message']);
            }
        } 
        else 
        {
            /*  ini untuk ubah data */
            $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'master_app.master_data.manage_flowmeter_locations');
            if ($cekAkses['success'])
            {
                $flowmeter_location_id                              = $request->flowmeter_location_id;
                $flowmeter_category_id                              = $request->flowmeter_category_id;
                $flowmeter_location                                 = $request->flowmeter_location;
                $is_active                                          = $request->is_active;
                $flowmeterUnit                                      = FlowmeterLocation::find($this->decrypt($flowmeter_location_id));
                $flowmeter_location_lama                            = $flowmeterUnit->flowmeter_location;
                $flowmeterUnit->flowmeter_location                  = $flowmeter_location;
                $flowmeterUnit->flowmeter_category_id               = $flowmeter_category_id;
                $flowmeterUnit->is_active                           = $is_active;
                $flowmeterUnit->save();
                return redirect(route('master_app.master_data.manage_flowmeter_locations'))->with('success','Satuan Flowmeter : '.$flowmeter_location_lama.' Berhasil diubah');
            } 
            else 
            {
                return redirect()->back()->with('error',$cekAkses['message']);
            }
            
        }
    }

    public function editFlowmeterLocation($flowmeter_location_id)
    {
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'master_app.master_data.manage_flowmeter_locations');
        if ($cekAkses['success'] == true) 
        {
            $flowmeterUnit  = FlowmeterLocation::find($this->decrypt($flowmeter_location_id));
            if (is_null($flowmeterUnit)) 
            {
                return ['success'=>false,'message'=>'Data tidak ditemukan'];
            } 
            else 
            {
                $flowmeterUnit              = $this->encryptId($flowmeterUnit,'flowmeter_category_id');
                $flowmeterUnit->success     = true;
                return $flowmeterUnit;
            }
            
        } 
        else 
        {
            return $cekAkses;
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Emon\FlowmeterLocation  $flowmeterLocation
     * @return \Illuminate\Http\Response
     */
    public function show(FlowmeterLocation $flowmeterLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\Emon\FlowmeterLocation  $flowmeterLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(FlowmeterLocation $flowmeterLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Emon\FlowmeterLocation  $flowmeterLocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FlowmeterLocation $flowmeterLocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Emon\FlowmeterLocation  $flowmeterLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlowmeterLocation $flowmeterLocation)
    {
        //
    }
}
