<?php

namespace App\Http\Controllers\Master\Emon;

use App\Models\Master\Emon\FlowmeterFormula;
use App\Http\Controllers\ResourceController;
use Illuminate\Http\Request;

class FlowmeterFormulaController extends ResourceController
{
    public function manageFormula(Request $request)
    {
        $cekAkses   =  $this->checkAksesTambah(\Request::getRequestUri(),'master_app.master_data.manage_flowmeter_formulas');
        if ($cekAkses['success']) 
        {
            $array_formula  = array();
            $start_read     = 0;
            $flowmeter_formula  = $request->flowmeter_formula;
            // dd($flowmeter_formula);
            $jumlah_string      = 0;
            for ($i=0; $i < strlen($flowmeter_formula) ; $i++) 
            { 

                if ($flowmeter_formula[$i] == '-' || $flowmeter_formula[$i] == '+' || $flowmeter_formula[$i] == '/' || $flowmeter_formula[$i] == 'x' || $flowmeter_formula[$i] == '(' || $flowmeter_formula[$i] == ')') 
                {
                    if ($i == 0) 
                    {
                        array_push($array_formula,$flowmeter_formula[$i]);
                        $start_read = $i+1;   
                    }
                    else
                    {
                        $pecah  = substr($flowmeter_formula,$start_read,$jumlah_string);
                        array_push($array_formula,$pecah);
                        array_push($array_formula,$flowmeter_formula[$i]);
                        $start_read = $i+1;
                        $jumlah_string = 0;
                    }
                }
                else
                {
                    $jumlah_string++;
                    if ($i == strlen($flowmeter_formula)-1) 
                    {
                        $pecah  = substr($flowmeter_formula,$start_read,$jumlah_string);
                        array_push($array_formula,$pecah);
                    }
                }
            }
            $array_formula      = array_values($array_formula);
            // dd($array_formula);
            $json_formula       = json_encode($array_formula);
            $flowmeterFormula   = FlowmeterFormula::create([
                'formula_code'          => strtoupper($request->flowmeter_formula_code),
                'flowmeter_formula'     => $json_formula,
                'is_active'             => $request->is_active,
            ]); 
            return redirect(route('master_app.master_data.manage_flowmeter_formulas'))->with('success','Rumus Berhasil Disimpan');

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
     * @param  \App\Models\Master\Emon\FlowmeterFormula  $flowmeterFormula
     * @return \Illuminate\Http\Response
     */
    public function show(FlowmeterFormula $flowmeterFormula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\Emon\FlowmeterFormula  $flowmeterFormula
     * @return \Illuminate\Http\Response
     */
    public function edit(FlowmeterFormula $flowmeterFormula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Emon\FlowmeterFormula  $flowmeterFormula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FlowmeterFormula $flowmeterFormula)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Emon\FlowmeterFormula  $flowmeterFormula
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlowmeterFormula $flowmeterFormula)
    {
        //
    }
}
