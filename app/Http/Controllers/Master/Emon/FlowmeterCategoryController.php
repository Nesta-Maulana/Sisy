<?php

namespace App\Http\Controllers\Master\Emon;

use App\Models\Master\Emon\FlowmeterCategory;
use App\Http\Controllers\ResourceController;
use Illuminate\Http\Request;

class FlowmeterCategoryController extends ResourceController
{
    public function manageFlowmeterCategory(Request $request)
    {
        $flowmeter_category     = $request->flowmeter_category;
        $is_active              = $request->is_active;
        if (is_null($request->flowmeter_category_id)) 
        {
            /* ini untuk penambahan flowmeter */
            $cekAkses   = $this->checkAksesTambah(\Request::getRequestUri(),'master_app.master_data.manage_flowmeter_categories');
            if ($cekAkses['success']) 
            {
                $checkData              = FlowmeterCategory::where('flowmeter_category',$flowmeter_category)->first();
                if (is_null($checkData)) 
                {
                    // ini untuk penginputan data nya
                    FlowmeterCategory::create([
                        'flowmeter_category'    => $flowmeter_category,
                        'is_active'             => $is_active
                    ]);
                    return redirect(route('master_app.master_data.manage_flowmeter_categories'))->with('success','Kategori Flowmeter Baru : '.$flowmeter_category.' Berhasil ditambahkan');
                } 
                else 
                {
                    return redirect()->back()->with('error','Kategori Flowmeter sudah terdaftar');
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
            $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'master_app.master_data.manage_flowmeter_categories');
            if ($cekAkses['success'])
            {
                $flowmeter_category_id                  = $request->flowmeter_category_id;
                $flowmeter_category                     = $request->flowmeter_category;
                $is_active                              = $request->is_active;
                $flowmeterCategory                      = FlowmeterCategory::find($this->decrypt($flowmeter_category_id));
                $flowmeter_category_lama                = $flowmeterCategory->flowmeter_category;
                $flowmeterCategory->flowmeter_category  = $flowmeter_category;
                $flowmeterCategory->is_active           = $is_active;
                $flowmeterCategory->save();
                return redirect(route('master_app.master_data.manage_flowmeter_categories'))->with('success','Kategori Flowmeter : '.$flowmeter_category_lama.' Berhasil diubah');
            } 
            else 
            {
                return redirect()->back()->with('error',$cekAkses['message']);
            }
            
        }
        
    }

    public function editFlowmeterCategory($flowmeter_category_id)
    {
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'master_app.master_data.manage_flowmeter_categories');
        if ($cekAkses['success'] == true) 
        {
            $flowmeterCategory  = FlowmeterCategory::find($this->decrypt($flowmeter_category_id));
            if (is_null($flowmeterCategory)) 
            {
                return ['success'=>false,'message'=>'Data tidak ditemukan'];
            } 
            else 
            {
                $flowmeterCategory              = $this->encryptId($flowmeterCategory);
                $flowmeterCategory->success     = true;
                return $flowmeterCategory;
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
     * @param  \App\Models\Master\Emon\FlowmeterCategory  $flowmeterCategory
     * @return \Illuminate\Http\Response
     */
    public function show(FlowmeterCategory $flowmeterCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\Emon\FlowmeterCategory  $flowmeterCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(FlowmeterCategory $flowmeterCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Emon\FlowmeterCategory  $flowmeterCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FlowmeterCategory $flowmeterCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Emon\FlowmeterCategory  $flowmeterCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlowmeterCategory $flowmeterCategory)
    {
        //
    }
}
