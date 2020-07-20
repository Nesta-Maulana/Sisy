<?php

namespace App\Models\Master\Emon;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;
class FlowmeterUsage extends ResourceModel
{
	protected $connection 	= 'master_data';
	protected $guarded 		= ['id'];
    protected $table 		= 'flowmeter_usages';
    public static function boot()
    {
        parent::boot();
    }

    public function flowmeterWorkcenter()
    {
    	return $this->belongsTo('App\Models\Master\Emon\FlowmeterWorkcenter', 'flowmeter_workcenter_id', 'id');
    }

    public function flowmeterUnit()
    {
    	return $this->belongsTo('App\Models\Master\Emon\FlowmeterUnit', 'flowmeter_unit_id', 'id');
    }

    public function flowmeterLocation()
    {
    	return $this->belongsTo('App\Models\Master\Emon\FlowmeterLocation', 'flowmeter_location_id', 'id');
    }

    public function flowmeterFormula()
    {
        return $this->belongsTo('App\Models\Master\Emon\FlowmeterFormula', 'flowmeter_formula_id', 'id');
    }

    public function energyUsages()
    {
        return $this->hasMany('App\Models\Transaction\Emon\EnergyUsage', 'flowmeter_usage_id', 'id');
    }
}
