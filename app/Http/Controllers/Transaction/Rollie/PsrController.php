<?php

namespace App\Http\Controllers\Transaction\Rollie;
use App\Http\Controllers\ResourceController;

use App\Models\Transaction\Rollie\Psr;
use App\Models\Master\FillingSampelCode;
use App\Models\Master\FillingMachine;
use App\Models\Master\User;
use App\Models\Master\DistributionList;

use Illuminate\Http\Request;

use App\Mail\Rollie\Psr\SendNotifPsr;
use Illuminate\Support\Facades\Mail;


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
            $fillingSampelCodes     = FillingSampelCode::where('product_type_id',$product_type)->where('filling_machine_id',$fillingMachine->id)->get();
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

    public function sendPsrToPenyelia(Request $request)
    {
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'rollie.process_data.psr');
        if ($cekAkses['success']) 
        {
            $psr_array  = array();
            foreach ($request->psr_id as $id) 
            {
                $psr = Psr::find($this->decrypt($id));
                $psr->psr_status = '1';
                $psr->save();
                array_push($psr_array,$psr);
            }
            
            $distributionLists  = DistributionList::where('psr_mail_to','1')->get();
            $user_to            = array();
            foreach ($distributionLists as $distributionList) 
            {
                array_push($user_to, $distributionList->employee->email);
            }
            
            $distributionLists          = DistributionList::where('psr_mail_cc','1')->get();
            $user_cc            = array();
            foreach ($distributionLists as $distributionList) 
            {
                array_push($user_cc, $distributionList->employee->email);
            }
            // $user_to        =array('adiyono@nutrifood.co.id','hendra@nutrifood.co.id','yunianto@nutrifood.co.id');
            // $user_cc        = array('febdian@nutrifood.co.id','qc.rtd@nutrifood.co.id','annisa.mutiara@nutrifood.co.id');
            Mail::to($user_to)->cc($user_cc)->bcc('nesta.maulana@nutrifood.co.id')->send(new SendNotifPsr($psr_array));
            return ['success'=>true,'message'=>'Notifikasi PSR sudah terkirim. Harap print PSR untuk kebutuhan dokumen finance.'];
        } 
        else 
        {
            return $cekAkses;
        }
        
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
