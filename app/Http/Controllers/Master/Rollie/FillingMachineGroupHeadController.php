<?php

namespace App\Http\Controllers\Master\Rollie;
use App\Http\Controllers\ResourceController;

use App\Models\Master\FillingMachineGroupHead;
use App\Models\Master\FillingMachineGroupDetail;
use App\Models\Master\FillingMachine;

use Illuminate\Http\Request;

class FillingMachineGroupHeadController extends ResourceController
{
    public function manangeFillingMachineGroup(Request $request)
    {
        if (is_null($request->filling_machine_group_head_id)) 
        {  
            $cekAkses                       = $this->checkAksesTambah(\Request::getRequestUri(),'master_app.master_data.manage_filling_machine_groups');
            if ($cekAkses['success']) 
            {   
                $filling_machine_group_name     = $request->filling_machine_group_name;
                $fillingMachines                = $request->filling_machine_detail;
                $is_active                      = $request->is_active;
                $fillingMachineGroupHead        = FillingMachineGroupHead::create([
                    'filling_machine_group_name'    => $filling_machine_group_name,
                    'is_active'                     => $is_active,
                ]);
                foreach ($fillingMachines as $fillingMachine) 
                {
                    FillingMachineGroupDetail::create([
                        'filling_machine_group_head_id' => $fillingMachineGroupHead->id,
                        'filling_machine_id' => $this->decrypt($fillingMachine),
                    ]);
                }
                return redirect()->route('master_app.master_data.manage_filling_machine_groups')->with('success',$fillingMachineGroupHead->filling_machine_group_name.' telah berhasil ditambahkan.');
            } 
            else 
            {
                return redirect()->route('master_app.master_data.manage_filling_machine_groups')->with('error',$cekAkses['message']);
            }
        } 
        else 
        {
                       
        }
        
    }

    public function getFillingMachineGroup($filling_machine_head_group_id)
    {
        $cekAkses  = $this->checkAksesUbah(\Request::getRequestUri(),'master_app.master_data.manage_filling_machine_groups');
        if ($cekAkses['success']) 
        {
            $fillingMachineGroupHead    = FillingMachineGroupHead::find($this->decrypt($filling_machine_head_group_id));
            foreach ($fillingMachineGroupHead->fillingMachineGroupDetail as $fillingMachineGroupDetail) 
            {
                $fillingMachine     = $fillingMachineGroupDetail->fi
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
     * @param  \App\Models\Master\FillingMachineGroupHead  $fillingMachineGroupHead
     * @return \Illuminate\Http\Response
     */
    public function show(FillingMachineGroupHead $fillingMachineGroupHead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\FillingMachineGroupHead  $fillingMachineGroupHead
     * @return \Illuminate\Http\Response
     */
    public function edit(FillingMachineGroupHead $fillingMachineGroupHead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\FillingMachineGroupHead  $fillingMachineGroupHead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FillingMachineGroupHead $fillingMachineGroupHead)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\FillingMachineGroupHead  $fillingMachineGroupHead
     * @return \Illuminate\Http\Response
     */
    public function destroy(FillingMachineGroupHead $fillingMachineGroupHead)
    {
        //
    }
}
