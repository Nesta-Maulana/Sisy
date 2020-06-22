<?php

namespace App\Http\Controllers\Master\Rollie;

use App\Http\Controllers\ResourceController;
use App\Models\Master\FillingMachine;
use Illuminate\Http\Request;

class FillingMachineController extends ResourceController
{
    public function manageFillingMachine(Request $request)
    {
        if (is_null($request->filling_machine_id)) 
        {
            $cekAkses   = $this->checkAksesTambah(\Request::getRequestUri(),'master_app.master_data.manage_filling_machines');
            if ($cekAkses['success']) 
            {
                $cekMesinFilling  =  FillingMachine::where('filling_machine_code',$request->filling_machine_code)->first();
                if (is_null($cekMesinFilling)) 
                {
                    $mesinFilling   = FillingMachine::create([
                        'filling_machine_code'  => $request->filling_machine_code,
                        'filling_machine_name'  => $request->filling_machine_name,
                        'is_active'             => $request->is_active
                    ]);
                    return redirect()->route('master_app.master_data.manage_filling_machines')->with('success','Mesin filling dengan Kode '.$mesinFilling->filling_machine_code.' telah berhasil didaftarkan dengan identitat '.$mesinFilling->filling_machine_name);
                } 
                else 
                {
                    return redirect()->back()->with('error','Mesin filling dengan kode '.$request->filling_machine_code.' sudah terdaftar dengan nama mesin filling '.$cekMesinFilling->filling_machine_name.'. Harap periksa kembali data yang ingin ditambahkan');
                }
                
            } 
            else 
            {
                return  redirect()->back()->with('error',$cekAkses['message']);
            }
            
        } 
        else 
        {
            $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'master_app.master_data.manage_filling_machines');
            if ($cekAkses['success']) 
            {
                $fillingMachine                         = FillingMachine::find($this->decrypt($request->filling_machine_id));
                $oldData                                = $fillingMachine;
                $fillingMachine->filling_machine_code   = $request->filling_machine_code;                
                $fillingMachine->filling_machine_name   = $request->filling_machine_name;                
                $fillingMachine->is_active              = $request->is_active;
                $fillingMachine->save();
                return redirect()->route('master_app.master_data.manage_filling_machines')->with('success','Data mesin filling dengan kode mesin filling '.$oldData->filling_machine_code.' berhasil diubah');
            }
            else 
            {
                return redirect()->route('master_app.master_data.manage_filling_machines')->with('error',$cekAkses['message']);
            }
            
        }
        
    }

    public function editFillingMachine($filling_machine_id)
    {
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'master_app.master_data.manage_filling_machines');
        if ($cekAkses['success']) 
        {
            $filling_machine_id     = $this->decrypt($filling_machine_id);
            $fillingMachine         = FillingMachine::find($filling_machine_id);
            $fillingMachine         = $this->encryptId($fillingMachine);
            $fillingMachine->success = true;
            return $fillingMachine;
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
     * @param  \App\Models\Master\FillingMachine  $fillingMachine
     * @return \Illuminate\Http\Response
     */
    public function show(FillingMachine $fillingMachine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\FillingMachine  $fillingMachine
     * @return \Illuminate\Http\Response
     */
    public function edit(FillingMachine $fillingMachine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\FillingMachine  $fillingMachine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FillingMachine $fillingMachine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\FillingMachine  $fillingMachine
     * @return \Illuminate\Http\Response
     */
    public function destroy(FillingMachine $fillingMachine)
    {
        //
    }
}
