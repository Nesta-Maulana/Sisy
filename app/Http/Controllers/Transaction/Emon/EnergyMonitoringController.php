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

use App\Models\Transaction\Emon\EnergyMonitoring;

use \Carbon\Carbon;

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
            if ($flowmeter->flowmeterLocation->flowmeterLocationPermission->is_allow = '1') 
            {
                switch ($flowmeter->recording_schedule) 
                {
                    case '0':
                        /* harian */
                        if ( is_null($flowmeter->energyMonitorings->where('monitoring_date',$today)->first() )) 
                        {
                            $yesterdayMonitoringValue    = $flowmeter->energyMonitorings->where('monitoring_date',$yesterday)->first();
                            if (is_null($yesterdayMonitoringValue)) 
                            {
                                $lastMonitoringValue    = $yesterdayMonitoringValue->monitoring_value;
                            } 
                            else 
                            {
                                if (count($flowmeter->energyMonitorings) > 0) 
                                {
                                    $lastMonitoringValue = $flowmeter->energyMonitorings[count($flowmeter->energyMonitorings)-1]->monitoring_value;
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
            $yesterday      = Carbon::yesterday()->toDateString();

            $yesterdayMonitoringValue    = $flowmeter->energyMonitorings->where('monitoring_date',$yesterday)->first();
            if (is_null($yesterdayMonitoringValue)) 
            {
                $lastMonitoringValue    = $yesterdayMonitoringValue->monitoring_value;
            } 
            else 
            {
                if (count($flowmeter->energyMonitorings) > 0) 
                {
                    $lastMonitoringValue = $flowmeter->energyMonitorings[count($flowmeter->energyMonitorings)-1]->monitoring_value;
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
        else 
        {
            return $cekAkses;
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction\Emon\EnergyMonitoring  $energyMonitoring
     * @return \Illuminate\Http\Response
     */
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction\Emon\EnergyMonitoring  $energyMonitoring
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction\Emon\EnergyMonitoring  $energyMonitoring
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction\Emon\EnergyMonitoring  $energyMonitoring
     * @return \Illuminate\Http\Response
     */
    
}
