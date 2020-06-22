<?php

namespace App\Http\Controllers\Master\Emon;

use App\Models\Master\Emon\Flowmeter;
use Illuminate\Http\Request;
use App\Http\Controllers\ResourceController;
class FlowmeterController extends ResourceController
{
    public function manageFlowmeter(Request $request)
    {
        $flowmeter_id               = $this->decrypt($request->flowmeter_id);
        $flowmeter_name             = $request->flowmeter_name;
        $flowmeter_workcenter_id    = $this->decrypt($request->flowmeter_workcenter_id);
        $flowmeter_location_id      = $this->decrypt($request->flowmeter_location_id);
        $flowmeter_unit_id          = $this->decrypt($request->flowmeter_unit_id);
        $is_active                  = $request->is_active;

        if (is_null($request->flowmeter_id)) 
        {
            /* ini untuk penambahan flowmeter */
            $cekAkses   = $this->checkAksesTambah(\Request::getRequestUri(),'master_app.master_data.manage_flowmeters');
            if ($cekAkses['success']) 
            {
                $checkData              = Flowmeter::where('flowmeter_name',$flowmeter_name)->where('flowmeter_workcenter_id',$flowmeter_workcenter_id)->where('flowmeter_location_id',$flowmeter_location_id)->where('flowmeter_unit_id',$flowmeter_unit_id)->first();
                if (is_null($checkData)) 
                {
                    // ini untuk penginputan data nya
                    Flowmeter::create([
                        'flowmeter_name'            => $flowmeter_name,
                        'flowmeter_workcenter_id'   => $flowmeter_workcenter_id,
                        'flowmeter_location_id'     => $flowmeter_location_id,
                        'flowmeter_unit_id'         => $flowmeter_unit_id,
                        'recording_schedule'        => $request->kategori_pencatatan,
                        'is_active'                 => $is_active
                    ]);
                    return redirect(route('master_app.master_data.manage_flowmeters'))->with('success','Workcenter Flowmeter Baru : '.$flowmeter_name.' Berhasil ditambahkan');
                } 
                else 
                {
                    return redirect()->back()->with('error','Flowmeter sudah terdaftar');
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
            $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'master_app.master_data.manage_flowmeters');
            if ($cekAkses['success'])
            {
                $flowmeter_id                               = $request->flowmeter_id;
                $flowmeter_name                             = $request->flowmeter_name;
                $is_active                                  = $request->is_active;
                $flowmeter                                  = Flowmeter::find($this->decrypt($flowmeter_id));
                $flowmeter_lama                             = $flowmeter->flowmeter_name;
                $flowmeter->flowmeter_name                  = $flowmeter_name;
                $flowmeter->flowmeter_location_id           = $flowmeter_location_id;
                $flowmeter->flowmeter_workcenter_id         = $flowmeter_workcenter_id;
                $flowmeter->flowmeter_unit_id               = $flowmeter_unit_id;
                $flowmeter->recording_schedule              = $request->kategori_pencatatan;
                $flowmeter->is_active                       = $is_active;
                $flowmeter->save();
                return redirect(route('master_app.master_data.manage_flowmeters'))->with('success','Flowmeter : '.$flowmeter_lama.' Berhasil diubah');
            } 
            else 
            {
                return redirect()->back()->with('error',$cekAkses['message']);
            }
            
        }
    }

    public function editFlowmeter($flowmeter_id)
    {
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'master_app.master_data.manage_flowmeters');
        if ($cekAkses['success'] == true) 
        {
            $flowmeter  = Flowmeter::find($this->decrypt($flowmeter_id));
            if (is_null($flowmeter)) 
            {
                return ['success'=>false,'message'=>'Data tidak ditemukan'];
            } 
            else 
            {
                $flowmeter              = $this->encryptId($flowmeter,'flowmeter_workcenter_id','flowmeter_location_id','flowmeter_unit_id');
                $flowmeter->success     = true;
                return $flowmeter;
            }
            
        } 
        else 
        {
            return $cekAkses;
        }
    }

    public function show(Flowmeter $flowmeter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\Emon\Flowmeter  $flowmeter
     * @return \Illuminate\Http\Response
     */
    public function edit(Flowmeter $flowmeter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Emon\Flowmeter  $flowmeter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flowmeter $flowmeter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Emon\Flowmeter  $flowmeter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flowmeter $flowmeter)
    {
        //
    }
}
