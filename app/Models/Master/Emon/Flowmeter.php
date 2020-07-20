<?php

namespace App\Models\Master\Emon;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;
class Flowmeter extends ResourceModel
{
	protected $connection 	= 'master_data';
	protected $guarded 		= ['id'];
    protected $table 		= 'flowmeters';
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
    public function energyMonitorings()
    {
        return $this->hasMany('App\Models\Transaction\Emon\EnergyMonitoring', 'flowmeter_id', 'id');
    }
}
