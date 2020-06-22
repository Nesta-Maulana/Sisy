<?php

namespace App\Http\Controllers\Transaction\Rollie;

use Illuminate\Http\Request;
use App\Http\Controllers\ResourceController;

use App\Models\Master\User;
use App\Models\Master\DistributionList;

use App\Models\Transaction\Rollie\Ppq;
use App\Models\Transaction\Rollie\Palet;
use App\Models\Transaction\Rollie\PaletPpq;


use App\Models\Transaction\Rollie\FollowUpPpq;

use App\Models\Transaction\Rollie\CorrectiveAction;
use App\Models\Transaction\Rollie\preventiveAction;

use Illuminate\Support\Facades\Mail;
use App\Mail\Rollie\Ppq\FollowUpPpqMail;


class FollowUpPpqController extends ResourceController
{
    public function prosesFollowUpPpq(Request $request)
    {
        if (is_null($request->params_induk) || $this->decrypt($request->params_induk) =='null') 
        {
            $cekAkses       = $this->checkAksesTambah(\Request::getRequestUri(),'rollie.rkol.'.str_replace('-','_',$this->decrypt($request->params)));
            $params_induk   = $this->encrypt('null');
        } 
        else 
        {
            /* ini jika route induk seperti qc tahanan*/
            $cekAkses   = $this->checkAksesTambah(\Request::getRequestUri(),'rollie.rkol.'.str_replace('-','_',$this->decrypt($request->params_induk)));
        }
        if ($cekAkses['success'])
        {
            $ppq                = Ppq::find($this->decrypt($request->ppq_id));
            $ppq->status_akhir  = '1';
            $ppq->save();
            $followUpPpq        = FollowUpPpq::create([
                'ppq_id'                => $ppq->id,
                'status_follow_up_ppq'  => '0'
            ]);
            return ['success'=>true,'follow_up_ppq_id'=>$this->encrypt($followUpPpq->id),'params'=>$request->params,'params_induk'=>$params_induk,'message'=>'Proses follow up berhasil, anda akan dialihkan secara otomatis oleh sistem menuju form follow up ppq'];
        } 
        else 
        {
            return $cekAkses;
        }
    }
 
    public function updateFollowUpPpq(Request $request)
    {
        $jenis_ppq  = $request->jenis_ppq;
        $params     = $this->decrypt($request->params);
        if ($request->params_induk == 'null' || is_null($params_induk)) 
        {
            $cekAkses       = $this->checkAksesUbah(\Request::getRequestUri(),'rollie.rkol.'.str_replace('-','_',$params));
            $params_induk   = $this->encrypt('null');
        } 
        else 
        {
            /* ini jika route induk seperti qc tahanan*/
            $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'rollie.rkol.'.str_replace('-','_',$request->params_induk));
        }
        if ($cekAkses['success']) 
        {
            switch ($params) 
            {
                case 'ppq-qc-release':
                    switch ($jenis_ppq) 
                    {
                        case 'Package Integrity':
                            $jumlah_metode_sampling     = $request->jumlah_metode_sampling;
                            $hasil_analisa              = $request->hasil_analisa;
                            $nomor_lbd                  = $request->nomor_lbd;
                            $status_produk                 = $request->status_produk;
                            $tanggal_status_ppq         = $request->tanggal_status_ppq;
                            
                            $followUpPpq                            = FollowUpPpq::find($this->decrypt($request->follow_up_ppq_id));
                            $followUpPpq->jumlah_metode_sampling    = $jumlah_metode_sampling;
                            $followUpPpq->hasil_analisa             = $hasil_analisa;
                            $followUpPpq->nomor_lbd                 = $nomor_lbd;
                            $followUpPpq->status_produk                = $status_produk;
                            $followUpPpq->tanggal_status_ppq        = $tanggal_status_ppq;
                            if ($request->params_save == 'draft') 
                            {
                                $status_follow_up_ppq     = '0'; /* ini masih on progress */
                                $followUpPpq->status_follow_up_ppq      = $status_follow_up_ppq;
                                $followUpPpq->save();
                                return redirect(route('rollie.rkol.'.str_replace('-','_',$params)))->with('success','Draft hasil follow up PPQ berhasil disimpan');
                            }
                            else if($request->params_save == 'savenya')
                            {
                                $status_follow_up_ppq                   = '1'; /*ini diinput oleh sistem langsung karena tidak mungkin ada edit data*/
                                $followUpPpq->status_follow_up_ppq      = $status_follow_up_ppq;
                                $followUpPpq->save();
                                $followUpPpq->ppq->status_akhir         = '2';
                                $followUpPpq->ppq->save();

                                $distributionLists  = DistributionList::where('ppq_mail_to','1')->get();
                                $user_to            = array();
                                
                                foreach ($distributionLists as $distributionList) 
                                {
                                    array_push($user_to, $distributionList->employee->email);
                                }
                                
                                $distributionLists          = DistributionList::where('ppq_mail_cc','1')->get();
                                $user_cc            = array();
                                foreach ($distributionLists as $distributionList) 
                                {
                                    array_push($user_cc, $distributionList->employee->email);
                                }

                                Mail::to($user_to)->cc($user_cc)->bcc('nesta.maulana@nutrifood.co.id')->send(new FollowUpPpqMail($followUpPpq,$params));

                                if ($request->params_induk == 'null') 
                                {
                                    return ['success'=>true,'message'=>'Follow Up PPQ berhasil diinput dan email notifikasi berhasil terkirim','params'=>$params];
                                }
                                else
                                {
                                    return ['success'=>true,'message'=>'Follow Up PPQ berhasil diinput dan email notifikasi berhasil terkirim','params'=>$request->params_induk];
                                }
                            }
                            
                            
                        break;                    
                    }
                break;

                case 'ppq-qc-tahanan':
                    switch ($jenis_ppq) 
                    {                   
                        case 'Kimia':
                            if ($request->params_save == 'updatenya') 
                            {
                                
                                $corrective_action          = $request->corrective_action;
                                $corrective_action_id       = $request->corrective_action_id;
                                $pic_corrective_action      = $request->pic_corrective_action;
                                $due_date_corrective_action = $request->due_date_corrective_action;
                                $status_corrective_action   = $request->status_corrective_action;
                                $verifikasi_corrective_action   = $request->verifikasi_corrective_action;
                                
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
                                            $preventiveAction                                       = PreventiveAction::find($this->decrypt($preventive_action_id[$i]));
                                            $preventiveAction->preventive_action                    = $preventive_action[$i];
                                            $preventiveAction->due_date_preventive_action           = $due_date_preventive_action[$i];
                                            $preventiveAction->pic_preventive_action                = $pic_preventive_action[$i];
                                            $preventiveAction->status_preventive_action             = $status_preventive_action[$i];
                                            $preventiveAction->verifikasi_preventive_action         = $verifikasi_preventive_action[$i];
                                            $preventiveAction->save();
                                        }
                                    }
                                }

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
                                $distributionLists                      = DistributionList::where('ppq_mail_to','1')->get();
                                $user_to                                = array();
                                foreach ($distributionLists as $distributionList) 
                                {
                                    array_push($user_to, $distributionList->employee->email);
                                }
                                
                                $distributionLists          = DistributionList::where('ppq_mail_cc','1')->get();
                                $user_cc            = array();
                                foreach ($distributionLists as $distributionList) 
                                {
                                    array_push($user_cc, $distributionList->employee->email);
                                }
                                Mail::to($user_to)->cc($user_cc)->bcc('nesta.maulana@nutrifood.co.id')->send(new FollowUpPpqMail($correctiveAction->followUpPpq,$params,'Update'));
                                return redirect(route('rollie.rkol.'.str_replace('-','_',$params)))->with('success','Update follow up PPQ berhasil disimpan');
                            

                            }
                            $hasil_analisa              = $request->hasil_analisa;
                            $nomor_lbd                  = $request->nomor_lbd;
                            $status_produk              = $request->status_produk;
                            $tanggal_status_ppq         = $request->tanggal_status_ppq;

                            $corrective_action          = $request->corrective_action;
                            $pic_corrective_action      = $request->pic_corrective_action;
                            $due_date_corrective_action = $request->due_date_corrective_action;
                            $status_corrective_action   = $request->status_corrective_action;
                            
                            $preventive_action          = $request->preventive_action;
                            $pic_preventive_action      = $request->pic_preventive_action;
                            $due_date_preventive_action = $request->due_date_preventive_action;
                            $status_preventive_action   = $request->status_preventive_action;
                            
                            $followUpPpq                            = FollowUpPpq::find($this->decrypt($request->follow_up_ppq_id));
                            $followUpPpq->hasil_analisa             = $hasil_analisa;
                            $followUpPpq->nomor_lbd                 = $nomor_lbd;
                            $followUpPpq->status_produk             = $status_produk;
                            $followUpPpq->tanggal_status_ppq        = $tanggal_status_ppq;
                            // dd($request->all);
                            if (count($followUpPpq->correctiveActions) > 0) 
                            {
                                foreach ($followUpPpq->correctiveActions as $correctiveAction) 
                                {
                                    CorrectiveAction::destroy($correctiveAction->id);
                                }
                            }

                            if (count($followUpPpq->preventiveActions) > 0) 
                            {
                                foreach ($followUpPpq->preventiveActions as $preventiveAction) 
                                {
                                    PreventiveAction::destroy($preventiveAction->id);
                                }
                            }
                            $params_status_corrective                           = 0;
                            if (!is_null($corrective_action[0])) 
                            {
                                for ($i=0; $i < count($corrective_action) ; $i++) 
                                { 
                                    if (!is_null($corrective_action[$i])) 
                                    {
                                        CorrectiveAction::create([
                                            'follow_up_ppq_id'                  => $followUpPpq->id,
                                            'corrective_action'                 => $corrective_action[$i],
                                            'due_date_corrective_action'        => $due_date_corrective_action[$i],
                                            'pic_corrective_action'             => $pic_corrective_action[$i],
                                            'status_corrective_action'          => $status_corrective_action[$i]
                                        ]);
                                        if ($status_corrective_action[$i] == '0') 
                                        {
                                            $params_status_corrective++;
                                        }
                                    }
                                }
                            }

                            if (!is_null($preventive_action[0])) 
                            {
                                for ($i=0; $i < count($preventive_action) ; $i++) 
                                { 
                                    if (!is_null($preventive_action[$i])) 
                                    {
                                        PreventiveAction::create([
                                            'follow_up_ppq_id'                  => $followUpPpq->id,
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
                                $status_follow_up_ppq                   = '0'; /* ini masih on progress */
                                $followUpPpq->status_follow_up_ppq      = $status_follow_up_ppq;
                                $followUpPpq->save();
                                return redirect(route('rollie.rkol.'.str_replace('-','_',$params)))->with('success','Draft hasil follow up PPQ berhasil disimpan');
                            }
                            else if($request->params_save == 'savenya')
                            {
                                $status_follow_up_ppq                   = '1'; /* ini masih on progress */
                                $followUpPpq->status_follow_up_ppq      = $status_follow_up_ppq;
                                $followUpPpq->save();
                                $followUpPpq->ppq->status_akhir         = '2';
                                $followUpPpq->ppq->save();
                                $followUpPpq                            = FollowUpPpq::find($this->decrypt($request->follow_up_ppq_id));
                                $distributionLists                      = DistributionList::where('ppq_mail_to','1')->get();
                                $user_to                                = array();
                                
                                foreach ($distributionLists as $distributionList) 
                                {
                                    array_push($user_to, $distributionList->employee->email);
                                }
                                
                                $distributionLists          = DistributionList::where('ppq_mail_cc','1')->get();
                                $user_cc            = array();
                                foreach ($distributionLists as $distributionList) 
                                {
                                    array_push($user_cc, $distributionList->employee->email);
                                }

                                Mail::to($user_to)->cc($user_cc)->bcc('nesta.maulana@nutrifood.co.id')->send(new FollowUpPpqMail($followUpPpq,$params));
                                return ['success'=>true,'message'=>'Follow Up PPQ berhasil diinput dan email notifikasi berhasil terkirim','params'=>$params];

                            }
                        break;
                    }
                break;
                case 'ppq-engineering':
                    if ($request->params_save == 'updatenya') 
                    {
                        $corrective_action          = $request->corrective_action;
                        $corrective_action_id       = $request->corrective_action_id;
                        $pic_corrective_action      = $request->pic_corrective_action;
                        $due_date_corrective_action = $request->due_date_corrective_action;
                        $status_corrective_action   = $request->status_corrective_action;
                        $verifikasi_corrective_action   = $request->verifikasi_corrective_action;
                        
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
                                    $preventiveAction                                       = PreventiveAction::find($this->decrypt($preventive_action_id[$i]));
                                    $preventiveAction->preventive_action                    = $preventive_action[$i];
                                    $preventiveAction->due_date_preventive_action           = $due_date_preventive_action[$i];
                                    $preventiveAction->pic_preventive_action                = $pic_preventive_action[$i];
                                    $preventiveAction->status_preventive_action             = $status_preventive_action[$i];
                                    $preventiveAction->verifikasi_preventive_action         = $verifikasi_preventive_action[$i];
                                    $preventiveAction->save();
                                }
                            }
                        }

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
                        $distributionLists                      = DistributionList::where('ppq_mail_to','1')->get();
                        $user_to                                = array();
                        foreach ($distributionLists as $distributionList) 
                        {
                            array_push($user_to, $distributionList->employee->email);
                        }
                        
                        $distributionLists          = DistributionList::where('ppq_mail_cc','1')->get();
                        $user_cc            = array();
                        foreach ($distributionLists as $distributionList) 
                        {
                            array_push($user_cc, $distributionList->employee->email);
                        }
                        Mail::to($user_to)->cc($user_cc)->bcc('nesta.maulana@nutrifood.co.id')->send(new FollowUpPpqMail($correctiveAction->followUpPpq,$params,'Update'));
                        return redirect(route('rollie.rkol.'.str_replace('-','_',$params)))->with('success','Update follow up PPQ berhasil disimpan');
                    

                    }
                    $root_cause                 = $request->root_cause;
                    $kategori_case              = $request->kategori_case;
                    $status_case                = $request->status_case;
                    if ($status_case == '10') 
                    {
                        $status_case = NULL;
                    }
                    $corrective_action          = $request->corrective_action;
                    $pic_corrective_action      = $request->pic_corrective_action;
                    $due_date_corrective_action = $request->due_date_corrective_action;
                    $status_corrective_action   = $request->status_corrective_action;
                    
                    $preventive_action          = $request->preventive_action;
                    $pic_preventive_action      = $request->pic_preventive_action;
                    $due_date_preventive_action = $request->due_date_preventive_action;
                    $status_preventive_action   = $request->status_preventive_action;
                    
                    $followUpPpq                            = FollowUpPpq::find($this->decrypt($request->follow_up_ppq_id));
                    $followUpPpq->root_cause                = $root_cause;
                    $followUpPpq->kategori_case             = $kategori_case;
                    $followUpPpq->status_case               = $status_case;
                    $followUpPpq->save();

                    // dd($request->all);
                    if (count($followUpPpq->correctiveActions) > 0) 
                    {
                        foreach ($followUpPpq->correctiveActions as $correctiveAction) 
                        {
                            CorrectiveAction::destroy($correctiveAction->id);
                        }
                    }

                    if (count($followUpPpq->preventiveActions) > 0) 
                    {
                        foreach ($followUpPpq->preventiveActions as $preventiveAction) 
                        {
                            PreventiveAction::destroy($preventiveAction->id);
                        }
                    }

                    if (!is_null($corrective_action[0])) 
                    {
                        for ($i=0; $i < count($corrective_action) ; $i++) 
                        { 
                            if (!is_null($corrective_action[$i])) 
                            {
                                if ($status_corrective_action[$i] == '10') 
                                {
                                    $status_corrective_action[$i] = NULL;
                                }
                                CorrectiveAction::create([
                                    'follow_up_ppq_id'                  => $followUpPpq->id,
                                    'corrective_action'                 => $corrective_action[$i],
                                    'due_date_corrective_action'        => $due_date_corrective_action[$i],
                                    'pic_corrective_action'             => $pic_corrective_action[$i],
                                    'status_corrective_action'          => $status_corrective_action[$i]
                                ]);
                            }
                        }
                    }

                    if (!is_null($preventive_action[0])) 
                    {
                        for ($i=0; $i < count($preventive_action) ; $i++) 
                        { 
                            if (!is_null($preventive_action[$i])) 
                            {
                                PreventiveAction::create([
                                    'follow_up_ppq_id'                  => $followUpPpq->id,
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
                        return redirect(route('rollie.rkol.'.str_replace('-','_',$params)))->with('success','Draft hasil follow up PPQ berhasil disimpan');
                    }
                    else if($request->params_save == 'savenya')
                    {
                        $followUpPpq                            = FollowUpPpq::find($this->decrypt($request->follow_up_ppq_id));
                        $distributionLists  = DistributionList::where('ppq_mail_to','1')->get();
                        $user_to            = array();
                        
                        foreach ($distributionLists as $distributionList) 
                        {
                            array_push($user_to, $distributionList->employee->email);
                        }
                        
                        $distributionLists          = DistributionList::where('ppq_mail_cc','1')->get();
                        $user_cc            = array();
                        foreach ($distributionLists as $distributionList) 
                        {
                            array_push($user_cc, $distributionList->employee->email);
                        }

                        Mail::to($user_to)->cc($user_cc)->bcc('nesta.maulana@nutrifood.co.id')->send(new FollowUpPpqMail($followUpPpq,$params));
                        return ['success'=>true,'message'=>'Follow Up PPQ berhasil diinput dan email notifikasi berhasil terkirim','params'=>$params];

                    }
                break;
            }
        } 
        else 
        {
            if ($request->params_save == 'draft') 
            {
                return redirect()->back()->with('error',$cekAkses['message']);
            } 
            else 
            {
                if ($params_induk !== 'null') 
                {
                    $cekAkses['params_induk'] = $params_induk;
                }
                return $cekAkses;
            }
        }        
    }

    public function prosesFollowUpPpqQcRelease($ppq_id)
    {
        $cekAkses       = $this->checkAksesLihat(\Request::getRequestUri(),'rollie.rkol.ppq_qc_release');
        if ($cekAkses['success']) 
        {
            $ppq            = Ppq::find($this->decrypt($ppq_id));
            $params_induk   = $this->encrypt('null');
            $params         = $this->encrypt('ppq-qc-release');
            
            if (is_null($ppq->followUpPpq)) 
            {
                $ppq->status_akhir  = '1';
                $ppq->save();
                $followUpPpq        = FollowUpPpq::create([
                    'ppq_id'                => $ppq->id,
                    'status_follow_up_ppq'  => '0'
                ]);
                return redirect('/rollie/form-follow-up-ppq/'.$this->encrypt($followUpPpq->id).'/'.$params.'/'.$params_induk)->with('success','Proses follow up berhasil dilakukan, harap isi form follow up dengan data yang sesuai dengan data dilapangan');
            }
            else
            {
                if ($ppq->followUpPpq->status_follow_up_ppq == '0') 
                {
                    return redirect('/rollie/form-follow-up-ppq/'.$this->encrypt($ppq->followUpPpq->id).'/'.$params.'/'.$params_induk)->with('success','Proses follow up berhasil dilakukan, harap isi form follow up dengan data yang sesuai dengan data dilapangan');
                } 
                else 
                {
                    switch ($ppq->followUpPpq->status_produk) 
                    {
                        case '0':
                            $status_produk = 'Reject';
                        break;

                        case '1':
                            $status_produk = 'Release';
                        break;

                        case '2':
                            $status_produk = 'Release Partial';
                        break;
                    }
                    return redirect(route('rollie.rkol.ppq_qc_release'))->with('error','PPQ dengan nomor '.$ppq->nomor_ppq.' telah berhasil difollow up oleh '.$ppq->followUpPpq->updatedBy->employee->fullname.' dengan status produk '.$status_produk);
                }
                
            }
        }
        else
        {
            $cekAkses       = $this->checkAksesLihat(\Request::getRequestUri(),'rollie.rkol.ppq_qc_tahanan');
            if ($cekAkses['success']) 
            {
                
            } 
            else 
            {
                return redirect(route('rollie.show_home'))->with('error',$cekAkses['message']);
            }
            
        }
        dd($cekAkses);
        dd($ppq_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction\Rollie\FollowUpPpq  $followUpPpq
     * @return \Illuminate\Http\Response
     */
    public function show(FollowUpPpq $followUpPpq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction\Rollie\FollowUpPpq  $followUpPpq
     * @return \Illuminate\Http\Response
     */
    public function edit(FollowUpPpq $followUpPpq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction\Rollie\FollowUpPpq  $followUpPpq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FollowUpPpq $followUpPpq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction\Rollie\FollowUpPpq  $followUpPpq
     * @return \Illuminate\Http\Response
     */
    public function destroy(FollowUpPpq $followUpPpq)
    {
        //
    }
}
