<?php

namespace App\Models\Master\Emon;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;

class FlowmeterLocationPermissions extends ResourceModel
{
	protected $connection 	= 'master_data';
	protected $guarded 		= ['id'];
    protected $table 		= 'flowmeter_location_permissions';
    public static function boot()
    {
        parent::boot();
    }
    public function flowmeterLocation()
    {
    	return $this->belongsTo('App\Models\Master\Emon\FlowmeterLocation', 'flowmeter_location_id', 'id');
    }
}
