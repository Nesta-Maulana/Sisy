<?php

namespace App\Models\Master\Emon;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;

class FlowmeterWorkcenter extends ResourceModel
{
    protected $connection 	= 'master_data';
	protected $guarded 		= ['id'];
    protected $table 		= 'flowmeter_workcenters';
    public static function boot()
    {
        parent::boot();
    }
    public function flowmeterCategory()
    {
    	return $this->belongsTo('App\Models\Master\Emon\FlowmeterCategory', 'flowmeter_category_id', 'id');
    }
    public function flowmeterUsages()
    {
        return $this->hasMany('App\Models\Master\Emon\FlowmeterUsage', 'flowmeter_workcenter_id', 'id');
    }
}
