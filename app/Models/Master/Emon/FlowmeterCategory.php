<?php

namespace App\Models\Master\Emon;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;

class FlowmeterCategory extends ResourceModel
{
    protected $connection 	= 'master_data';
	protected $guarded 		= ['id'];
    protected $table 		= 'flowmeter_categories';    
	public static function boot()
    {
        parent::boot();
    }
    public function flowmeterWorkcenters()
    {
    	return $this->hasMany('App\Models\Master\Emon\FlowmeterWorkcenter', 'flowmeter_category_id', 'id');
    }
    public function flowmeterLocations()
    {
        return $this->hasMany('App\Models\Master\Emon\flowmeterLocation', 'flowmeter_category_id', 'id');
    }
}
