<?php

namespace App\Http\Controllers\Master\Emon;

use Illuminate\Http\Request;
use App\Models\Master\Emon\FlowmeterUnit;
use App\Http\Controllers\ResourceController;
class FlowmeterUnitController extends ResourceController
{
    public function manageFlowmeterUnit(Request $request)
    {
        $flowmeter_unit_id          = $this->decrypt($request->flowmeter_unit_id);
        $flowmeter_unit             = $request->flowmeter_unit;
        $is_active                  = $request->is_active;

        if (is_null($request->flowmeter_unit_id)) 
        {
            /* ini untuk penambahan flowmeter */
            $cekAkses   = $this->checkAksesTambah(\Request::getRequestUri(),'master_app.master_data.manage_flowmeter_units');
            if ($cekAkses['success']) 
            {
                $checkData              = FlowmeterUnit::where('flowmeter_unit',$flowmeter_unit)->first();
                if (is_null($checkData)) 
                {
                    // ini untuk penginputan data nya
                    FlowmeterUnit::create([
                        'flowmeter_unit'            => $flowmeter_unit,
                        'is_active'                 => $is_active
                    ]);
                    return redirect(route('master_app.master_data.manage_flowmeter_units'))->with('success','Workcenter Flowmeter Baru : '.$flowmeter_unit.' Berhasil ditambahkan');
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
            $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'master_app.master_data.manage_flowmeter_units');
            if ($cekAkses['success'])
            {
                $flowmeter_unit_id                              = $request->flowmeter_unit_id;
                $flowmeter_unit                                 = $request->flowmeter_unit;
                $is_active                                      = $request->is_active;
                $flowmeterUnit                                  = FlowmeterUnit::find($this->decrypt($flowmeter_unit_id));
                $flowmeter_unit_lama                            = $flowmeterUnit->flowmeter_unit;
                $flowmeterUnit->flowmeter_unit                  = $flowmeter_unit;
                $flowmeterUnit->is_active                       = $is_active;
                $flowmeterUnit->save();
                return redirect(route('master_app.master_data.manage_flowmeter_units'))->with('success','Satuan Flowmeter : '.$flowmeter_unit_lama.' Berhasil diubah');
            } 
            else 
            {
                return redirect()->back()->with('error',$cekAkses['message']);
            }
            
        }
    }

    public function editFlowmeterUnit($flowmeter_unit_id)
    {
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'master_app.master_data.manage_flowmeter_units');
        if ($cekAkses['success'] == true) 
        {
            $flowmeterUnit  = FlowmeterUnit::find($this->decrypt($flowmeter_unit_id));
            if (is_null($flowmeterUnit)) 
            {
                return ['success'=>false,'message'=>'Data tidak ditemukan'];
            } 
            else 
            {
                $flowmeterUnit              = $this->encryptId($flowmeterUnit);
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
     * @param  \App\Models\Master\Emon\FlowmeterUnit  $flowmeterUnit
     * @return \Illuminate\Http\Response
     */
    public function show(FlowmeterUnit $flowmeterUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\Emon\FlowmeterUnit  $flowmeterUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(FlowmeterUnit $flowmeterUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Emon\FlowmeterUnit  $flowmeterUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FlowmeterUnit $flowmeterUnit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Emon\FlowmeterUnit  $flowmeterUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlowmeterUnit $flowmeterUnit)
    {
        //
    }
}
