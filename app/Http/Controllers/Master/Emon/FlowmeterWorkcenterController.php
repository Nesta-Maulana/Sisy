<?php

namespace App\Http\Controllers\Master\Emon;

use App\Models\Master\Emon\FlowmeterWorkcenter;
use App\Models\Master\Emon\FlowmeterCategory;
use App\Http\Controllers\ResourceController;
use Illuminate\Http\Request;

class FlowmeterWorkcenterController extends ResourceController
{
    public function manageFlowmeterWorkcenter(Request $request)
    {
        $flowmeter_category_id      = $this->decrypt($request->flowmeter_category_id);
        $flowmeter_workcenter       = $request->flowmeter_workcenter;
        $flowmeter_workcenter_id    = $request->flowmeter_workcenter_id;
        $is_active                  = $request->is_active;

        if (is_null($flowmeter_workcenter_id)) 
        {
            /* ini untuk penambahan flowmeter */
            $cekAkses   = $this->checkAksesTambah(\Request::getRequestUri(),'master_app.master_data.manage_flowmeter_workcenters');
            if ($cekAkses['success']) 
            {
                $checkData              = FlowmeterWorkcenter::where('flowmeter_workcenter',$flowmeter_workcenter)->first();
                if (is_null($checkData)) 
                {
                    // ini untuk penginputan data nya
                    FlowmeterWorkcenter::create([
                        'flowmeter_category_id'     => $flowmeter_category_id,
                        'flowmeter_workcenter'     => $flowmeter_workcenter,
                        'is_active'                 => $is_active
                    ]);
                    return redirect(route('master_app.master_data.manage_flowmeter_workcenters'))->with('success','Workcenter Flowmeter Baru : '.$flowmeter_workcenter.' Berhasil ditambahkan');
                } 
                else 
                {
                    return redirect()->back()->with('error','Workcenter Flowmeter sudah terdaftar');
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
            $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'master_app.master_data.manage_flowmeter_workcenters');
            if ($cekAkses['success'])
            {
                $flowmeter_workcenter_id                        = $request->flowmeter_workcenter_id;
                $flowmeter_workcenter                           = $request->flowmeter_workcenter;
                $is_active                                      = $request->is_active;
                $flowmeterWorkcenter                            = FlowmeterWorkcenter::find($this->decrypt($flowmeter_workcenter_id));
                $flowmeter_workcenter_lama                      = $flowmeterWorkcenter->flowmeter_workcenter;
                $flowmeterWorkcenter->flowmeter_category_id     = $flowmeter_category_id;
                $flowmeterWorkcenter->flowmeter_workcenter      = $flowmeter_workcenter;
                $flowmeterWorkcenter->is_active                 = $is_active;
                $flowmeterWorkcenter->save();
                return redirect(route('master_app.master_data.manage_flowmeter_workcenters'))->with('success','Workcenter Flowmeter : '.$flowmeter_workcenter_lama.' Berhasil diubah');
            } 
            else 
            {
                return redirect()->back()->with('error',$cekAkses['message']);
            }
            
        }
    }

    public function editFlowmeterWorkcenter($flowmeter_workcenter_id)
    {
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'master_app.master_data.manage_flowmeter_workcenters');
        if ($cekAkses['success'] == true) 
        {
            $flowmeterWorkcenter  = FlowmeterWorkcenter::find($this->decrypt($flowmeter_workcenter_id));
            if (is_null($flowmeterWorkcenter)) 
            {
                return ['success'=>false,'message'=>'Data tidak ditemukan'];
            } 
            else 
            {
                $flowmeterWorkcenter              = $this->encryptId($flowmeterWorkcenter,'flowmeter_category_id');
                $flowmeterWorkcenter->success     = true;
                return $flowmeterWorkcenter;
            }
            
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
     * @param  \App\Models\Master\Emon\FlowmeterWorkcenter  $flowmeterWorkcenter
     * @return \Illuminate\Http\Response
     */
    public function show(FlowmeterWorkcenter $flowmeterWorkcenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\Emon\FlowmeterWorkcenter  $flowmeterWorkcenter
     * @return \Illuminate\Http\Response
     */
    public function edit(FlowmeterWorkcenter $flowmeterWorkcenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Emon\FlowmeterWorkcenter  $flowmeterWorkcenter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FlowmeterWorkcenter $flowmeterWorkcenter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Emon\FlowmeterWorkcenter  $flowmeterWorkcenter
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlowmeterWorkcenter $flowmeterWorkcenter)
    {
        //
    }
}
