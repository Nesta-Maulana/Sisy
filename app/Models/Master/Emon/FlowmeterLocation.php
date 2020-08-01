<?php

namespace App\Models\Master\Emon;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;

class FlowmeterLocation extends ResourceModel
{
	protected $connection 	= 'master_data';
	protected $guarded 		= ['id'];
    protected $table 		= 'flowmeter_locations';
    public static function boot()
    {
        parent::boot();
    }
    public function flowmeters()
    {
        return $this->hasMany('App\Models\Master\Emon\Flowmeter', 'flowmeter_location_id', 'id');
    }
    public function flowmeterCategory()
    {
    	return $this->belongsTo('App\Models\Master\Emon\FlowmeterCategory', 'flowmeter_category_id', 'id');
    }
    public function flowmeterLocationPermissions()
    {
        return $this->hasMany('App\Models\Master\Emon\FlowmeterLocationPermissions', 'flowmeter_location_id', 'id');
    }
}
