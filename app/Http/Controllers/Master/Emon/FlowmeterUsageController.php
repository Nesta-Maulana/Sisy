<?php

namespace App\Http\Controllers\Master\Emon;

use App\Models\Master\Emon\FlowmeterUsage;
use App\Http\Controllers\ResourceController;
use Illuminate\Http\Request;
class FlowmeterUsageController extends ResourceController
{
    public function manageFlowmeter(Request $request)
    {
        $cekAkses   = $this->checkAksesTambah(\Request::getRequestUri(),'master_app.master_data.manage_flowmeter_usages');
        if ($cekAkses['success']) 
        {
            $flowmeter_id                   = $request->flowmeter_id;
            $flowmeter_name                 = $request->flowmeter_name;
            $flowmeter_code                 = 'FU-'.strtoupper($request->flowmeter_code);
            $flowmeter_workcenter_id        = $this->decrypt($request->flowmeter_workcenter_id);
            $flowmeter_formula_id           = $this->decrypt($request->flowmeter_formula_id);
            $is_active                      = $request->is_active;
            if (is_null($flowmeter_id)) 
            {
                $flowmeterUsage             = FlowmeterUsage::create([
                    'flowmeter_name'            => $flowmeter_name,
                    'flowmeter_code'            => $flowmeter_code,
                    'flowmeter_workcenter_id'   => $flowmeter_workcenter_id,
                    'flowmeter_formula_id'      => $flowmeter_formula_id,
                    'is_active'                 => $is_active,
                ]);
                return redirect(route('master_app.master_data.manage_flowmeter_usages'))->with('success','Flowmeter Penggunaan Berhasil Diinput');
            } 
            else 
            {
            
            }
            
            
            dd($request->all());    
        } 
        else 
        {
            return redirect()->back()->with('error',$cekAkses['message']);
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
     * @param  \App\Models\Master\Emon\FlowmeterUsage  $flowmeterUsage
     * @return \Illuminate\Http\Response
     */
    public function show(FlowmeterUsage $flowmeterUsage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\Emon\FlowmeterUsage  $flowmeterUsage
     * @return \Illuminate\Http\Response
     */
    public function edit(FlowmeterUsage $flowmeterUsage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Emon\FlowmeterUsage  $flowmeterUsage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FlowmeterUsage $flowmeterUsage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Emon\FlowmeterUsage  $flowmeterUsage
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlowmeterUsage $flowmeterUsage)
    {
        //
    }
}
