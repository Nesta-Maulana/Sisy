<?php
namespace App\Http\Controllers\Transaction\Rollie;

use App\Http\Controllers\ResourceController;

use App\Models\Transaction\Rollie\Rkj;
use App\Models\Master\User;
use App\Models\Master\DistributionList;


use Illuminate\Support\Facades\Mail;
use App\Mail\Rollie\Ppq\PpqToRkjMail;

use Illuminate\Http\Request;

class RkjController extends ResourceController
{
    public function createRkj(Request $request)
    {
        // dd($request->all());
        $rkjs            	= Rkj::all();
        $rkjakhir       	= $rkjs->last();
        
        if ($rkjakhir !== null) 
        {      
            $nomor_rkj      = explode('/', $rkjakhir->nomor_rkj);
        }
        else
        {
            $nomor_rkj 		= null;
        }
        if($nomor_rkj == null)
        {
            $nomor_rkj   = 1;
        }
        else
        {
            $nomor_rkj   = $nomor_rkj['0']+1;
        }

        if (strlen($nomor_rkj) == 1) 
        {
            $nomor_rkj = '00'.$nomor_rkj;
        }
        else if(strlen($nomor_rkj) == 2)
        {
            $nomor_rkj = '0'.$nomor_rkj;
        }
        else if (strlen($nomor_rkj) == 3) 
        {
            $nomor_rkj = $nomor_rkj;
        }
        
        $bulan          = ['01'=>'I','02'=>'II','03'=>'III','04'=>'IV','05'=>'V','06'=>'VI','07'=>'VII','08'=>'VIII','09'=>'IX','10'=>'X','11'=>'XI','12'=>'XII'];
        $nomor_rkj      = $nomor_rkj.'/RKJ/'.$bulan[date('m')].'/'.date('Y');
        $rkj            = Rkj::create([
            'ppq_id'        => $this->decrypt($request->ppq_id),
            'nomor_rkj'     => $nomor_rkj,
            'rkj_date'      => date('Y-m-d'),
            'status_akhir'  => '0'
         ]);
        $rkj           = Rkj::find($rkj->id);
        $rkj->ppq->followUpPpq->hasil_analisa       = $request->hasil_analisa; 
        $rkj->ppq->followUpPpq->status_produk       = NULL; 
        $rkj->ppq->followUpPpq->tanggal_status_ppq  = NULL; 
        $rkj->ppq->followUpPpq->status_follow_up_ppq= NULL; 
        $rkj->ppq->followUpPpq->save();
        $rkj->ppq->status_akhir                     = '3';
        $rkj->ppq->save();
        switch ($rkj->ppq->palets[0]->palet->cppDetail->woNumber->product->subbrand->brand->brand_name) 
        {
            case 'NFI':
                $distributionLists  = DistributionList::where('rkj_nfi_mail_to','1')->get();
                $user_to            = array();
                
                foreach ($distributionLists as $distributionList) 
                {
                    array_push($user_to, $distributionList->employee->email);
                }
                
                $distributionLists          = DistributionList::where('rkj_nfi_mail_cc','1')->get();
                $user_cc            = array();
                foreach ($distributionLists as $distributionList) 
                {
                    array_push($user_cc, $distributionList->employee->email);
                }    
                Mail::to($user_to)->cc($user_cc)->bcc('nesta.maulana@nutrifood.co.id')->send(new PpqToRkjMail($rkj));
            break;   
        }
        return ['success'=>true,'message'=>'PPQ dengan nomor '.$rkj->ppq->nomor_ppq.' berhasil dieskalasi ke RKJ dengan nomor '.$rkj->nomor_rkj];
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
     * @param  \App\Models\Transaction\Rollie\Rkj  $rkj
     * @return \Illuminate\Http\Response
     */
    public function show(Rkj $rkj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction\Rollie\Rkj  $rkj
     * @return \Illuminate\Http\Response
     */
    public function edit(Rkj $rkj)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction\Rollie\Rkj  $rkj
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rkj $rkj)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction\Rollie\Rkj  $rkj
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rkj $rkj)
    {
        //
    }
}
