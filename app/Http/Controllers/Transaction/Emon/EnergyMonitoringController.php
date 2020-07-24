<?php

namespace App\Http\Controllers\Transaction\Emon;

use Illuminate\Http\Request;
use App\Http\Controllers\Transaction\Emon\EnergyUsageController;
 
use App\Models\Master\Emon\Flowmeter;
use App\Models\Master\Emon\FlowmeterUsage;
use App\Models\Master\Emon\FlowmeterFormula;
use App\Models\Master\Emon\FlowmeterCategory;
use App\Models\Master\Emon\FlowmeterWorkcenter;
use App\Models\Master\Emon\FlowmeterUnit;
use App\Models\Master\Emon\FlowmeterLocation;
use App\Models\Master\Emon\FlowmeterLocationPermissions;
use App\Models\Transaction\Emon\EnergyMonitoring;

use \Carbon\Carbon;
use Auth;
class EnergyMonitoringController extends EnergyUsageController
{
    public function inputMonitoringEnergy(Request $request)
    {
        $cekMonitoringCategory  = explode('/', \Request::getRequestUri());
        switch ($cekMonitoringCategory[2]) 
        {
            case 'monitoring-air':
                $page_access = 'emon.monitoring.water';
            break;
            case 'monitoring-gas':
                $page_access = 'emon.monitoring.gas';
            break;

            case 'monitoring-listrik':
                $page_access = 'emon.monitoring.gas';
            break;
        }
        $cekAkses       = $this->checkAksesTambah(\Request::getRequestUri(),$page_access);
        $today          = Carbon::today()->toDateString();
        $yesterday      = Carbon::yesterday()->toDateString();
        if ($cekAkses['success'] == true) 
        {
            $flowmeter          = Flowmeter::find($this->decrypt($request->flowmeter_id));
            $flowmeterLocationPermissions   = $flowmeter->flowmeterLocation->flowmeterLocationPermissions->where('user_id',Auth::user()->id)->first();
            if (!is_null($flowmeterLocationPermissions)) 
            {
                if ($flowmeterLocationPermissions->is_allow == '1') 
                {
                    switch ($flowmeter->recording_schedule) 
                    {
                        case '0':
                            /* harian */
                            if ( is_null($flowmeter->energyMonitorings->where('monitoring_date',$today)->first() )) 
                            {
                                $yesterdayMonitoringValue    = $flowmeter->energyMonitorings->where('monitoring_date',$yesterday)->first();
                                if (!is_null($yesterdayMonitoringValue)) 
                                {
                                    $lastMonitoringValue    = $yesterdayMonitoringValue->monitoring_value;
                                } 
                                else 
                                {
                                    if (count($flowmeter->energyMonitorings) > 0) 
                                    {
                                        $lastMonitoringBeforeToday      = $flowmeter->energyMonitorings->where('monitoring_date','<',$today);
                                        if (!is_null($lastMonitoringBeforeToday) && count($lastMonitoringBeforeToday) > 0)
                                        {
                                            $lastMonitoringValue    = $lastMonitoringBeforeToday[count($lastMonitoringBeforeToday)-1]->monitoring_value;
                                        }
                                        else
                                        {
                                            $energyMonitoring   = EnergyMonitoring::create([
                                                'flowmeter_id'      => $flowmeter->id,
                                                'monitoring_value'  => $request->monitoring_value,
                                                'monitoring_date'   => date('Y-m-d')
                                                ]);
                                            $refreshEnergyUsage = $this->refreshEnergyUsage($flowmeter->flowmeterWorkcenter->flowmeterCategory->flowmeterWorkcenters);
                                            return ['success' => true,'message'=>'Data monitoring flowmeter berhasil disimpan'];
                                        }
                                    }
                                    else
                                    {
                                        $energyMonitoring   = EnergyMonitoring::create([
                                            'flowmeter_id'      => $flowmeter->id,
                                            'monitoring_value'  => $request->monitoring_value,
                                            'monitoring_date'   => date('Y-m-d')
                                            ]);
                                        $refreshEnergyUsage = $this->refreshEnergyUsage($flowmeter->flowmeterWorkcenter->flowmeterCategory->flowmeterWorkcenters);
                                        return ['success' => true,'message'=>'Data monitoring flowmeter berhasil disimpan'];
                                    }
                                }
                                if ($request->monitoring_value < $lastMonitoringValue) 
                                {
                                    return ['success'=>false,'message'=>'Angka meteran hari ini tidak boleh kurang dari hari kemarin'];
                                }
                                else
                                {
                                    $energyMonitoring   = EnergyMonitoring::create([
                                        'flowmeter_id'      => $flowmeter->id,
                                        'monitoring_value'  => $request->monitoring_value,
                                        'monitoring_date'   => date('Y-m-d')
                                        ]);
                                    $refreshEnergyUsage = $this->refreshEnergyUsage($flowmeter->flowmeterWorkcenter->flowmeterCategory->flowmeterWorkcenters);
                                    return ['success' => true,'message'=>'Data monitoring flowmeter berhasil disimpan'];
                                }
                                
                            }
                            else
                            {
                                $refreshEnergyUsage = $this->refreshEnergyUsage($flowmeter->flowmeterWorkcenter->flowmeterCategory->flowmeterWorkcenters);
                            }
                        break;
                    }
                } 
                else if($flowmeterLocationPermissions->is_allow == '0')
                {
                    return ['success'=>false,'message'=>'Anda tidak memiliki akses untuk melakukan pengamatan pada flowmeter '.$flowmeter->flowmeter_name.' yang berada dilokasi '.$flowmeter->flowmeterLocation->flowmeter_location];
                
                }
                
            } 
            else 
            {
                return ['success'=>false,'message'=>'Anda tidak memiliki akses untuk melakukan pengamatan pada flowmeter '.$flowmeter->flowmeter_name.' yang berada dilokasi '.$flowmeter->flowmeterLocation->flowmeter_location];
            }
            
            
        } 
        else 
        {
            return $cekAkses;
        }
    }

    public function getMonitoringData($flowmeter_id)
    {

        $cekMonitoringCategory  = explode('/', \Request::getRequestUri());
        switch ($cekMonitoringCategory[2]) 
        {
            case 'monitoring-air':
                $page_access = 'emon.monitoring.water';
            break;
            case 'monitoring-gas':
                $page_access = 'emon.monitoring.gas';
            break;

            case 'monitoring-listrik':
                $page_access = 'emon.monitoring.gas';
            break;
        }
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),$page_access);
        if ($cekAkses['success'] == true) 
        {
            $flowmeter_id                   = $this->decrypt($flowmeter_id);
            $flowmeter                      = Flowmeter::find($flowmeter_id);
            $today                          = Carbon::today()->toDateString();
            $energyMonitoringToday          = $flowmeter->energyMonitorings->where('monitoring_date',$today)->first();
            // $energyMonitoringToday->success = true;
            return ['success'=>true,'data'=>$energyMonitoringToday];  
        } 
        else 
        {
            return $cekAkses;
        }
        
    }

    public function updateDataMonitoringEnergy(Request $request)
    {

        $cekMonitoringCategory  = explode('/', \Request::getRequestUri());
        switch ($cekMonitoringCategory[2]) 
        {
            case 'monitoring-air':
                $page_access = 'emon.monitoring.water';
            break;
            case 'monitoring-gas':
                $page_access = 'emon.monitoring.gas';
            break;

            case 'monitoring-listrik':
                $page_access = 'emon.monitoring.gas';
            break;
        }
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),$page_access);
        if ($cekAkses['success']) 
        {
            $flowmeter_id               = $this->decrypt($request->flowmeter_id);
            $monitoring_value           = $request->monitoring_value;
            $flowmeter                  = Flowmeter::find($flowmeter_id);
            $today                      = Carbon::today()->toDateString();
            $yesterday                  = Carbon::yesterday()->toDateString();

            $yesterdayMonitoringValue    = $flowmeter->energyMonitorings->where('monitoring_date',$yesterday)->first();
            $flowmeterLocationPermissions   = $flowmeter->flowmeterLocation->flowmeterLocationPermissions->where('user_id',Auth::user()->id)->first();
            
            if (!is_null($flowmeterLocationPermissions)) 
            {
                if ($flowmeterLocationPermissions->is_allow == '1') 
                {
                    if (!is_null($yesterdayMonitoringValue)) 
                    {
                        $lastMonitoringValue    = $yesterdayMonitoringValue->monitoring_value;
                    } 
                    else 
                    {
                        if (count($flowmeter->energyMonitorings) > 0) 
                        {
                            $lastMonitoringBeforeToday      = $flowmeter->energyMonitorings->where('monitoring_date','<',$today)->sortBy('monitoring_date');
                            if (!is_null($lastMonitoringBeforeToday) && count($lastMonitoringBeforeToday) > 0)
                            {
                                $reset          = end($checkLastMonitoringBefore);
                                $last_key       = key($reset);
                                $lastMonitoringValue    = $lastMonitoringBeforeToday[$last_key]->monitoring_value;
                            }
                            else
                            {
                                $energyMonitoringToday      = $flowmeter->energyMonitorings->where('monitoring_date',$today)->first();
                                $energyMonitoringToday->monitoring_value = $monitoring_value;
                                $energyMonitoringToday->save();
                                $refreshEnergyUsage         = $this->refreshEnergyUsage($flowmeter->flowmeterWorkcenter->flowmeterCategory->flowmeterWorkcenters);
                                return ['success' => true,'message'=>'Data monitoring flowmeter berhasil diubah'];
                            }
                        }
                        else
                        {
                            $energyMonitoringToday      = $flowmeter->energyMonitorings->where('monitoring_date',$today)->first();
                            $energyMonitoringToday->monitoring_value = $monitoring_value;
                            $energyMonitoringToday->save();
                            $refreshEnergyUsage         = $this->refreshEnergyUsage($flowmeter->flowmeterWorkcenter->flowmeterCategory->flowmeterWorkcenters);
                            return ['success' => true,'message'=>'Data monitoring flowmeter berhasil diubah'];        
                        }
                    }
                    if ($request->monitoring_value < $lastMonitoringValue) 
                    {
                        return ['success'=>false,'message'=>'Angka meteran hari ini tidak boleh kurang dari hari kemarin'];
                    }
                    else
                    {
                        $energyMonitoringToday      = $flowmeter->energyMonitorings->where('monitoring_date',$today)->first();
                        $energyMonitoringToday->monitoring_value = $monitoring_value;
                        $energyMonitoringToday->save();
                        $refreshEnergyUsage         = $this->refreshEnergyUsage($flowmeter->flowmeterWorkcenter->flowmeterCategory->flowmeterWorkcenters);
                        return ['success' => true,'message'=>'Data monitoring flowmeter berhasil diubah'];
                    }
                }
                else if($flowmeterLocationPermissions->is_allow == '0')
                {
                    return ['success'=>false,'message'=>'Anda tidak memiliki akses untuk melakukan pengamatan pada flowmeter '.$flowmeter->flowmeter_name.' yang berada dilokasi '.$flowmeter->flowmeterLocation->flowmeter_location];
                }
            }
            else
            {
                return ['success'=>false,'message'=>'Anda tidak memiliki akses untuk melakukan pengamatan pada flowmeter '.$flowmeter->flowmeter_name.' yang berada dilokasi '.$flowmeter->flowmeterLocation->flowmeter_location];
            }
            

        } 
        else 
        {
            return $cekAkses;
        }
        
    }

    public function inputMonitoringEnergyByHistory(Request $request)
    {
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'emon.monitoring.histories');
        if ($cekAkses['success'] ) 
        {
            $flowmeter_id                   = $this->decrypt($request->flowmeter_id);
            $monitoring_value               = $request->monitoring_value;
            $monitoring_date                = $this->decrypt($request->monitoring_date);
            $flowmeter                      = Flowmeter::find($flowmeter_id);
            /* check location permission access*/
            $flowmeterLocationPermissions   = $flowmeter->flowmeterLocation->flowmeterLocationPermissions->where('user_id',Auth::user()->id)->first();
            if (!is_null($flowmeterLocationPermissions)) 
            {
                if ($flowmeterLocationPermissions->is_allow == '1') 
                {
                    switch ($flowmeter->recording_schedule) 
                    {
                        case '0':
                            /* pengamatan dilakukan perhari */
                            $energyMonitoring  = $flowmeter->energyMonitorings->where('monitoring_date',$monitoring_date)->first();
                            $checkLastMonitoringBefore      = $flowmeter->energyMonitorings->where('monitoring_date','<',$monitoring_date)->sortBy('monitoring_date');
                            
                            if (is_null($checkLastMonitoringBefore) || count($checkLastMonitoringBefore) < 1) 
                            {
                                /* ini jika pengamatan yang dilakukan adalah pengamatan pertama atay sebelumnya sama sekali belum ada pengamatan */
                                $last_monitoring_value_before      = 'No Value';
                                $last_monitoring_date_before       = 'No Date';
                            }
                            else 
                            {
                                $reset          = end($checkLastMonitoringBefore);
                                $last_key       = key($reset);
                                $last_monitoring_value_before       = $checkLastMonitoringBefore[$last_key]->monitoring_value;
                                $last_monitoring_date_before        = $checkLastMonitoringBefore[$last_key]->monitoring_date;
                            }
                            
                            $checkLastMonitoringAfter       = $flowmeter->energyMonitorings->where('monitoring_date','>',$monitoring_date)->sortBy('monitoring_date');
                            if (is_null($checkLastMonitoringAfter) || count($checkLastMonitoringAfter) < 1) 
                            {
                                /* ini jika pengamatan yang dilakukan adalah pengamatan pertama atay sebelumnya sama sekali belum ada pengamatan */
                                $last_monitoring_value_after      = 'No Value';
                            }
                            else 
                            {
                                $reset              = reset($checkLastMonitoringAfter);
                                $first_key          = key($reset);
                                $last_monitoring_value_after        = $checkLastMonitoringAfter[$first_key]->monitoring_value;
                                $last_monitoring_date_after         = $checkLastMonitoringAfter[count($checkLastMonitoringAfter)-1]->monitoring_date;

                            }
                            if (is_null($energyMonitoring))     
                            {
                                if ($last_monitoring_value_before !== 'No Value') 
                                {   
                                    if ($monitoring_value >=  $last_monitoring_value_before) 
                                    {
                                        if ($last_monitoring_value_after !== 'No Value') 
                                        {
                                            if ($monitoring_value > $last_monitoring_value_after) 
                                            {
                                                return ['success'=> false, 'message'=> 'Nilai pengamatan pada tanggal '.$monitoring_date.' lebih besar dari nilai pengamatan dihari setelahnya pada tanggal '.$last_monitoring_date_after.' harap menyesuaikan nilai pengamatan dari tanggal pengamatan paling akhir'];
                                            } 
                                            else 
                                            {
                                                /* ini kalo energy monitoring dihari itu masih kosong atau no value */
                                                $energyMonitoring   = EnergyMonitoring::create([
                                                    'flowmeter_id'      => $flowmeter->id,
                                                    'monitoring_value'  => $monitoring_value,
                                                    'monitoring_date'   => $monitoring_date
                                                ]);
                                                $refreshEnergyUsage                     = $this->refreshEnergyUsageByHistoryEdit($flowmeter->flowmeterWorkcenter->flowmeterCategory->flowmeterWorkcenters,$monitoring_date);
                                                return ['success'=>true,'message'=>'Data monitoring pada tanggal '.$monitoring_date.' berhasil diinput'];     
                                            }
                                        } 
                                        else 
                                        {
                                            $energyMonitoring   = EnergyMonitoring::create([
                                                'flowmeter_id'      => $flowmeter->id,
                                                'monitoring_value'  => $monitoring_value,
                                                'monitoring_date'   => $monitoring_date
                                            ]);
                                            $refreshEnergyUsage                     = $this->refreshEnergyUsageByHistoryEdit($flowmeter->flowmeterWorkcenter->flowmeterCategory->flowmeterWorkcenters,$monitoring_date);
                                            return ['success'=>true,'message'=>'Data monitoring pada tanggal '.$monitoring_date.' berhasil diinput'];    
                                        }
                                    } 
                                    else 
                                    {
                                        return ['success'=> false, 'message'=> 'Nilai pengamatan pada tanggal '.$monitoring_date.' lebih kecil dari nilai pengamatan terakhir pada tanggal '.$last_monitoring_date_before];
                                    }
                                } 
                                else 
                                {
                                    if ($last_monitoring_value_after !== 'No Value') 
                                    {
                                        if ($monitoring_value > $last_monitoring_value_after) 
                                        {
                                            return ['success'=> false, 'message'=> 'Nilai pengamatan pada tanggal '.$monitoring_date.' lebih besar dari nilai pengamatan dihari setelahnya pada tanggal '.$last_monitoring_date_after.' harap menyesuaikan nilai pengamatan dari tanggal pengamatan paling akhir'];
                                        } 
                                        else 
                                        {
                                            /* ini kalo energy monitoring dihari itu masih kosong atau no value */
                                            $energyMonitoring   = EnergyMonitoring::create([
                                                'flowmeter_id'      => $flowmeter->id,
                                                'monitoring_value'  => $monitoring_value,
                                                'monitoring_date'   => $monitoring_date
                                            ]);  
                                            $refreshEnergyUsage                     = $this->refreshEnergyUsageByHistoryEdit($flowmeter->flowmeterWorkcenter->flowmeterCategory->flowmeterWorkcenters,$monitoring_date);
                                            return ['success'=>true,'message'=>'Data monitoring pada tanggal '.$monitoring_date.' berhasil diinput'];     
                                        }
                                    } 
                                    else 
                                    {
                                        $energyMonitoring   = EnergyMonitoring::create([
                                            'flowmeter_id'      => $flowmeter->id,
                                            'monitoring_value'  => $monitoring_value,
                                            'monitoring_date'   => $monitoring_date
                                        ]); 
                                        $refreshEnergyUsage                     = $this->refreshEnergyUsageByHistoryEdit($flowmeter->flowmeterWorkcenter->flowmeterCategory->flowmeterWorkcenters,$monitoring_date);
                                        return ['success'=>true,'message'=>'Data monitoring pada tanggal '.$monitoring_date.' berhasil diinput'];    
                                    }
                                }
                                
                               
                            } 
                            else 
                            {
                                if ($last_monitoring_value_before !== 'No Value') 
                                {   
                                    if ($monitoring_value >=  $last_monitoring_value_before) 
                                    {
                                        if ($last_monitoring_value_after !== 'No Value') 
                                        {
                                            if ($monitoring_value < $last_monitoring_value_after) 
                                            {
                                                return ['success'=> false, 'message'=> 'Nilai pengamatan pada tanggal '.$monitoring_date.' lebih besar dari nilai pengamatan dihari setelahnya pada tanggal '.$last_monitoring_date_after.' harap menyesuaikan nilai pengamatan dari tanggal pengamatan paling akhir'];
                                            } 
                                            else 
                                            {
                                                /* ini kalo energy monitoring dihari itu masih kosong atau no value */
                                                $energyMonitoring->monitoring_value     = $monitoring_value;
                                                $energyMonitoring->save();
                                                $refreshEnergyUsage                     = $this->refreshEnergyUsageByHistoryEdit($flowmeter->flowmeterWorkcenter->flowmeterCategory->flowmeterWorkcenters,$monitoring_date);
                                                return ['success'=>true,'message'=>'Data monitoring pada tanggal '.$monitoring_date.' berhasil diubah.'];     
                                            }
                                        } 
                                        else 
                                        {
                                            $energyMonitoring->monitoring_value     = $monitoring_value;
                                            $energyMonitoring->save();
                                            $refreshEnergyUsage                     = $this->refreshEnergyUsageByHistoryEdit($flowmeter->flowmeterWorkcenter->flowmeterCategory->flowmeterWorkcenters,$monitoring_date);
                                            return ['success'=>true,'message'=>'Data monitoring pada tanggal '.$monitoring_date.' berhasil diubah.'];    
                                        }
                                    } 
                                    else 
                                    {
                                        return ['success'=> false, 'message'=> 'Nilai pengamatan pada tanggal '.$monitoring_date.' lebih kecil dari nilai pengamatan terakhir pada tanggal '.$last_monitoring_date_before];
                                    }
                                } 
                                else 
                                {
                                    if ($last_monitoring_value_after !== 'No Value') 
                                    {
                                        if ($monitoring_value > $last_monitoring_value_after) 
                                        {
                                            return ['success'=> false, 'message'=> 'Nilai pengamatan pada tanggal '.$monitoring_date.' lebih besar dari nilai pengamatan dihari setelahnya pada tanggal '.$last_monitoring_date_after.' harap menyesuaikan nilai pengamatan dari tanggal pengamatan paling akhir'];
                                        } 
                                        else 
                                        {
                                            /* ini kalo energy monitoring dihari itu masih kosong atau no value */
                                            $energyMonitoring->monitoring_value     = $monitoring_value;
                                            $energyMonitoring->save();
                                            $refreshEnergyUsage                     = $this->refreshEnergyUsageByHistoryEdit($flowmeter->flowmeterWorkcenter->flowmeterCategory->flowmeterWorkcenters,$monitoring_date);
                                            return ['success'=>true,'message'=>'Data monitoring pada tanggal '.$monitoring_date.' berhasil diubah.'];     
                                        }
                                    } 
                                    else 
                                    {
                                        $energyMonitoring->monitoring_value     = $monitoring_value;
                                        $energyMonitoring->save();
                                        $refreshEnergyUsage                     = $this->refreshEnergyUsageByHistoryEdit($flowmeter->flowmeterWorkcenter->flowmeterCategory->flowmeterWorkcenters,$monitoring_date);
                                        return ['success'=>true,'message'=>'Data monitoring pada tanggal '.$monitoring_date.' berhasil diubah.'];    
                                    }
                                }
                            }
                            
                        break;
                    }
                } 
                else 
                {
                    return ['success'=>false,'message'=>'Anda tidak memilki hak akses untuk melakukan monitoring pada flowmeter '.$flowmeter->flowmeter_name.' yang berada di lokasi '.$flowmeter->flowmeterLocation->flowmeter_location.'. Harap hubungi administrator untuk membukakan akses pada lokasi pengamatan'];                
                }
                
            } 
            else 
            {
                return ['success'=>false,'message'=>'Anda tidak memilki hak akses untuk melakukan monitoring pada flowmeter '.$flowmeter->flowmeter_name.' yang berada di lokasi '.$flowmeter->flowmeterLocation->flowmeter_location.'. Harap hubungi administrator untuk membukakan akses pada lokasi pengamatan'];
            }
            
        } 
        else 
        {
            return $cekAkses;
        }
        

    }
    public function refreshMonitoringHistoriesTable($monitoring_month,$flowmeter_category,$flowmeter_workcenter)
    {
        $month          = date('m',strtotime($monitoring_month));
        $years          = date('Y',strtotime($monitoring_month));
        $getAllDay 		= $this->daysInMonth($month,$years);
		$flowmeterLocationPermissions	= FlowmeterLocationPermissions::where('user_id',Auth::user()->id)->where('is_allow','1')->get();
        $flowmeter_return 				= array();
        $kategori_flowmeter 			= array();
        $flowmeter_workcenter_active    = $flowmeter_workcenter;
        $flowmeter_workcenters           = 'null';
        foreach ($flowmeterLocationPermissions as $flowmeterLocationPermission) 
        {
            if ($flowmeter_category == 'null' || is_null($flowmeter_category)) 
            {
                foreach ($flowmeterLocationPermission->flowmeterLocation->flowmeters as $flowmeter) 
                {
                    $monitoringHistory 	= array();
                    foreach ($getAllDay as $day) 
                    {
                        $monitoring 						= array();
                        $monitoring_value 	= $flowmeter->energyMonitorings->where('monitoring_date',$day)->first();
                        if (is_null($monitoring_value))
                        {
                            $monitoring['monitoring_value'] = 'No Value';
                        } 
                        else
                        {
                            $monitoring['monitoring_value'] = $monitoring_value->monitoring_value;
                        }
                        $monitoring['monitoring_date']	= $day;
                        $monitoring['enkripsi_monitoring_date'] = $this->encrypt($day);
                        array_push($monitoringHistory,$monitoring);
                    }
                    $flowmeter->monitoringHistories 	= $monitoringHistory; 	
                    $flowmeter                              = $this->encryptId($flowmeter);
                    $workcenter                             = $flowmeter->flowmeterWorkcenter;
                    array_push($flowmeter_return,$flowmeter);
                }
            } 
            else 
            {
                if ($flowmeter_workcenter == 'null' || is_null($flowmeter_workcenter)) 
                {
                    foreach ($flowmeterLocationPermission->flowmeterLocation->flowmeters as $flowmeter) 
                    {
                        if ($flowmeter->flowmeterWorkcenter->flowmeterCategory->id  == $flowmeter_category) 
                        {
                            $monitoringHistory 	= array();
                            foreach ($getAllDay as $day) 
                            {
                                $monitoring 						= array();
                                $monitoring_value 	= $flowmeter->energyMonitorings->where('monitoring_date',$day)->first();
                                if (is_null($monitoring_value))
                                {
                                    $monitoring['monitoring_value'] = 'No Value';
                                } 
                                else
                                {
                                    $monitoring['monitoring_value'] = $monitoring_value->monitoring_value;
                                }
                                $monitoring['monitoring_date']	= $day;
                                $monitoring['enkripsi_monitoring_date'] = $this->encrypt($day);

                                array_push($monitoringHistory,$monitoring);
                            }
                            $flowmeter->monitoringHistories 	    = $monitoringHistory; 	
                            $flowmeter                              = $this->encryptId($flowmeter);
                            $workcenter                             = $flowmeter->flowmeterWorkcenter;
                            array_push($flowmeter_return,$flowmeter);
                        }
                    }
                } 
                else 
                {
                    foreach ($flowmeterLocationPermission->flowmeterLocation->flowmeters as $flowmeter) 
                    {
                        if ($flowmeter->flowmeterWorkcenter->flowmeterCategory->id  == $flowmeter_category && $flowmeter->flowmeterWorkcenter->id == $flowmeter_workcenter) 
                        {
                            $monitoringHistory 	= array();
                            foreach ($getAllDay as $day) 
                            {
                                $monitoring 						= array();
                                $monitoring_value 	= $flowmeter->energyMonitorings->where('monitoring_date',$day)->first();
                                if (is_null($monitoring_value))
                                {
                                    $monitoring['monitoring_value'] = 'No Value';
                                } 
                                else
                                {
                                    $monitoring['monitoring_value'] = $monitoring_value->monitoring_value;
                                }
                                $monitoring['monitoring_date']	= $day;
                                $monitoring['enkripsi_monitoring_date'] = $this->encrypt($day);
                                array_push($monitoringHistory,$monitoring);
                            }
                            $flowmeter->monitoringHistories 	= $monitoringHistory; 	
                            $flowmeter                              = $this->encryptId($flowmeter);
                            $workcenter                             = $flowmeter->flowmeterWorkcenter;
                            array_push($flowmeter_return,$flowmeter);
                        }
                    }
                }
                
            }
               
        }
        if ( $flowmeter_category !== 'null' && $flowmeter_workcenter == 'null' ) 
        {
            $getWorkCenter          = FlowmeterWorkcenter::where('flowmeter_category_id',$flowmeter_category)->get();
            $flowmeter_workcenters   = $getWorkCenter;
        }
        return ['success'=>true,'tabel'=>$flowmeter_return,'flowmeter_workcenter_active'=>$flowmeter_workcenter_active,'flowmeter_workcenters'=>$flowmeter_workcenters];
    }
}
