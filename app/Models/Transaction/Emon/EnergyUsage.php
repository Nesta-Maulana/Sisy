<?php

namespace App\Models\Transaction\Emon;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;

class EnergyUsage extends ResourceModel
{
	protected $connection 	= 'transaction_data';
	protected $guarded 		= ['id'];
	protected $table 		= 'energy_usages';
	public function flowmeterUsage()
	{
		return $this->belongsTo('App\Models\Master\Emon\FlowmeterUsage', 'flowmeter_usage_id', 'id');
	}
}
