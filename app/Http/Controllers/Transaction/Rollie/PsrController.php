<?php

namespace App\Http\Controllers\Transaction\Rollie;

use App\Models\Transaction\Rollie\Psr;
use App\Models\Master\FillingSampelCode;
use App\Models\Master\FillingMachine;
use Illuminate\Http\Request;
use App\Http\Controllers\ResourceController;

class PsrController extends ResourceController
{
    public function getPsrDetail(Request $request)
    {
        $psr_id             = $this->decrypt($request->psr_id);
        $psr                = Psr::find($psr_id);
        $product_type       = $psr->woNumber->product->productType->id;
        $filling_machine_id = array();
        foreach ($psr->woNumber->rpdFillingDetailPis as $rpdFillingDetailPi) 
        {
            if (!in_array($rpdFillingDetailPi->filling_machine_id,$filling_machine_id)) 
            {
                array_push($filling_machine_id,$rpdFillingDetailPi->filling_machine_id);
            }
        }
        $array_return   = array();
        foreach ($filling_machine_id as $filling_machine_id_nya) 
        {
            $fillingMachine         = FillingMachine::find($filling_machine_id_nya); 
            $fillingSampelCodes     = FillingSampelCode::where('product_type_id',$product_type)->where('filling_machine_id',$filling_machine_id)->get();
            foreach ($fillingSampelCodes as $fillingSampelCode) 
            {
                $hitung_jumlah      = $psr->woNumber->rpdFillingDetailPis->where('filling_machine_id',$filling_machine_id_nya)->where('filling_sampel_code_id',$fillingSampelCode->id)->count();
                $fillingSampelCode->hitung_jumlah   = $hitung_jumlah;
                // dd($hitung_jumlah);
            }
            $fillingMachine->fillingSampelCode  = $fillingSampelCodes;
            array_push($array_return, $fillingMachine);
        }
        return $array_return;
    }

    public function ubahPsr(Request $request)
    {
        $psr_id     = $this->decrypt($request->psr_id);
        $qty        = $request->qty;
        $note       = $request->note;
        $psr        = Psr::find($psr_id);
        $psr->psr_qty   = $qty;
        $psr->note  = $note;
        $psr->save();
        return ['success'=>true];
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
     * @param  \App\Models\Transaction\Rollie\Psr  $psr
     * @return \Illuminate\Http\Response
     */
    public function show(Psr $psr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction\Rollie\Psr  $psr
     * @return \Illuminate\Http\Response
     */
    public function edit(Psr $psr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction\Rollie\Psr  $psr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Psr $psr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction\Rollie\Psr  $psr
     * @return \Illuminate\Http\Response
     */
    public function destroy(Psr $psr)
    {
        //
    }
}
