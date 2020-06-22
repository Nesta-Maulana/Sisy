<?php

namespace App\Http\Controllers\Transaction\Rollie;


use App\Models\Transaction\Rollie\FollowUpRkj;
use App\Http\Controllers\ResourceController;
use App\Models\Transaction\Rollie\Rkj;
use Illuminate\Http\Request;

use App\Models\Master\User;
use App\Models\Master\DistributionList;
use Illuminate\Support\Facades\Mail;
use App\Mail\Rollie\Rkj\FollowUpRkjMail;

use App\Models\Transaction\Rollie\CorrectiveAction;
use App\Models\Transaction\Rollie\PreventiveAction;

class FollowUpRkjController extends ResourceController
{
    public function prosesFollowUpRkj(Request $request)
    {
        $cekAkses   = $this->checkAksesTambah(\Request::getRequestUri(),'rollie.rkol.'.str_replace('-','_',$this->decrypt($request->params)));
        if ($cekAkses['success'])
        {
            $rkj                = Rkj::find($this->decrypt($request->rkj_id));
            $rkj->status_akhir  = '1';
            $rkj->save();
            $followUpRkj        = FollowUpRkj::create([
                'rkj_id'                => $rkj->id,
                'status_follow_up_rkj'  => '0'
            ]);
            return ['success'=>true,'follow_up_rkj_id'=>$this->encrypt($followUpRkj->id),'params'=>$request->params,'message'=>'Proses follow up berhasil, anda akan dialihkan secara otomatis oleh sistem menuju form follow up rkj'];
        } 
        else 
        {
            return $cekAkses;
        }   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateFollowUpRkj(Request $request)
    {
        // dd($request->all());
        $params     = $this->decrypt($request->params);
        if (strpos($params,'rkj-rnd-produk') !== false) 
        {
            if ($request->params_save == 'updatenya') 
            {
                $corrective_action          = $request->corrective_action;
                $corrective_action_id       = $request->corrective_action_id;
                $pic_corrective_action      = $request->pic_corrective_action;
                $due_date_corrective_action = $request->due_date_corrective_action;
                $status_corrective_action   = $request->status_corrective_action;
                $verifikasi_corrective_action   = $request->verifikasi_corrective_action;
                
                if (!is_null($corrective_action[0])) 
                {
                    for ($i=0; $i < count($corrective_action) ; $i++) 
                    { 
                        if (!is_null($corrective_action[$i])) 
                        {
                            $correctiveAction = CorrectiveAction::find($this->decrypt($corrective_action_id[$i]));
                            $correctiveAction->corrective_action                 = $corrective_action[$i];
                            $correctiveAction->due_date_corrective_action        = $due_date_corrective_action[$i];
                            $correctiveAction->pic_corrective_action             = $pic_corrective_action[$i];
                            $correctiveAction->status_corrective_action          = $status_corrective_action[$i];
                            $correctiveAction->verifikasi_corrective_action          = $verifikasi_corrective_action[$i];
                            $correctiveAction->save();
                        }
                    }

                }
                $distributionLists                      = DistributionList::where('rkj_'.end(explode('-',$params).'_mail_to'),'1')->get();
                $user_to                                = array();
                foreach ($distributionLists as $distributionList) 
                {
                    array_push($user_to, $distributionList->employee->email);
                }
                
                $distributionLists          = DistributionList::where('rkj_'.end(explode('-',$params).'_mail_cc'),'1')->get();
                $user_cc            = array();
                foreach ($distributionLists as $distributionList) 
                {
                    array_push($user_cc, $distributionList->employee->email);
                }
                Mail::to($user_to)->cc($user_cc)->bcc('nesta.maulana@nutrifood.co.id')->send(new FollowUpRkjMail($correctiveAction->followUpRkj,$params,'Update'));
                return redirect(route('rollie.rkol.'.str_replace('-','_',$params)))->with('success','Update follow up PPQ berhasil disimpan');
            

            }
            $corrective_action          = $request->corrective_action;
            $pic_corrective_action      = $request->pic_corrective_action;
            $due_date_corrective_action = $request->due_date_corrective_action;
            $status_corrective_action   = $request->status_corrective_action;
            $dugaan_penyebab                = $request->dugaan_penyebab;
            $hasil_analisa                  = $request->hasil_analisa;
            $status_produk                  = $request->status_produk;
            $tanggal_status_produk          = $request->tanggal_status_produk;
            $followUpRkj                            = FollowUpRkj::find($this->decrypt($request->follow_up_rkj_id));
            $followUpRkj->hasil_analisa             = $hasil_analisa;
            $followUpRkj->dugaan_penyebab           = $dugaan_penyebab;
            $followUpRkj->status_produk             = $status_produk;
            $followUpRkj->tanggal_status_produk     = $tanggal_status_produk;
            if (count($followUpRkj->correctiveActions) > 0) 
            {
                foreach ($followUpRkj->correctiveActions as $correctiveAction) 
                {
                    CorrectiveAction::destroy($correctiveAction->id);
                }
            }

            

            if (!is_null($corrective_action[0])) 
            {
                for ($i=0; $i < count($corrective_action) ; $i++) 
                { 
                    if (!is_null($corrective_action[$i])) 
                    {
                        CorrectiveAction::create([
                            'follow_up_rkj_id'                  => $followUpRkj->id,
                            'corrective_action'                 => $corrective_action[$i],
                            'due_date_corrective_action'        => $due_date_corrective_action[$i],
                            'pic_corrective_action'             => $pic_corrective_action[$i],
                            'status_corrective_action'          => $status_corrective_action[$i]
                        ]);
                    }
                }
            }
            
            if ($request->params_save == 'draft') 
            {
                $status_follow_up_rkj     = '0'; /* ini masih on progress */
                $followUpRkj->status_follow_up_rkj      = $status_follow_up_rkj;
                $followUpRkj->save();
                return redirect(route('rollie.rkol.'.str_replace('-','_',$params)))->with('success','Draft hasil follow up PPQ berhasil disimpan');
            }
            else if($request->params_save == 'savenya')
            {
                $status_follow_up_rkj                   = '1';
                $followUpRkj->status_follow_up_rkj      = $status_follow_up_rkj;
                $followUpRkj->save();
                $followUpRkj->rkj->status_akhir         = '2';
                $followUpRkj->rkj->save();
                $pecah                                  = explode('-',$params);
                $followUpRkj                            = FollowUpRkj::find($followUpRkj->id);

                $distributionLists  = DistributionList::where('rkj_'.end($pecah).'_mail_to','1')->get();
                $user_to            = array();
                
                foreach ($distributionLists as $distributionList) 
                {
                    array_push($user_to, $distributionList->employee->email);
                }
                
                $distributionLists          = DistributionList::where('rkj_'.end($pecah).'_mail_cc','1')->get();
                $user_cc            = array();
                foreach ($distributionLists as $distributionList) 
                {
                    array_push($user_cc, $distributionList->employee->email);
                }

                Mail::to($user_to)->cc($user_cc)->bcc('nesta.maulana@nutrifood.co.id')->send(new FollowUpRkjMail($followUpRkj,$params));

                return ['success'=>true,'message'=>'Follow Up RKJ berhasil diinput dan email notifikasi berhasil terkirim','params'=>$params];
            }
            
        } 
        else 
        {
            if ($request->params_save == 'updatenya') 
            {   
                $status_case                = $request->status_case;
                if ($status_case == '10') 
                {
                    $status_case = NULL;
                }
                $followUpRkj                            = FollowUpRkj::find($this->decrypt($request->follow_up_rkj_id));
                $followUpRkj->status_case               = $status_case;
                $followUpRkj->save();
                $preventive_action          = $request->preventive_action;
                $preventive_action_id       = $request->preventive_action_id;
                $pic_preventive_action      = $request->pic_preventive_action;
                $due_date_preventive_action = $request->due_date_preventive_action;
                $status_preventive_action   = $request->status_preventive_action;
                $verifikasi_preventive_action   = $request->verifikasi_preventive_action;
                
                $preventive_action          = $request->preventive_action;
                $preventive_action_id       = $request->preventive_action_id;
                $pic_preventive_action      = $request->pic_preventive_action;
                $due_date_preventive_action = $request->due_date_preventive_action;
                $status_preventive_action   = $request->status_preventive_action;
                $verifikasi_preventive_action   = $request->verifikasi_preventive_action;
                

                if (!is_null($preventive_action[0])) 
                {
                    for ($i=0; $i < count($preventive_action) ; $i++) 
                    { 
                        if (!is_null($preventive_action[$i])) 
                        {
                            $preventiveAction = PreventiveAction::find($this->decrypt($preventive_action_id[$i]));
                            $preventiveAction->preventive_action                 = $preventive_action[$i];
                            $preventiveAction->due_date_preventive_action        = $due_date_preventive_action[$i];
                            $preventiveAction->pic_preventive_action             = $pic_preventive_action[$i];
                            $preventiveAction->status_preventive_action          = $status_preventive_action[$i];
                            $preventiveAction->verifikasi_preventive_action          = $verifikasi_preventive_action[$i];
                            $preventiveAction->save();
                        }
                    }

                }
                $params_url         = explode('-',$params);
                if (end($params_url) == 'qa') 
                {
                    $params_url     = strtolower($followUpRkj->rkj->ppq->palets[0]->palet->cppDetail->woNumber->product->subbrand->brand->brand_name);
                }
                else
                { 
                    $params_url     = end($params_url);
                }
                $distributionLists                      = DistributionList::where('rkj_'.$params_url.'_mail_to','1')->get();
                $user_to                                = array();
                foreach ($distributionLists as $distributionList) 
                {
                    array_push($user_to, $distributionList->employee->email);
                }
                $distributionLists          = DistributionList::where('rkj_'.$params_url.'_mail_cc','1')->get();
                $user_cc            = array();
                foreach ($distributionLists as $distributionList) 
                {
                    array_push($user_cc, $distributionList->employee->email);
                }
                Mail::to($user_to)->cc($user_cc)->bcc('nesta.maulana@nutrifood.co.id')->send(new FollowUpRkjMail($preventiveAction->followUpRkj,$params,'Update'));
                return redirect(route('rollie.rkol.'.str_replace('-','_',$params)))->with('success','Update follow up PPQ berhasil disimpan');
            

            }
            $preventive_action                      = $request->preventive_action;
            $pic_preventive_action                  = $request->pic_preventive_action;
            $due_date_preventive_action             = $request->due_date_preventive_action;
            $status_preventive_action               = $request->status_preventive_action;
            $dugaan_penyebab                        = $request->dugaan_penyebab;
            $nomor_rkp                              = $request->nomor_rkp;
            $hasil_investigasi                      = $request->hasil_investigasi;
            $tanggal_loi                            = $request->tanggal_loi;
            $status_case                            = $request->status_case;
            $followUpRkj                            = FollowUpRkj::find($this->decrypt($request->follow_up_rkj_id));
            $followUpRkj->nomor_rkp                 = $nomor_rkp;
            $followUpRkj->hasil_investigasi         = $hasil_investigasi;
            $followUpRkj->tanggal_loi               = $tanggal_loi;
            $followUpRkj->status_case               = $status_case;
            if (count($followUpRkj->preventiveActions) > 0) 
            {
                foreach ($followUpRkj->preventiveActions as $preventiveAction) 
                {
                    PreventiveAction::destroy($preventiveAction->id);
                }
            }
            if (!is_null($preventive_action[0])) 
            {
                for ($i=0; $i < count($preventive_action) ; $i++) 
                { 
                    if (!is_null($preventive_action[$i])) 
                    {
                        PreventiveAction::create([
                            'follow_up_rkj_id'                  => $followUpRkj->id,
                            'preventive_action'                 => $preventive_action[$i],
                            'due_date_preventive_action'        => $due_date_preventive_action[$i],
                            'pic_preventive_action'             => $pic_preventive_action[$i],
                            'status_preventive_action'          => $status_preventive_action[$i]
                        ]);
                    }
                }
            }
            if ($request->params_save == 'draft') 
            {
                $status_follow_up_qa                    = '0'; /* ini masih on progress */
                $followUpRkj->status_follow_up_qa       = $status_follow_up_qa;
                $followUpRkj->save();
                return redirect(route('rollie.rkol.'.str_replace('-','_',$params)))->with('success','Draft hasil follow up PPQ berhasil disimpan');
            }
            else if($request->params_save == 'savenya')
            {
                $status_follow_up_qa                   = '1';
                $followUpRkj->status_follow_up_qa      = $status_follow_up_qa;
                $followUpRkj->save();
                $followUpRkj->rkj->status_akhir         = '2';
                $followUpRkj->rkj->save();
                $followUpRkj                            = FollowUpRkj::find($followUpRkj->id);
                $pecah                                  = explode('-',$params);
                if (end($pecah) == 'qa') 
                {
                    $distributionLists  = DistributionList::where('rkj_'.strtolower($followUpRkj->rkj->ppq->palets[0]->palet->cppDetail->woNumber->product->subbrand->brand->brand_name).'_mail_to','1')->get();
                    $user_to            = array();
                    
                    foreach ($distributionLists as $distributionList) 
                    {
                        array_push($user_to, $distributionList->employee->email);
                    }
                    
                    $distributionLists          = DistributionList::where('rkj_'.strtolower($followUpRkj->rkj->ppq->palets[0]->palet->cppDetail->woNumber->product->subbrand->brand->brand_name).'_mail_cc','1')->get();
                    $user_cc            = array();
                    foreach ($distributionLists as $distributionList) 
                    {
                        array_push($user_cc, $distributionList->employee->email);
                    }
                } 
                else 
                {
                    $distributionLists  = DistributionList::where('rkj_'.strtolower($followUpRkj->rkj->ppq->palets[0]->palet->cppDetail->woNumber->product->subbrand->brand->brand_name).'_mail_to','1')->get();
                    $user_to            = array();
                    
                    foreach ($distributionLists as $distributionList) 
                    {
                        array_push($user_to, $distributionList->employee->email);
                    }
                    
                    $distributionLists          = DistributionList::where('rkj_'.end($pecah).'_mail_cc','1')->get();
                    $user_cc            = array();
                    foreach ($distributionLists as $distributionList) 
                    {
                        array_push($user_cc, $distributionList->employee->email);
                    }
                }
                

                Mail::to($user_to)->cc($user_cc)->bcc('nesta.maulana@nutrifood.co.id')->send(new FollowUpRkjMail($followUpRkj,$params));

                return ['success'=>true,'message'=>'Follow Up RKJ berhasil diinput dan email notifikasi berhasil terkirim','params'=>$params];
            }
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
     * @param  \App\Models\Transaction\Rollie\FollowUpRkj  $followUpRkj
     * @return \Illuminate\Http\Response
     */
    public function show(FollowUpRkj $followUpRkj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction\Rollie\FollowUpRkj  $followUpRkj
     * @return \Illuminate\Http\Response
     */
    public function edit(FollowUpRkj $followUpRkj)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction\Rollie\FollowUpRkj  $followUpRkj
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FollowUpRkj $followUpRkj)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction\Rollie\FollowUpRkj  $followUpRkj
     * @return \Illuminate\Http\Response
     */
    public function destroy(FollowUpRkj $followUpRkj)
    {
        //
    }
}
