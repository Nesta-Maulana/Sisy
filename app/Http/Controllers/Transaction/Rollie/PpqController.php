<?php

namespace App\Http\Controllers\Transaction\Rollie;

use App\Http\Controllers\ResourceController;
use App\Models\Transaction\Rollie\Ppq;
use Illuminate\Http\Request;

use App\Models\Master\Menu;
use App\Models\Master\MenuPermission;
use App\Models\Master\Application;
use App\Models\Master\ApplicationPermission;
use App\Models\Master\User;
use App\Models\Master\DistributionList;
use App\Models\Master\Icon;

use App\Models\Master\Product;

Use App\Models\Transaction\Rollie\WoNumber;
Use App\Models\Transaction\Rollie\RpdFillingHead;
Use App\Models\Transaction\Rollie\RpdFillingDetailPi;
Use App\Models\Transaction\Rollie\RpdFillinDetailAtEvent;

use App\Models\Transaction\Rollie\CppHead;
use App\Models\Transaction\Rollie\CppDetail;
use App\Models\Transaction\Rollie\Palet;
use App\Models\Transaction\Rollie\PaletPpq;

use Illuminate\Support\Facades\Mail;
use App\Mail\Rollie\Ppq\NewPpqMail;
use DB;

use Auth;
use Session;

class PpqController extends ResourceController
{
    public function createPpq(Request $request)
    {
        $nomor_ppq          = $request->nomor_ppq;
        $tanggal_ppq        = $request->tanggal_ppq;
        $jam_awal_ppq       = $request->jam_filling_mulai;
        $jam_akhir_ppq      = $request->jam_filling_akhir;
        $jumlah_pack        = $request->jumlah_pack;
        $alasan             = $request->alasan_ppq;
        $detail_titik_ppq   = $request->detail_titik_ppq;
        $jenis_ppq          = $request->jenis_ppq;
        $jenis_ppq_keterangan          = $request->jenis_ppq_keterangan;
        $kategori_ppq       = $request->kategori_ppq_value;
        $nomor_lot_id       = $request->nomor_lot_id;
        $lot_number_id      = explode(',',$nomor_lot_id);
        switch ($jenis_ppq_keterangan) 
        {

            /* package integrity*/
            case 'Package Integrity':
                if ($nomor_lot_id == '0' || $jumlah_pack == '0') 
                {
                    $status_akhir       = '5'; /* dia akan set bahwa ppq ini berstatus sebagai DRAFT PPQ */
                }
                else
                {
                    $status_akhir       = '0'; /* dia akan di set bahwa ppq ini berstatus sebaagai new ppq dan akan langsung input ke palet ppq nantinya juga kirim email */
                }
                $ppq                    = Ppq::create([
                    'rpd_filling_detail_pi_id'=> $this->decrypt($request->rpd_filling_detail_pi_id),
                    'nomor_ppq'         => $nomor_ppq,
                    'ppq_date'          => $tanggal_ppq,
                    'jam_awal_ppq'      => $jam_awal_ppq,
                    'jam_akhir_ppq'     => $jam_akhir_ppq,
                    'jumlah_pack'       => $jumlah_pack,
                    'alasan'            => $alasan,
                    'detail_titik_ppq'  => $detail_titik_ppq,
                    'kategori_ppq_id'   => $kategori_ppq,
                    'status_akhir'      => $status_akhir
                ]);

                if ($status_akhir == '5') 
                {
                    $message = 'Draft PPQ Berhasil dibuat, harap segera lengkapi administrasi PPQ pada menu Draft PPQ';
                }
                else if($status_akhir == '0')
                {
                    foreach ($lot_number_id as $lot_number) 
                    {
                        if ($lot_number !== '') 
                        {
                            PaletPpq::create([
                                'ppq_id'    => $ppq->id,
                                'palet_id'  => $this->decrypt($lot_number),
                            ]);
                        }
                    }
                    $ppq->jumlah_pack   = $jumlah_pack;
                    $ppq->save();
                    $distributionLists          = DistributionList::where('ppq_mail_to','1')->get();
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

                    Mail::to($user_to)->cc($user_cc)->bcc('nesta.maulana@nutrifood.co.id')->send(new NewPpqMail($ppq));
                    $message = 'PPQ ketidaksesuaian produk berhasil dibuat dan notifikasi email berhasil dikirim';
                }
                return redirect('rollie/rpd-filling/form/'.$this->encrypt($ppq->rpdFillingDetailPi->rpdFillingHead->id))->with('success',$message);
            break;
            /**/
            case 'Kimia':
                if ($nomor_lot_id == '0' || $jumlah_pack == '0') 
                {
                    $status_akhir = '5';
                }
                else
                {
                    $status_akhir = '0';
                }
                $ppq                    = Ppq::create([
                    'cpp_head_id'       => $this->decrypt($request->cpp_head_id),
                    'nomor_ppq'         => $nomor_ppq,
                    'ppq_date'          => $tanggal_ppq,
                    'jam_awal_ppq'      => $jam_awal_ppq,
                    'jam_akhir_ppq'     => $jam_akhir_ppq,
                    'jumlah_pack'       => $jumlah_pack,
                    'alasan'            => $alasan,
                    'detail_titik_ppq'  => $detail_titik_ppq,
                    'kategori_ppq_id'   => $kategori_ppq,
                    'status_akhir'      => $status_akhir
                ]);
                foreach ($lot_number_id as $lot_number) 
                {
                    if ($lot_number !== "") 
                    {
                        PaletPpq::create([
                            'ppq_id'    => $ppq->id,
                            'palet_id'  => $this->decrypt($lot_number),
                        ]);
                    }
                }
                $ppq->jumlah_pack   = $jumlah_pack;
                $ppq->save();
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

                Mail::to($user_to)->cc($user_cc)->bcc('nesta.maulana@nutrifood.co.id')->send(new NewPpqMail($ppq));
                $message = 'PPQ ketidaksesuaian produk berhasil dibuat dan notifikasi email berhasil dikirim';  
                return redirect(route('rollie.analysis_data.'.$this->decrypt($request->params)))->with('success','Data PPQ ketidaksesuaian fisikokimia berhasil diinput dan email notifikasi berhasil dikirim');
            break;
        }
    }
    public function prosesPPQ(Request $request)
    {
        $cekAkses       = $this->checkAksesUbah(\Request::getRequestUri(),'rollie.process_data.rpds');
        if ($cekAkses == true) 
        {
            $ppq                        = Ppq::find($this->decrypt($request->ppq_id));
            $ppq->jumlah_pack           = $request->jumlah_pack;
            $ppq->alasan                = $request->alasan_ppq;
            $ppq->detail_titik_ppq      = $request->detail_titik_ppq;
            $ppq->kategori_ppq          = $request->kategori_ppq;
            $ppq->status_akhir          = '0';
            $ppq->save();

            $distributionLists          = DistributionList::where('ppq_mail_to','1')->get();
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

            Mail::to($user_to)->cc($user_cc)->bcc('nesta.maulana@nutrifood.co.id')->send(new NewPpqMail($ppq));
            return['success' => true, 'message' => 'PPQ Berhasil Diinput dan Email PPQ sudah terkirim kepada pihak terkait'];
            
        } else {
            return $cekAkses;
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
     * @param  \App\Models\Transaction\Rollie\Ppq  $ppq
     * @return \Illuminate\Http\Response
     */
    public function show(Ppq $ppq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction\Rollie\Ppq  $ppq
     * @return \Illuminate\Http\Response
     */
    public function edit(Ppq $ppq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction\Rollie\Ppq  $ppq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ppq $ppq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction\Rollie\Ppq  $ppq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ppq $ppq)
    {
        //
    }
}
