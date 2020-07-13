<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ResourceController;
use App\Models\Master\Menu;
use App\Models\Master\MenuPermission;
use App\Models\Master\Application;
use App\Models\Master\ApplicationPermission;
use App\Models\Master\User;
use App\Models\Master\Icon;

use App\Models\Master\JenisPpq;
use App\Models\Master\KategoriPpq;

use App\Models\Master\Product;

Use App\Models\Transaction\Rollie\WoNumber;
Use App\Models\Transaction\Rollie\RpdFillingHead;
Use App\Models\Transaction\Rollie\RpdFillingDetailPi;
Use App\Models\Transaction\Rollie\RpdFillinDetailAtEvent;

use App\Models\Transaction\Rollie\CppHead;
use App\Models\Transaction\Rollie\CppDetail;
use App\Models\Transaction\Rollie\Palet;
use App\Models\Transaction\Rollie\PaletPpq;

use App\Models\Transaction\Rollie\Ppq;
use App\Models\Transaction\Rollie\Rkj;

use App\Models\Transaction\Rollie\FollowUpPpq;
use App\Models\Transaction\Rollie\FollowUpRkj;

use App\Models\Transaction\Rollie\AnalisaKimia;

use App\Models\Transaction\Rollie\AnalisaMikro;
use App\Models\Transaction\Rollie\AnalisaMikroDetail;
use App\Models\Transaction\Rollie\Psr;

/*use Illuminate\Support\Facades\Mail;
use App\Mail\Rollie\Ppq\NewPpqMail;*/

use DB;
use Auth;
use Session;
class RollieController extends ResourceController
{
	public function __construct()
	{
		$this->application 	= Application::where('application_name','Rollie')->first();
    	$this->menus 		= $this->application->menus->where('parent_id','0')->where('is_active','1');  		
    }
    public function index()
    {
		$menus 	= $this->menus;
		// return view('maintenance');
		return view('rollie.homes.home', compact('menus',$menus));
	}
	
	public function showProductionScheduleDashboard()
	{
		   $cekAkses 	= $this->checkAksesLihat(\Request::getRequestUri(),'rollie.production_schedules');
			if ($cekAkses['success']) 
			{
				$senin          = date("Y-m-d", strtotime('monday this week'));
				$minggu         = date("Y-m-d", strtotime('sunday this week'));
				$schedules      = WoNumber::whereBetween('production_plan_date',[$senin,$minggu])->orWhereNotIn('wo_status',['5','6'])->where('upload_status','1')->get();
				return view('rollie.production_schedules.dashboard', ['menus'=>$this->menus,'schedules'=>$schedules,'startweek'=>$senin,'endweek'=>$minggu]);
			} 
			else 
			{
				return redirect()->back()->with('error',$cekAkses['message']);
			}
			
	}
	public function showProductionScheduleForm()
	{
		$cekAkses 		= $this->checkAksesTambah(\Request::getRequestUri(),'rollie.production_schedules');
		if ($cekAkses['success']) 
		{
			$products 				= Product::where('is_active','1')->get();
			$draft_schedules 		= WoNumber::where('upload_status','0')->where('wo_status','0')->get();
			return view('rollie.production_schedules.form',['menus'=>$this->menus,'draft_schedules'=>$draft_schedules,'products'=>$products]);
		} 
		else
		{
			return redirect(route('rollie.production_schedules'))->with('error',$cekAkses['message']);
		}
		
	}
	public function showRpdFillingDashboard()
	{
		$cekAkses 	= $this->checkAksesLihat(\Request::getRequestUri(),'rollie.process_data.rpds');
		if ($cekAkses['success'] == true)
		{
			$senin          = date("Y-m-d", strtotime('monday this week'));
			$minggu         = date("Y-m-d", strtotime('sunday this week'));
			$wo_numbers 	= WoNumber::whereBetween('production_realisation_date',[$senin,$minggu])->orWhereIn('wo_status',['2','3'])->whereNotIn('product_id',['30','31','32'])->where('upload_status','1')->get();
			// $wo_numbers 	= $this->encryptId($wo_numbers,'rpd_filling_head_id','cpp_head_id');
			//$list_wo        = Wo::where('status','3')->orWhere('status','2')->whereNotIn('produk_id',['30','31','32'])->get();
        	return view('rollie.rpd_filling.dashboard',['menus'=>$this->menus,'wo_numbers'=>$wo_numbers]);
		} 
		else 
		{
			return redirect()->back()->with('error',$cekAkses['message']);
		}
	}
	

	public function showRpdFillingForm($rpd_filling_head_id)
	{
		$cekAkses 	= $this->checkAksesLihat(\Request::getRequestUri(),'rollie.process_data.rpds');
		if ($cekAkses['success'] == true)
		{
			$this->regenerateSession('rollie.process_data.rpds');
			$rpdFillingHead 	= RpdFillingHead::find($this->decrypt($rpd_filling_head_id));
			if ($rpdFillingHead->rpd_status == '0')
			{
				$activeRpdFilling 	= RpdFillingHead::where('rpd_status','0')->get();
				return view('rollie.rpd_filling.form',['menus'=>$this->menus,'rpdFillingHead'=>$rpdFillingHead,'activeRpdFilling'=>$activeRpdFilling]);
			} 
			else 
			{
				return redirect()->back()->with('infonya',"RPD Filling Sudah Di Close");
			}
			
		}
		else
		{
			return redirect()->back()->with('error',$cekAkses['message']);
		}
	}
	public function showPpqFillingForm($rpd_filling_head_id,$rpd_filling_detail_id_pi,$filling_machine_id,$wo_number_id)
	{
        $rpd_filling_head_id        = $this->decrypt($rpd_filling_head_id);
        $wo_number_id              	= $this->decrypt($wo_number_id);
        $filling_machine_id         = $this->decrypt($filling_machine_id);
		$rpd_filling_detail_pi_id   = $this->decrypt($rpd_filling_detail_id_pi);
        $rpdFillingHead     		= RpdFillingHead::find($rpd_filling_head_id);
        $rpdFillingDetailPis 		= $rpdFillingHead->rpdFillingDetailPis->where('wo_number_id',$wo_number_id)->where('filling_machine_id',$filling_machine_id);
        foreach ($rpdFillingDetailPis as $key => $rpdFillingDetailPi) 
        {
        	if ($rpdFillingDetailPi->id == $rpd_filling_detail_pi_id) 
        	{
        		$activeKey 	= $key;
        	}
		}
        /*$woNumber      		= $rpdFillingDetailPis[$activeKey]->woNumber;
		$fillingMachine    	= $rpdFillingDetailPis[$activeKey]->fillingMachine;*/	
		/* Start Penentuan nomor PPQ */	
			$ppqs            	= Ppq::all();
			$ppqakhir       	= $ppqs->last();
			if ($ppqakhir !== null) 
			{      
				$nomor_ppq      = explode('/', $ppqakhir->nomor_ppq);
			}
			else
			{
				$nomor_ppq 		= null;
			}

			if($nomor_ppq == null)
			{
				$nomor_ppq   = 1;
			}
			else
			{
				$nomor_ppq   = $nomor_ppq['0']+1;
			}

			if (strlen($nomor_ppq) == 1) 
			{
				$nomor_ppq = '00'.$nomor_ppq;
			}
			else if(strlen($nomor_ppq) == 2)
			{
				$nomor_ppq = '0'.$nomor_ppq;
			}
			else if (strlen($nomor_ppq) == 3) 
			{
				$nomor_ppq = $nomor_ppq;
			}
			
			$bulan          = ['01'=>'I','02'=>'II','03'=>'III','04'=>'IV','05'=>'V','06'=>'VI','07'=>'VII','08'=>'VIII','09'=>'IX','10'=>'X','11'=>'XI','12'=>'XII'];
			$nomor_ppq      = $nomor_ppq.'/PPQ/'.$bulan[date('m')].'/'.date('Y');
		/* End penentuan nomor ppq */
		
		$prevId 	= $activeKey-1;
		while ($prevId >= 0) 
		{
			$rpdFillingDetailPiSebelum 	= $rpdFillingDetailPis[$prevId-1];
			if($rpdFillingDetailPiSebelum->status_akhir == 'OK')
			{
				break;
			}
			else
			{
				$prevId 	= $prevId-1;
			}
		}
		$jam_filling_mulai      = $rpdFillingDetailPiSebelum->filling_date.' '.$rpdFillingDetailPiSebelum->filling_time;
		$jam_filling_akhir      = $rpdFillingDetailPis[$activeKey]->filling_date.' '.$rpdFillingDetailPis[$activeKey]->filling_time;
		$cppDetail 				= $rpdFillingDetailPis[$activeKey]->woNumber->cppDetails->where('filling_machine_id',$filling_machine_id)->first();
		if (is_null($cppDetail)) 
		{
			$getPalet               = null;
			$jumlahpack             = 0;
			$palets 				= NULL;
		} 
		else 
		{
			$jumlahpack 			= 0;
			$palet_mulai 			= Palet::where('cpp_detail_id',$cppDetail->id)->where(function ($query) use($jam_filling_mulai)
			{
				$query->where('start', '<=',$jam_filling_mulai)->where('end', '>=', $jam_filling_mulai);
			})->orWhere(function($query) use($jam_filling_mulai)
			{
				$query->where('start', '<=',$jam_filling_mulai)
					->whereNull('end');	
			})->first();
			/* jika palet mulai tidak terdeteksi karena adanya perbedaan jam dari cpp dan rpd filling maka akan dilakukan pengecekan langsung ke palet dari cpp detail tsb dan mengambil palet yang paling awal */
			$palet_akhir 			= 	Palet::where('cpp_detail_id',$cppDetail->id)->where(function ($query) use ($jam_filling_akhir)
			{
				$query->where('start','<=',$jam_filling_akhir)->where('end','>=',$jam_filling_akhir);
			})->orWhere(function ($query) use ($jam_filling_akhir)
			{
				$query->where('start','<=',$jam_filling_akhir)->whereNull('end');
			})->first();

			if(is_null($palet_mulai))
			{
				if (count($cppDetail->palets) == 0) 
				{
					$palet_mulai = null;
				}
				else
				{
					if ($cppDetail->palets[0]->start > $jam_filling_mulai); 
					{
						$palet_mulai = $cppDetail->palets[0];
					}	
				}
				
			}
			if (is_null($palet_akhir)) 
			{
				if (count($cppDetail->palets) == -1) 
				{
					$palet_akhir 	= null;
				} 
				else 
				{
					foreach ($cppDetail->palets as $palet) 
					{
						if ($palet->start >= $jam_filling_akhir) 
						{
							$palet_akhir = $palet;
						}
					}
				}
				
			}
			if ($palet_mulai == null || $palet_akhir == null) 
			{
				$palets 	= null;
			}
			else
			{
				$palet_mulai 			= substr($palet_mulai->palet,2,2);
				$palet_akhir 			= substr($palet_akhir->palet,2,2);
				if (strlen($palet_mulai) == 1) 
				{
					$palet_mulai = '0'.$palet_mulai;
				}
				if (strlen($palet_akhir) == 1) 
				{
					$palet_akhir = '0'.$palet_akhir;
				}
				$palets 				= Palet::whereBetween(\DB::raw('SUBSTR(`palet`, 2, 2)'),[$palet_mulai,$palet_akhir])->where('cpp_detail_id',$cppDetail->id)->get();
				//$getPalet             	=   DB::connection('transaction_data')->select("SELECT * FROM palets where SUBSTR(`palet`,2,2) BETWEEN SUBSTR('".$palet_mulai->palet."',2,2) AND SUBSTR('".$palet_akhir->palet."',2,2) AND cpp_detail_id = '".$cppDetail->id."'");
	            if (count($palets) > 0) 
	            {
	            	foreach ($palets as $palet) 
	            	{
	            		$jumlahpack += $palet->jumlah_pack;
	            	}
	            }
	            else
	            {
	            	$jumlahpack = 0;
	            }
			}
		}
		// dd($palets);
		$params 		= $this->encrypt('rpds');
		$parent_menu 	= 'data-proses';
		$route 			= 'rollie-process-data-rpds';
		$form			= 'Form RPD Filling';
		$wo_number                      = $rpdFillingDetailPis[$activeKey]->woNumber->wo_number;
		$production_realisation_date    = $rpdFillingDetailPis[$activeKey]->woNumber->production_realisation_date;
		$filling_machine 				= $rpdFillingDetailPis[$activeKey]->fillingMachine->filling_machine_code;
		$filling_machine_id    			= $rpdFillingDetailPis[$activeKey]->fillingMachine->filling_machine_id	;
		$jenisPpq 						= JenisPpq::where('jenis_ppq','Package Integrity')->first();
		$kategoriPpq 					= $jenisPpq->kategoriPpqs;
		return view('rollie.ppq_product.form',['menus'=>$this->menus,'jenisPpq'=>$jenisPpq /*jenis ppq di default 3 itu karena dia berasal dari RPD FILLING atau Package Integrity*/,
		'activeVariable'=>$rpdFillingDetailPis[$activeKey],'nomor_ppq'=>$nomor_ppq,'jam_filling_mulai'=>$jam_filling_mulai,'jam_filling_akhir'=>$jam_filling_akhir,'palets'=>$palets,'jumlahpack'=>$jumlahpack,'alasan_ppq'=>'','params'=>$params,'route'=>$route,'form'=>$form,'parent_menu'=>$parent_menu,'wo_number'=>$wo_number,'production_realisation_date'=>$production_realisation_date,'filling_machine_code'=>$filling_machine,'filling_machine_id'=>$filling_machine_id,'product_name'=>$rpdFillingDetailPis[$activeKey]->woNumber->product->product_name,'kategoriPpqs'=>$kategoriPpq,'oracle_code'=>$rpdFillingDetailPis[$activeKey]->woNumber->product->oracle_code]);	
	}
	public function showDraftPpq($rpd_filling_head_id)
	{
		$cekAkses 	= $this->checkAksesLihat(\Request::getRequestUri(),'rollie.process_data.rpds');
		if ($cekAkses['success'] == true) 
		{
            $rpdFillingHead       = RpdFillingHead::find($this->decrypt($rpd_filling_head_id));
            if ($rpdFillingHead->rpd_status=='0') 
            {
            	$rpdFillingDetailPiPpq = array();
            	foreach ($rpdFillingHead->rpdFillingDetailPis as $rpdFillingDetailPi) 
            	{
            		array_push($rpdFillingDetailPiPpq, $rpdFillingDetailPi->id);
            	}
            	$ppqs 	= Ppq::whereIn('rpd_filling_detail_pi_id',$rpdFillingDetailPiPpq)->where('status_akhir','5')->orWhere('jumlah_pack','0')->get();
            	foreach ($ppqs as $ppq) 
            	{
					foreach ($ppq->palets as $palet) 
					{
						$palet->delete();
					}
					$cppDetail 				= $ppq->rpdFillingDetailPi->woNumber->cppDetails->where('filling_machine_id',$rpdFillingDetailPi->filling_machine_id)->first();
					if (!is_null($cppDetail)) 
					{
						$jam_filling_mulai 		= $ppq->jam_awal_ppq;
						$jam_filling_akhir 		= $ppq->jam_akhir_ppq;
						$palet_mulai 			= Palet::where('cpp_detail_id',$cppDetail->id)->where(function ($query) use($jam_filling_mulai)
						{
							$query->where('start', '<=',$jam_filling_mulai)->where('end', '>=', $jam_filling_mulai);
						})->orWhere(function($query) use($jam_filling_mulai)
						{
							$query->where('start', '<=',$jam_filling_mulai)
								->whereNull('end');	
						})->first();
						/* jika palet mulai tidak terdeteksi karena adanya perbedaan jam dari cpp dan rpd filling maka akan dilakukan pengecekan langsung ke palet dari cpp detail tsb dan mengambil palet yang paling awal */
						$palet_akhir 			= 	Palet::where('cpp_detail_id',$cppDetail->id)->where(function ($query) use ($jam_filling_akhir)
						{
							$query->where('start','<=',$jam_filling_akhir)->where('end','>=',$jam_filling_akhir);
						})->orWhere(function ($query) use ($jam_filling_akhir)
						{
							$query->where('start','<=',$jam_filling_akhir)->whereNull('end');
						})->first();

						if(is_null($palet_mulai))
						{
							if (count($cppDetail->palets) == 0) 
							{
								$palet_mulai = null;
							}
							else
							{
								if ($cppDetail->palets[0]->start > $jam_filling_mulai); 
								{
									$palet_mulai = $cppDetail->palets[0];
								}	
							}
							
						}
						if (is_null($palet_akhir)) 
						{
							if (count($cppDetail->palets) == -1) 
							{
								$palet_akhir 	= null;
							} 
							else 
							{
								foreach ($cppDetail->palets as $palet) 
								{
									if ($palet->start >= $jam_filling_akhir) 
									{
										$palet_akhir = $palet;
									}
								}
							}
							
						}
						if ($palet_mulai !== null && $palet_akhir !== null) 
						{

							$palet_mulai 			= substr($palet_mulai->palet,2,2);
							$palet_akhir 			= substr($palet_akhir->palet,2,2);
							if (strlen($palet_mulai) == 1) 
							{
								$palet_mulai = '0'.$palet_mulai;
							}
							if (strlen($palet_akhir) == 1) 
							{
								$palet_akhir = '0'.$palet_akhir;
							}
							$palets 				= Palet::whereBetween(\DB::raw('SUBSTR(`palet`, 2, 2)'),[$palet_mulai,$palet_akhir])->where('cpp_detail_id',$cppDetail->id)->get();
							//$getPalet             	=   DB::connection('transaction_data')->select("SELECT * FROM palets where SUBSTR(`palet`,2,2) BETWEEN SUBSTR('".$palet_mulai->palet."',2,2) AND SUBSTR('".$palet_akhir->palet."',2,2) AND cpp_detail_id = '".$cppDetail->id."'");
			            	$jumlah_pack	= 0;

				            if (count($palets) > 0) 
				            {
				            	foreach ($palets as $palet) 
				            	{
				            		PaletPpq::create([
					            		'ppq_id' 	=> $ppq->id,
					            		'palet_id' 	=> $palet->id,
					            	]);
				            		$jumlah_pack += $palet->jumlah_pack;
				            	}
				            	$ppq->jumlah_pack = $jumlah_pack;
				            	$ppq->save();
				            }

						}
					}
            	}

            	$kategoriPpqs 	= KategoriPpq::where('is_active','1')->where('jenis_ppq_id','1')->get();
				return view('rollie.rpd_filling.form-draft-ppq',['menus'=>$this->menus,'ppqs'=>$ppqs,'rpdFillingHead'=>$rpdFillingHead,'kategoriPpqs'=>$kategoriPpqs]);
            } 
            else 
            {
                return redirect()->route('rollie.process_data.rpds')->with('error','RPD Filling Sudah Di Close');
            }
            
		} 
		else 
		{
			return redirect()->back()->with('error',$cekAkses['message']);
		}
		
	}
	public function showPpqPi($rpd_filling_head_id)
	{
		$cekAkses 	= $this->checkAksesLihat(\Request::getRequestUri(),'rollie.process_data.rpds');
		if ($cekAkses['success'] == true)
		{
			$rpd_filling_head_id 	= $this->decrypt($rpd_filling_head_id);
			$rpdFillingHead 		= RpdFillingHead::find($rpd_filling_head_id);
			if ($rpdFillingHead->rpd_status == '0') 
			{
				$rpdFillingDetailPi 	= array();
				foreach ($rpdFillingHead->rpdFillingDetailPis as $rpdFillingDetailPiId) 
				{
					array_push($rpdFillingDetailPi,$rpdFillingDetailPiId->id);
				}
            	$ppqs 	= Ppq::whereIn('rpd_filling_detail_pi_id',$rpdFillingDetailPi)->where('status_akhir','!=','5')->get();
            	return view('rollie.rpd_filling.form-ppq-pi',['menus'=>$this->menus,'ppqs'=>$ppqs,'rpdFillingHead'=>$rpdFillingHead]);
			} 
			else 
			{
				return redirect()->route('rollie.process_data.rpds')->with('info','RPD Filling Sudah Diclose');
			}
			
		}
		else
		{
			return redirect()->back()->with('error',$cekAkses['message']);
		}	
	}

	public function showCppProductDashboard()
	{
		$cekAkses 	= $this->checkAksesLihat(\Request::getRequestUri(),'rollie.process_data.cpps');
		if ($cekAkses['success'] == true)
		{
			$senin          = date("Y-m-d", strtotime('monday this week'));
			$minggu         = date("Y-m-d", strtotime('sunday this week'));
			$wo_numbers 	= WoNumber::whereBetween('production_realisation_date',[$senin,$minggu])->orWhere('wo_status','3')->whereNotIn('product_id',['30','31','32'])->where('upload_status','1')->get();
			$wo_numbers 	= $wo_numbers->where('wo_status','3');
			// $wo_numbers 	= $this->encryptId($wo_numbers,'rpd_filling_head_id','cpp_head_id');
			//$list_wo        = Wo::where('status','3')->orWhere('status','2')->whereNotIn('produk_id',['30','31','32'])->get();
        	return view('rollie.cpp_produk.dashboard',['menus'=>$this->menus,'wo_numbers'=>$wo_numbers]);
		} 
		else 
		{
			return redirect()->back()->with('error',$cekAkses['message']);
		}	
	}
	public function showCppProductForm($cpp_head_id)
	{
		$cekAkses 	= $this->checkAksesLihat(\Request::getRequestUri(),'rollie.process_data.cpps');
		if ($cekAkses['success'] == true)
		{
			$cppHead 			= CppHead::find($this->decrypt($cpp_head_id));
			$activeCppProduct 	= CppHead::where('cpp_status','0')->get();
			$this->regenerateSession('rollie.process_data.cpps');
			return view('rollie.cpp_produk.form',['menus'=>$this->menus,'cppHead'=>$cppHead,'activeCppProduct'=>$activeCppProduct]);
		}
		else
		{
			return redirect()->back()->with('error',$cekAkses['message']);
		}
	}

	public function showPsrDashboard()
	{
		$psrs 				= Psr::all();
		return view('rollie.psr.dashboard',['menus'=>$this->menus,'psrs'=>$psrs]);
	}
	public function showFiskokimiaDashboard()
	{
		$url 		= explode('/',\Request::getRequestUri());
		switch ($url[2])
		{
			case 'fisiko-kimia':
				$params 	= $this->encrypt('fiskokimias');
			break;
			case 'fisikokimia':
				$params 	= $this->encrypt('fiskokimias_qc_penyelia');
			break;
		}
		$cekAkses  	= $this->checkAksesLihat(\Request::getRequestUri(),'rollie.analysis_data.'.$this->decrypt($params));
		if ($cekAkses['success']) 
		{
			$cppHeads 			= CppHead::whereNull('analisa_kimia_id')->where('cpp_status','1')->get();
			foreach ($cppHeads as $cppHead) 
			{
				foreach ($cppHead->woNumbers as $woNumber) 
				{
					if ($woNumber->wo_status !== '4')
					{
						unset($cppHead);
					}
				}
			}
			
			$draftAnalisa 		= AnalisaKimia::where('progress_status','0')->get();
			$doneDraft 			= AnalisaKimia::where('progress_status','1')->get();
			return view('rollie.fiskokimia.dashboard',['menus'=>$this->menus,'cppHeads'=>$cppHeads,'draftAnalisas'=>$draftAnalisa,'doneAnalisa'=>$doneDraft,'params'=>$params]);
		} 
		else 
		{
 			return redirect()->back()->with('error',$cekAkses['message']);
		}
		
	}
	public function showFiskokimiaForm($analisa_kimia_id,$params)
	{
		$cekAkses 		= $this->checkAksesLihat(\Request::getRequestUri(),'rollie.analysis_data.'.$this->decrypt($params));
		if ($cekAkses['success']) 
		{
			$analisaKimia 	= AnalisaKimia::find($this->decrypt($analisa_kimia_id));
			return view('rollie.fiskokimia.form',['menus'=>$this->menus,'params'=>$params,'analisaKimia'=>$analisaKimia]);
		} else {
			return redirect()->back()->with('error',$cekAkses['message']);
		}
	}
	public function showFormPpqFisikokimia($analisa_kimia_id)
	{
		$analisaKimia 					= AnalisaKimia::find($this->decrypt($analisa_kimia_id));
		$product_name                   = $analisaKimia->cppHead->product->product_name;
		$oracle_code                    = $analisaKimia->cppHead->product->oracle_code;
		$spek_ts_min                    = $analisaKimia->cppHead->product->spek_ts_min;
		$spek_ts_max                    = $analisaKimia->cppHead->product->spek_ts_max;
		$spek_ph_min                    = $analisaKimia->cppHead->product->spek_ph_min;
		$spek_ph_max                    = $analisaKimia->cppHead->product->spek_ph_max;
		$wo_number                      = '';
		$production_realisation_date    = '';
		foreach ($analisaKimia->cppHead->woNumbers as $woNumber) 
		{
			if (strpos($wo_number,$woNumber->wo_number.', ') !== true) 
			{
				$wo_number .= $woNumber->wo_number.', ';
			}
			if ( strpos($production_realisation_date,$woNumber->production_realisation_date.', ') === false ) 
			{
				$production_realisation_date .= $woNumber->production_realisation_date.', ';
			}
		}
		$wo_number 						= rtrim($wo_number,', ');
		$production_realisation_date    = rtrim($production_realisation_date,', ');;
		$filling_machine                = '';
		$filling_machine_id             = '';
		foreach ($analisaKimia->cppHead->cppDetails as $cppDetail) 
		{
			if (strpos($filling_machine,$cppDetail->fillingMachine->filling_machine_code.', ') === false ) 
			{
				$filling_machine .= $cppDetail->fillingMachine->filling_machine_code.', ';
			}
			if (strpos($filling_machine_id,$this->encrypt($cppDetail->fillingMachine->id).', ')  === false) 
			{
				$filling_machine_id .= $this->encrypt($cppDetail->fillingMachine->id).', ';
			}
		}
		$filling_machine 				= rtrim($filling_machine,', ');
		$filling_machine_id    			= rtrim($filling_machine_id,', ');
		$ts_awal_1                      = $analisaKimia->ts_awal_1;
		$ts_awal_2                      = $analisaKimia->ts_awal_2;
		$ts_awal_avg                    = $analisaKimia->ts_awal_avg;
		$ts_tengah_1                    = $analisaKimia->ts_tengah_1;
		$ts_tengah_2                    = $analisaKimia->ts_tengah_2;
		$ts_tengah_avg                  = $analisaKimia->ts_tengah_avg;
		$ts_akhir_1                     = $analisaKimia->ts_akhir_1;
		$ts_akhir_2                     = $analisaKimia->ts_akhir_2;
		$ts_akhir_avg                   = $analisaKimia->ts_akhir_avg;
		$ph_awal                        = $analisaKimia->ph_awal;
		$ph_tengah                      = $analisaKimia->ph_tengah;
		$ph_akhir                       = $analisaKimia->ph_akhir;
		$sensori_awal                   = $analisaKimia->sensori_awal;
		$sensori_tengah                 = $analisaKimia->sensori_tengah;
		$sensori_akhir                  = $analisaKimia->sensori_akhir;
		$visko_awal                     = $analisaKimia->visko_awal;
		$visko_tengah                   = $analisaKimia->visko_tengah;
		$visko_akhir                    = $analisaKimia->visko_akhir;
		$jam_filling_awal               = $analisaKimia->jam_filling_awal;
		$jam_filling_tengah             = $analisaKimia->jam_filling_tengah;
		$jam_filling_akhir              = $analisaKimia->jam_filling_akhir;
		$kode_batch_standar             = $analisaKimia->kode_batch_standar;
		$analisa_kimia_status           = $analisaKimia->analisa_kimia_status;
		$ambil_palet                    = ''; /* ini digunakan untuk parameter ketidak sesuaian ada di rentang palet mana awal atau tengah atau akhir */
		$keterangan_awal                = ''; /* ini digunakan untuk keterangan awal palet apabila ada ketidaksesuaian */
		$keterangan_tengah              = ''; /* ini digunakan untuk keterangan tengah palet apabila ada ketidaksesuaian */
		$keterangan_akhir               = '';/* ini digunakan untuk keterangan akhir palet apabila ada ketidaksesuaian */
		$url 		= explode('/',\Request::getRequestUri());
		switch ($url[2])
		{
			case 'fisiko-kimia':
				$params 		= $this->encrypt('fiskokimias');
				$parent_menu 	= 'data-analisa';
				$route 			= 'rollie-analysis-data-fisiko-kimia';
				$form			= 'Fisikokimia';
			break;
			case 'fisikokimia':
				$params 		= $this->encrypt('fiskokimias_qc_penyelia');
				$parent_menu 	= 'data-analisa';
				$route 			= 'rollie-analysis-data-fisiko';
				$form			= 'Fisikokimia';
			break;
			case 'rpd-filling':
				$params 		= $this->encrypt('rpds');
				$parent_menu 	= 'data-proses';
				$route 			= 'rollie-process-data-rpds';
				$form			= 'Form RPD Filling';
			break;
		}
		
		if ($ts_awal_avg < $spek_ts_min ) 
		{
			if (strpos($ambil_palet,'Awal')) 
			{
				$ambil_palet = $ambil_palet;
			}
			else
			{
				$ambil_palet = $ambil_palet."Awal ";
			}

			if (strpos($keterangan_awal,'TS DROP '.number_format($ts_awal_avg,2,'.',',')))
			{
				$keterangan_awal = $keterangan_awal;
			}
			else
			{
				$keterangan_awal = $keterangan_awal."TS DROP ".number_format($ts_awal_avg,2,'.',',');
			}
		}
		if ($ts_tengah_avg < $spek_ts_min ) 
		{
			if (strpos($ambil_palet,'Tengah')) 
			{
				$ambil_palet = $ambil_palet;
			}
			else
			{
				$ambil_palet = $ambil_palet."Tengah ";
			}

			if (strpos($keterangan_tengah,'TS DROP '.number_format($ts_tengah_avg,2,'.',',')))
			{
				$keterangan_tengah = $keterangan_tengah;
			}
			else
			{
				$keterangan_tengah = $keterangan_tengah."TS DROP ".number_format($ts_tengah_avg,2,'.',',');
			}
		}
		if ($ts_akhir_avg < $spek_ts_min ) 
		{
			if (strpos($ambil_palet,'Akhir')) 
			{
				$ambil_palet = $ambil_palet;
			}
			else
			{
				$ambil_palet = $ambil_palet."Akhir ";
			}

			if (strpos($keterangan_akhir,'TS DROP '.number_format($ts_akhir_avg,2,'.',',')))
			{
				$keterangan_akhir = $keterangan_akhir;
			}
			else
			{
				$keterangan_akhir = $keterangan_akhir."TS DROP ".number_format($ts_akhir_avg,2,'.',',');
			}
		}

		if ($ts_awal_avg > $spek_ts_max ) 
		{
			if (strpos($ambil_palet,'Awal')) 
			{
				$ambil_palet = $ambil_palet;
			}
			else
			{
				$ambil_palet = $ambil_palet."Awal ";
			}

			if (strpos($keterangan_awal,'TS OVER '.number_format($ts_awal_avg,2,'.',',')))
			{
				$keterangan_awal = $keterangan_awal;
			}
			else
			{
				$keterangan_awal = $keterangan_awal." TS OVER ".number_format($ts_awal_avg,2,'.',',');
			}
		}
		if ($ts_tengah_avg > $spek_ts_max ) 
		{
			if (strpos($ambil_palet,'Tengah')) 
			{
				$ambil_palet = $ambil_palet;
			}
			else
			{
				$ambil_palet = $ambil_palet."Tengah ";
			}

			if (strpos($keterangan_tengah,'TS OVER '.number_format($ts_tengah_avg,2,'.',',')))
			{
				$keterangan_tengah = $keterangan_tengah;
			}
			else
			{
				$keterangan_tengah = $keterangan_tengah." TS OVER ".number_format($ts_tengah_avg,2,'.',',');
			}
		}
		if ($ts_akhir_avg > $spek_ts_max ) 
		{
			if (strpos($ambil_palet,'Akhir')) 
			{
				$ambil_palet = $ambil_palet;
			}
			else
			{
				$ambil_palet = $ambil_palet."Akhir ";
			}

			if (strpos($keterangan_akhir,'TS Akhir '.number_format($ts_akhir_avg,2,'.',',')))
			{
				$keterangan_akhir = $keterangan_akhir;
			}
			else
			{
				$keterangan_akhir = $keterangan_akhir." TS Akhir ".number_format($ts_akhir_avg,2,'.',',');
			}
		}

		if ($ph_awal < $spek_ph_min ) 
		{
			if (strpos($ambil_palet,'Awal')) 
			{
				$ambil_palet = $ambil_palet;
			}
			else
			{
				$ambil_palet = $ambil_palet."Awal ";
			}

			if (strpos($keterangan_awal,'pH DROP '.number_format($ph_awal,2,'.',',')))
			{
				$keterangan_awal = $keterangan_awal;
			}
			else
			{
				$keterangan_awal = $keterangan_awal." pH DROP ".number_format($ph_awal,2,'.',',');
			}
		}
		if ($ph_tengah < $spek_ph_min ) 
		{
			if (strpos($ambil_palet,'Tengah')) 
			{
				$ambil_palet = $ambil_palet;
			}
			else
			{
				$ambil_palet = $ambil_palet."Tengah ";
			}

			if (strpos($keterangan_tengah,'pH DROP'.number_format($ph_tengah,2,'.',',')))
			{
				$keterangan_tengah = $keterangan_tengah;
			}
			else
			{
				$keterangan_tengah = $keterangan_tengah." pH DROP ".number_format($ph_tengah,2,'.',',');
			}
		}
		if ($ph_akhir < $spek_ph_min ) 
		{
			if (strpos($ambil_palet,'Akhir')) 
			{
				$ambil_palet = $ambil_palet;
			}
			else
			{
				$ambil_palet = $ambil_palet."Akhir ";
			}

			if (strpos($keterangan_akhir,'pH DROP '.number_format($ph_akhir,2,'.',',')))
			{
				$keterangan_akhir = $keterangan_akhir;
			}
			else
			{
				$keterangan_akhir = $keterangan_akhir." pH DROP ".number_format($ph_akhir,2,'.',',');
			}
		}
		
		if ($ph_awal > $spek_ph_max ) 
		{
			if (strpos($ambil_palet,'Awal')) 
			{
				$ambil_palet = $ambil_palet;
			}
			else
			{
				$ambil_palet = $ambil_palet."Awal ";
			}

			if (strpos($keterangan_awal,'pH OVER '.number_format($ph_awal,2,'.',',')))
			{
				$keterangan_awal = $keterangan_awal;
			}
			else
			{
				$keterangan_awal = $keterangan_awal." pH OVER ".number_format($ph_awal,2,'.',',');
			}
		}
		if ($ph_tengah > $spek_ph_max ) 
		{
			if (strpos($ambil_palet,'Tengah')) 
			{
				$ambil_palet = $ambil_palet;
			}
			else
			{
				$ambil_palet = $ambil_palet."Tengah ";
			}

			if (strpos($keterangan_tengah,'pH OVER '.number_format($ph_tengah,2,'.',',')))
			{
				$keterangan_tengah = $keterangan_tengah;
			}
			else
			{
				$keterangan_tengah = $keterangan_tengah." pH OVER ".number_format($ph_tengah,2,'.',',');
			}
		}
		if ($ph_akhir > $spek_ph_max ) 
		{
			if (strpos($ambil_palet,'Akhir')) 
			{
				$ambil_palet = $ambil_palet;
			}
			else
			{
				$ambil_palet = $ambil_palet."Akhir ";
			}

			if (strpos($keterangan_akhir,'pH Over '.number_format($ph_akhir,2,'.',',')))
			{
				$keterangan_akhir = $keterangan_akhir;
			}
			else
			{
				$keterangan_akhir = $keterangan_akhir." pH Over ".number_format($ph_akhir,2,'.',',');
			}
		}

		if ($sensori_awal === '#OK' ) 
		{
			if (strpos($ambil_palet,'Awal')) 
			{
				$ambil_palet = $ambil_palet;
			}
			else
			{
				$ambil_palet = $ambil_palet."Awal ";
			}

			if (strpos($keterangan_awal,'Sensori Awal #OK'))
			{
				$keterangan_awal = $keterangan_awal;
			}
			else
			{
				$keterangan_awal = $keterangan_awal." Sensori Awal #OK ";
			}
		}
		if ($sensori_tengah === '#OK' ) 
		{
			if (strpos($ambil_palet,'Tengah')) 
			{
				$ambil_palet = $ambil_palet;
			}
			else
			{
				$ambil_palet = $ambil_palet."Tengah ";
			}

			if (strpos($keterangan_tengah,'Sensori Tengah #OK'))
			{
				$keterangan_tengah = $keterangan_tengah;
			}
			else
			{
				$keterangan_tengah = $keterangan_tengah." Sensori Tengah #OK ";
			}
		}
		if ($sensori_akhir === '#OK' ) 
		{
			if (strpos($ambil_palet,'Akhir')) 
			{
				$ambil_palet = $ambil_palet;
			}
			else
			{
				$ambil_palet = $ambil_palet."Akhir ";
			}

			if (strpos($keterangan_akhir,'Sensori Akhir #OK'))
			{
				$keterangan_akhir = $keterangan_akhir;
			}
			else
			{
				$keterangan_akhir = $keterangan_akhir." Sensori Akhir #OK ";
			}
		}
		/* Start Penentuan nomor PPQ */	
			$ppqs            	= Ppq::all();
			$ppqakhir       	= $ppqs->last();
			if ($ppqakhir !== null) 
			{      
				$nomor_ppq      = explode('/', $ppqakhir->nomor_ppq);
			}
			else
			{
				$nomor_ppq 		= null;
			}

			if($nomor_ppq == null)
			{
				$nomor_ppq   = 1;
			}
			else
			{
				$nomor_ppq   = $nomor_ppq['0']+1;
			}

			if (strlen($nomor_ppq) == 1) 
			{
				$nomor_ppq = '00'.$nomor_ppq;
			}
			else if(strlen($nomor_ppq) == 2)
			{
				$nomor_ppq = '0'.$nomor_ppq;
			}
			else if (strlen($nomor_ppq) == 3) 
			{
				$nomor_ppq = $nomor_ppq;
			}
			
			$bulan          = ['01'=>'I','02'=>'II','03'=>'III','04'=>'IV','05'=>'V','06'=>'VI','07'=>'VII','08'=>'VIII','09'=>'IX','10'=>'X','11'=>'XI','12'=>'XII'];
			$nomor_ppq      = $nomor_ppq.'/PPQ/'.$bulan[date('m')].'/'.date('Y');
		/* End penentuan nomor ppq */
		$palets         = array();
		$jumlah_pack    = 0;
		if (( strpos($ambil_palet,"Awal") !== false && strpos($ambil_palet,"Akhir") !== false ) || strpos($ambil_palet,"Tengah") !== false ) 
		{
			// ini ppq palet semua
			$jam_filling_mulai 		= $jam_filling_awal;
			$jam_filling_akh 		= $jam_filling_akhir;
			if ($keterangan_tengah == '' || is_null($keterangan_tengah)) 
			{
				$alasan_ppq = "Palet Awal : ".$keterangan_awal.", Palet Akhir : ".$keterangan_akhir;
			}
			else
			{
				if ($keterangan_awal == '' || is_null($keterangan_awal)) 
				{
					$keterangan_awal = 'OK';
				}
				if ($keterangan_akhir == "" || is_null($keterangan_akhir)) 
				{
					$keterangan_akhir = 'OK';
				}
				$alasan_ppq = "Palet Awal : ".$keterangan_awal.", Palet Tengah : ".$keterangan_tengah.", Palet Akhir : ".$keterangan_akhir;

			}
			foreach ($analisaKimia->cppHead->cppDetails as $cppDetail) 
			{
				foreach ($cppDetail->palets as $palet) 
				{
					array_push($palets,$palet);
				}
			}
		}
		else if(strpos($ambil_palet,'Awal')!== false && (strpos($ambil_palet, 'Akhir') !== true && strpos($ambil_palet,'Tengah') !== true ))
		{
			$jam_filling_mulai 		= $jam_filling_awal;
			$jam_filling_akh 		= $jam_filling_tengah;
			$alasan_ppq         = 'Palet Awal : '.$keterangan_awal;
			foreach ($analisaKimia->cppHead->cppDetails as $cppDetail) 
			{
				foreach ($cppDetail->palets as $palet) 
				{
					if (($jam_filling_awal >= $palet->start && $jam_filling_awal <= $palet->end) || ($palet->start >= $jam_filling_awal && $palet->end <= $jam_filling_tengah) || ($jam_filling_tengah >= $palet->start && $jam_filling_tengah <= $palet->end)) 
					{
						array_push($palets,$palet);
					}
				}
			}
		}
		else if(strpos($ambil_palet,'Akhir')!== false && ( strpos($ambil_palet, 'Awal') !== true && strpos($ambil_palet,'Tengah') !== true))
		{
			$jam_filling_mulai 		= $jam_filling_tengah;
			$jam_filling_akh 		= $jam_filling_akhir;
			$alasan_ppq         	= 'Palet Akhir : '.$keterangan_akhir;

			foreach ($analisaKimia->cppHead->cppDetails as $cppDetail) 
			{
				foreach ($cppDetail->palets as $palet) 
				{
					if (($jam_filling_tengah >= $palet->start && $jam_filling_tengah <= $palet->end) || ($palet->start >= $jam_filling_tengah && $palet->end <= $jam_filling_akhir)) 
					{
						array_push($palets,$palet);
					}
				}
			}
		}
		foreach ($palets as $palet)
		{
			$jumlah_pack += $palet->jumlah_pack;
		}
		$jenisPpq 						= JenisPpq::where('jenis_ppq','Kimia')->first();
		$kategoriPpq 					= $jenisPpq->kategoriPpqs;
		return view('rollie.ppq_product.form',['menus'=>$this->menus,'params'=>$params,'route'=>$route,'form'=>$form,'parent_menu'=>$parent_menu,'palets'=>$palets,'jumlahpack'=>$jumlah_pack,'alasan_ppq'=>$alasan_ppq,'activeVariable'=>$analisaKimia->cppHead,'jenis_ppq'=>'0','nomor_ppq'=>$nomor_ppq,'product_name'=>$analisaKimia->cppHead->product->product_name,'oracle_code'=>$analisaKimia->cppHead->product->oracle_code,'production_realisation_date'=>$production_realisation_date,'wo_number'=>$wo_number,'filling_machine_code'=>$filling_machine,'filling_machine_id'=>$filling_machine_id,'jam_filling_mulai'=>$jam_filling_mulai,'jam_filling_akhir'=>$jam_filling_akh,'jenisPpq'=>$jenisPpq,'kategoriPpqs'=>$kategoriPpq]);

	}

	public function showAnalisaMikroProductDashboard()
	{
		$url 		= explode('/',\Request::getRequestUri());
		switch ($url[2])
		{
			case 'analisa-mikro-produk':
				$params 	= $this->encrypt('analisa_mikro_produk');
			break;
			case 'analisa-ph-produk':
				$params 	= $this->encrypt('analisa_ph_produk');
			break;
			case 'analisa-mikro-release':
				$params 	= $this->encrypt('analisa_mikro_release');
			break;
		}
		$cekAkses 	= $this->checkAksesLihat(\Request::getRequestUri(),'rollie.analysis_data.'.str_replace('-','_',$url[2]));

		if ($cekAkses['success']) 
		{
			$cppHeads 		= CppHead::all();
			return view('rollie.analisa_mikro.dashboard',['menus'=>$this->menus,'params'=>$params,'cppHeads'=>$cppHeads]);
		} 
		else 
		{
			return redirect()->back()->with('error',$cekAkses['message']);
		}
		
	}
	public function showAnalisaMikroProductForm($analisa_mikro_id)
	{
		$url 		= explode('/',\Request::getRequestUri());
		switch ($url[2])
		{
			case 'analisa-mikro-produk':
				$params 	= $this->encrypt('analisa_mikro_produk');
			break;
			case 'analisa-ph-produk':
				$params 	= $this->encrypt('analisa_ph_produk');
			break;
			
			case 'analisa-mikro-release':
				$params 	= $this->encrypt('analisa_mikro_release');
			break;
		}
		$cekAksesLihat	= $this->checkAksesLihat(\Request::getRequestUri(),'rollie.analysis_data.'.str_replace('-','_',$url[2]));
		if ($cekAksesLihat['success'])
		{
			$analisaMikro 		= AnalisaMikro::find($this->decrypt($analisa_mikro_id));
			return view('rollie.analisa_mikro.form',['menus'=>$this->menus,'params'=>$params,'analisaMikro'=>$analisaMikro]);
		} 
		else 
		{
			return redirect()->back()->with('error',$cekAksesLihat['message']);
		}
		
	}

	public function showPpqForm($ppq_id_30,$ppq_id_55)
	{
		$ppq_id_30 	= $this->decrypt($ppq_id_30);
		$ppq_id_55 	= $this->decrypt($ppq_id_55);
		if (is_null($ppq_id_30)) 
		{
			$ppq_30 	= 'NULL';
		}
		else
		{
			$ppq_30 	= Ppq::find($ppq_id_30);
		}
		
		if (is_null($ppq_id_55)) 
		{
			$ppq_55 	= 'NULL';
		}
		else
		{
			$ppq_55 	= Ppq::find($ppq_id_55);
		}
		$jenisPpq 		= JenisPpq::find('3');
		return view('rollie.analisa_mikro.form-ppq',['menus'=>$this->menus,'ppq_30'=>$ppq_30,'ppq_55'=>$ppq_55,'jenisPpq'=>$jenisPpq]);
	}

	public function showPpqDashboard()
	{
		$url 		= explode('/',\Request::getRequestUri());
		switch ($url[2]) 
		{
			case 'ppq-qc-release':
				$params 	= 'ppq-qc-release';
				$jenisPpqs 	= JenisPpq::whereIn('jenis_ppq',['Package Integrity','Mikro','Sortasi'])->get();
				$ppqs 		= array();
				foreach ($jenisPpqs as $jenisPpq) 
				{
					foreach ($jenisPpq->kategoriPpqs as $kategoriPpq) 
					{
						foreach ($kategoriPpq->ppqs as $ppq) 
						{
							array_push($ppqs, $ppq);
						}
					}
				}
			break;
			
			case 'ppq-qc-tahanan':
				$params 	= 'ppq-qc-tahanan';
				$ppqs 		= Ppq::all();
			break;
			
			case 'ppq-engineering':
				$params 		= 'ppq-engineering';
				$kategoriPpqs 	= KategoriPpq::where('kategori_ppq','Machine')->get();
				$ppqs 			= array();
				foreach ($kategoriPpqs as $kategoriPpq) 
				{
					foreach ($kategoriPpq->ppqs as $ppq) 
					{
						array_push($ppqs,$ppq);
					}
				}
			break;
		}
		
		foreach ($ppqs as $ppq) 
		{
			$wo_number 						= array();
			$production_realisation_date 	= array();
			foreach ($ppq->palets as $palet) 
			{ 
				if (!in_array($palet->palet->cppDetail->woNumber->wo_number,$wo_number)) 
				{
					array_push($wo_number,$palet->palet->cppDetail->woNumber->wo_number,$wo_number);
				}
				if (!in_array($palet->palet->cppDetail->woNumber->production_realisation_date,$production_realisation_date)) 
				{
					array_push($production_realisation_date,$palet->palet->cppDetail->woNumber->production_realisation_date,$production_realisation_date);
				}
			}
			$woNumber 	='';
			foreach ($wo_number as $value) 
			{
				if ($value !== '' && !is_array($value))
				{
					$woNumber .= $value.', ';
				}
			}
			$productionRealisationDate 	='';
			foreach ($production_realisation_date as $value) 
			{
				if ($value !== '' && !is_array($value))
				{
					$productionRealisationDate .= $value.', ';
				}
			}
			$ppq->wo_number 					= rtrim($woNumber,', ');
			$ppq->production_realisation_date 	= rtrim($productionRealisationDate,', ');
		}
		return view('rollie.ppq_product.dashboard',['menus'=>$this->menus,'route'=>$params,'ppqs'=>$ppqs]);
	}
	public function showFollowUpPpqForm($follow_up_ppq_id,$params,$params_induk)
	{
		$followUpPpq 	= FollowUpPpq::find($this->decrypt($follow_up_ppq_id));
		if ($followUpPpq->status_follow_up_ppq == '0') 
		{
			return view('rollie.follow_up_ppq.form',['menus'=>$this->menus,'followUpPpq'=>$followUpPpq,'route'=>str_replace('_','-',$this->decrypt($params)),'params_induk'=>str_replace('_','-',$this->decrypt($params_induk))]);
		}
		else
		{
			if ($this->decrypt($params) !== false) 
			{
				$params 	= $this->decrypt($params);
			}
			
			if ($this->decrypt($params_induk) !== false) 
			{
				$params_induk 	= $this->decrypt($params_induk);
			}
			$params_corrective 	=0;
			if (!is_null($followUpPpq->correctiveActions) || !is_null($followUpPpq->preventiveActions)) 
			{
				if ($followUpPpq->correctiveActions->where('status_corrective_action','0')->count() == '0' || $followUpPpq->preventiveActions->where('status_preventive_action','0')->count() == '0' ) 
				{
					return view('rollie.follow_up_ppq.form',['menus'=>$this->menus,'followUpPpq'=>$followUpPpq,'route'=>str_replace('_','-',$params),'params_induk'=>str_replace('_','-',$params_induk)]);		
				}
				else
				{
					switch ($followUpPpq->status_produk) 
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
		            if ($this->decrypt($params_induk) == 'null') 
					{
						$params 	= str_replace('-', '_', $this->decrypt($params));
					}
					else
					{
						$params 	= str_replace('-', '_', $this->decrypt($params_induk));
					}
					return view('rollie.follow_up_ppq.form',['menus'=>$this->menus,'followUpPpq'=>$followUpPpq,'route'=>str_replace('_','-',$params),'params_induk'=>str_replace('_','-',$params_induk)])->with('error','PPQ dengan nomor '.$followUpPpq->ppq->nomor_ppq.' telah berhasil difollow up oleh '.$followUpPpq->updatedBy->employee->fullname.' dengan status produk '.$status_produk);		
				}
			}
			else
			{
				switch ($followUpPpq->status_produk) 
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
	            if ($this->decrypt($params_induk) == 'null') 
				{
					$params 	= str_replace('-', '_', $this->decrypt($params));
				}
				else
				{
					$params 	= str_replace('-', '_', $this->decrypt($params_induk));
				}
				return view('rollie.follow_up_ppq.form',['menus'=>$this->menus,'followUpPpq'=>$followUpPpq,'route'=>str_replace('_','-',$params),'params_induk'=>str_replace('_','-',$params_induk)])->with('error','PPQ dengan nomor '.$followUpPpq->ppq->nomor_ppq.' telah berhasil difollow up oleh '.$followUpPpq->updatedBy->employee->fullname.' dengan status produk '.$status_produk);

			}
		}
	}
	public function showFollowUpRkjForm($follow_up_rkj_id,$params)
	{
		$cekAkses 		= $this->checkAksesLihat(\Request::getRequestUri(),'rollie.rkol.'.str_replace('-','_',$this->decrypt($params)));
		if ($cekAkses['success']) 
		{
			$followUpRkj 	= FollowUpRkj::find($this->decrypt($follow_up_rkj_id));
			return view('rollie.follow_up_rkj.form',['menus'=>$this->menus,'followUpRkj'=>$followUpRkj,'route'=>$this->decrypt($params)]);
		} 
		else
		{
			return redirect()->back()->with('error',$cekAkses['message']);
		}
		
	}

	public function showRkjDashboard()
	{
		$url 		= explode('/',\Request::getRequestUri());
		$rkj_array 	= array();
		switch ($url[2]) 
		{
			case 'rkj-rnd-produk-nfi':
				$params 	= 'rkj-rnd-produk-nfi';
				$rkjs 		= Rkj::all();
				foreach ($rkjs as $rkj) 
				{
					if ($rkj->ppq->palets[0]->palet->cppDetail->woNumber->product->subbrand->brand->brand_name == 'NFI') 
					{
						array_push($rkj_array,$rkj);
					}
				}
			break;
			
			case 'rkj-qa':
				$params 	= 'rkj-qa';
				$rkjs 		= Rkj::all();
				foreach ($rkjs as $rkj) 
				{
					array_push($rkj_array,$rkj);
				}
			break;
		}
		foreach ($rkj_array as $rkj) 
		{
			$wo_number 						= array();
			$production_realisation_date 	= array();
			foreach ($rkj->ppq->palets as $palet) 
			{ 
				if (!in_array($palet->palet->cppDetail->woNumber->wo_number,$wo_number)) 
				{
					array_push($wo_number,$palet->palet->cppDetail->woNumber->wo_number,$wo_number);
				}
				if (!in_array($palet->palet->cppDetail->woNumber->production_realisation_date,$production_realisation_date)) 
				{
					array_push($production_realisation_date,$palet->palet->cppDetail->woNumber->production_realisation_date,$production_realisation_date);
				}
			}
			$woNumber 	='';
			foreach ($wo_number as $value) 
			{
				if ($value !== '' && !is_array($value))
				{
					$woNumber .= $value.', ';
				}
			}
			$productionRealisationDate 	='';
			foreach ($production_realisation_date as $value) 
			{
				if ($value !== '' && !is_array($value))
				{
					$productionRealisationDate .= $value.', ';
				}
			}
			$rkj->ppq->wo_number 					= rtrim($woNumber,', ');
			$rkj->ppq->production_realisation_date 	= rtrim($productionRealisationDate,', ');
		}
		return view('rollie.rkj_product.dashboard',['menus'=>$this->menus,'route'=>$params,'rkjs'=>$rkj_array]);
	}

	public function showRprDashboard()
	{
		$woNumbers 	= WoNumber::whereIn('wo_status',['4','5'])->get();
		return view('rollie.reports.rpr.dashboard',['menus'=>$this->menus,'woNumbers'=>$woNumbers]);
	}
	public function showReportRpdDashboard()
	{
		$rpdHeads 		= RpdFillingHead::where('rpd_status','1')->get();
		return view('rollie.reports.rpd_filling.dashboard',['menus'=>$this->menus,'rpdHeads'=>$rpdHeads]);
	}
	
	public function showReportRpdExcel()
	{
		$rpdHeads 		= RpdFillingHead::where('rpd_status','1')->get();
		return view('rollie.reports.rpd_filling.export',['menus'=>$this->menus,'rpdHeads'=>$rpdHeads]);
	}
}
