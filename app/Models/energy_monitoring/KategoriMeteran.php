<?php

namespace App\Models\energy_monitoring;

use Illuminate\Database\Eloquent\Model;

class KategoriMeteran extends Model
{
    //
    protected $connection = 'energy_monitoring';
    protected $table = "kategori";
    protected $guarded = ['id'];
	public function Workcenter()
	{
		return $this->hasMany('App\Models\energy_monitoring\Workcenter', 'kategori_id','id');
	}
}
