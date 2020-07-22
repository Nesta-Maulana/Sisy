<?php

namespace App\Http\Controllers\Transaction\Emon;

use Illuminate\Http\Request;
use App\Http\Controllers\ResourceController;

use App\Models\Master\Emon\Flowmeter;
use App\Models\Master\Emon\FlowmeterUsage;
use App\Models\Master\Emon\FlowmeterFormula;
use App\Models\Master\Emon\FlowmeterCategory;
use App\Models\Master\Emon\FlowmeterWorkcenter;
use App\Models\Master\Emon\FlowmeterUnit;
use App\Models\Master\Emon\FlowmeterLocation;

use App\Models\Transaction\Emon\EnergyUsage;

use \Carbon\Carbon;

class EnergyUsageController extends ResourceController
{
    public function refreshEnergyUsage($flowmeterWorkcenters)
    {
        $today                      = Carbon::today()->toDateString();
        $yesterday                  = Carbon::yesterday()->toDateString();
        foreach ($flowmeterWorkcenters as $flowmeterWorkcenter) 
        {
            foreach ($flowmeterWorkcenter->flowmeterUsages as $flowmeterUsage) 
            {
                if ($flowmeterUsage->flowmeterFormula->formula_code == 'DEFAULT') 
                {
                    /* ika menggunakan rumus default maka akan mengabil nilai monitoring dari kode flowmeternya*/
                    $flowmeter_code             = $flowmeterUsage->flowmeter_code;
                    $flowmeter_code             = explode('FU_',$flowmeter_code); /* akan dihilangkan kode FU nya dan ambil kode belakangnya */
                    $flowmeter                  = Flowmeter::where('flowmeter_code',$flowmeter_code[1])->first();
                    if (!is_null($flowmeter->energyMonitorings)) 
                    {
                        $energyMonitoringToday      = $flowmeter->energyMonitorings->where('monitoring_date',$today)->first();
                        if (!is_null($energyMonitoringToday)) 
                        {
                            $energyMonitoringYesterday  = $flowmeter->energyMonitorings->where('monitoring_date',$yesterday)->first();
                            
                            if (!is_null($energyMonitoringYesterday)) 
                            {
                                $energyUsageToday       = $energyMonitoringToday->monitoring_value - $energyMonitoringYesterday->monitoring_value;
                            } 
                            else 
                            {
                                if (count($flowmeter->energyMonitorings) == 1) 
                                {
                                    /* ini  jika flowmeter tersebut baru pertama kali dilakukan monitoring maka nilai usage nya masih 0*/
                                    $energyUsageToday   = 0;
                                }
                                else
                                {
                                    /* jika pengamatan hari kemarin tidak ada maka akan diambil dari pengamatan terakhir sebelum hari ini */
                                    $energyUsageToday   = $energyMonitoringToday->monitoring_value - $flowmeter->energyMonitorings[count($flowmeter->energyMonitorings)-2]->monitoring_value;

                                }
                            }
                            $energyUsageTodayFromDB     = $flowmeterUsage->energyUsages->where('usage_date',$today)->first();
                            
                            if (is_null($energyUsageTodayFromDB)) 
                            {
                                $energyUsage        = EnergyUsage::create([
                                    'flowmeter_usage_id'        => $flowmeterUsage->id,
                                    'flowmeter_formula_id'      => $flowmeterUsage->flowmeter_formula_id,
                                    'usage_value'               => $energyUsageToday,
                                    'usage_date'                => $today
                                ]);
                            }
                            else
                            {
                                $energyUsageTodayFromDB->usage_value    = $energyUsageToday;
                                $energyUsageTodayFromDB->save();
                            }
                        }
                    }
                } 
                else 
                {
                    /*$a  = 10; $b  = 5; $d  = 10; $c  = '$a+$b'; echo $c; eval("\$c = (\"$a\"+\"$b\")*\"$d\";"); echo $c; die();*/
                    $formula_code   = json_decode($flowmeterUsage->flowmeterFormula->flowmeter_formula);
                    $rumus          = "\$rumus =";
                    foreach ($formula_code as $formula) 
                    {
                        if ($formula == '-' || $formula == '+' || $formula == '/' || $formula == 'x' || $formula == '(' || $formula == ')') 
                        {
                            if ($formula == 'x') 
                            {
                                $formula = "*";
                            }
                            $rumus.= $formula;

                        }
                        else 
                        {
                            if (substr($formula, 0,2) == 'FU') 
                            {
                                $flowmeterUsageRumus            = FlowmeterUsage::where('flowmeter_code',$formula)->first();
                                // dd($flowmeterUsageRumus->energyUsages->where('usage_date',$today)->first());
                                $energyUsageToday               = $flowmeterUsageRumus->energyUsages->where('usage_date',$today)->first();
                                if (is_null($energyUsageToday))
                                {
                                    $energyUsageToday  =0;
                                } 
                                else 
                                {
                                    $energyUsageToday  = $energyUsageToday->usage_value;
                                }
                                $rumus.=$energyUsageToday;
                            }
                        }
                    }
                    $rumus                  .= ';';
                    eval($rumus); // for usage value 
                    $energyUsageToday    = $flowmeterUsage->energyUsages->where('usage_date',$today)->first();
                    if (is_null($energyUsageToday)) 
                    {
                        $energyUsage        = EnergyUsage::create([
                            'flowmeter_usage_id'        => $flowmeterUsage->id,
                            'flowmeter_formula_id'      => $flowmeterUsage->flowmeter_formula_id,
                            'usage_value'               => $rumus,
                            'usage_date'                => $today
                        ]);
                    } 
                    else 
                    {
                        $energyUsageToday->usage_value  = $rumus;
                        $energyUsageToday->save();
                    }
                }
                
            }
        }
        // dd($flowmeterCategory);  
    }

    public function refreshEnergyUsageByHistoryEdit($flowmeterWorkcenters,$usage_date)
    {
        $today          = $usage_date;
        $yesterday      = date('Y-m-d', strtotime('-1 day', strtotime($today)));
        foreach ($flowmeterWorkcenters as $flowmeterWorkcenter) 
        {
            foreach ($flowmeterWorkcenter->flowmeterUsages as $flowmeterUsage) 
            {
                if ($flowmeterUsage->flowmeterFormula->formula_code == 'DEFAULT') 
                {
                    /* ika menggunakan rumus default maka akan mengabil nilai monitoring dari kode flowmeternya*/
                    $flowmeter_code             = $flowmeterUsage->flowmeter_code;
                    $flowmeter_code             = explode('FU_',$flowmeter_code); /* akan dihilangkan kode FU nya dan ambil kode belakangnya */
                    $flowmeter                  = Flowmeter::where('flowmeter_code',$flowmeter_code[1])->first();
                    if (!is_null($flowmeter->energyMonitorings)) 
                    {
                        $energyMonitoringToday      = $flowmeter->energyMonitorings->where('monitoring_date',$today)->first();
                        if (!is_null($energyMonitoringToday)) 
                        {
                            $energyMonitoringYesterday  = $flowmeter->energyMonitorings->where('monitoring_date',$yesterday)->first();
                            if (!is_null($energyMonitoringYesterday)) 
                            {
                                $energyUsageToday       = $energyMonitoringToday->monitoring_value - $energyMonitoringYesterday->monitoring_value;
                            } 
                            else 
                            {
                                if (count($flowmeter->energyMonitorings) == 1) 
                                {
                                    /* ini  jika flowmeter tersebut baru pertama kali dilakukan monitoring maka nilai usage nya masih 0*/
                                    $energyUsageToday   = 0;
                                }
                                else
                                {
                                    /* jika pengamatan hari kemarin tidak ada maka akan diambil dari pengamatan terakhir sebelum hari ini */
                                    $energyUsageBeforeToday   = $flowmeter->energyMonitorings->where('monitoring_date','<',$today);
                                    if (is_null($energyUsageBeforeToday) || count($energyUsageBeforeToday) < 1) 
                                    {
                                        $energyUsageToday = 0;
                                    } 
                                    else 
                                    {
                                        $energyUsageToday = $energyMonitoringToday->monitoring_value - $energyUsageBeforeToday[count($energyUsageBeforeToday)-1]->usage_value;
                                    }
                                    
                                }
                            }
                            $energyUsageTodayFromDB     = $flowmeterUsage->energyUsages->where('usage_date',$today)->first();
                            if (is_null($energyUsageTodayFromDB)) 
                            {
                                $energyUsage        = EnergyUsage::create([
                                    'flowmeter_usage_id'        => $flowmeterUsage->id,
                                    'flowmeter_formula_id'      => $flowmeterUsage->flowmeter_formula_id,
                                    'usage_value'               => $energyUsageToday,
                                    'usage_date'                => $today
                                ]);
                            }
                            else
                            {
                                $energyUsageTodayFromDB->usage_value    = $energyUsageToday;
                                $energyUsageTodayFromDB->save();
                            }
                            $this->changeEnergyAfterToday($flowmeterUsage,$today);
                        }
                    }
                } 
                else 
                {
                    dd('kesini');
                    /*$a  = 10; $b  = 5; $d  = 10; $c  = '$a+$b'; echo $c; eval("\$c = (\"$a\"+\"$b\")*\"$d\";"); echo $c; die();*/
                    $formula_code   = json_decode($flowmeterUsage->flowmeterFormula->flowmeter_formula);
                    $rumus          = "\$rumus =";
                    foreach ($formula_code as $formula) 
                    {
                        if ($formula == '-' || $formula == '+' || $formula == '/' || $formula == 'x' || $formula == '(' || $formula == ')') 
                        {
                            if ($formula == 'x') 
                            {
                                $formula = "*";
                            }
                            $rumus.= $formula;

                        }
                        else 
                        {
                            if (substr($formula, 0,2) == 'FU') 
                            {
                                $flowmeterUsageRumus            = FlowmeterUsage::where('flowmeter_code',$formula)->first();
                                $energyUsageToday               = $flowmeterUsageRumus->energyUsages->where('usage_date',$today)->first();
                                if (is_null($energyUsageToday))
                                {
                                    $energyUsageToday  =0;
                                } 
                                else 
                                {
                                    $energyUsageToday  = $energyUsageToday->usage_value;
                                }
                                $rumus.=$energyUsageToday;
                            }
                        }
                    }
                    $rumus                  .= ';';
                    eval($rumus); // for usage value 
                    $energyUsageToday    = $flowmeterUsage->energyUsages->where('usage_date',$today)->first();
                    if (is_null($energyUsageToday)) 
                    {
                        $energyUsage        = EnergyUsage::create([
                            'flowmeter_usage_id'        => $flowmeterUsage->id,
                            'flowmeter_formula_id'      => $flowmeterUsage->flowmeter_formula_id,
                            'usage_value'               => $rumus,
                            'usage_date'                => $today
                        ]);
                    } 
                    else 
                    {
                        $energyUsageToday->usage_value  = $rumus;
                        $energyUsageToday->save();
                    }
                }
                
            }
        }
    }

    public function changeEnergyAfterToday($flowmeterUsage,$change_date)
    {
        $real_date      = Carbon::today()->toDateString();
        $energyUsage    = $flowmeterUsage->energyUsages->where('usage_date','>=',$change_date)->where('usage_date','<=',$real_date)->sortBy('usage_date');
        dd($energyUsage);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction\Emon\EnergyUsage  $energyUsage
     * @return \Illuminate\Http\Response
     */
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction\Emon\EnergyUsage  $energyUsage
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction\Emon\EnergyUsage  $energyUsage
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction\Emon\EnergyUsage  $energyUsage
     * @return \Illuminate\Http\Response
     */

}
