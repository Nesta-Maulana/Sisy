<?php

namespace App\Models\energy_monitoring;

use Illuminate\Database\Eloquent\Model;

class Workcenter extends Model
{
    protected $connection = 'energy_monitoring';
    protected $table = "workcenter";
    protected $guarded = ['id'];
	public function kategoriMeteran()
	{
		return $this->belongsTo('App\Models\energy_monitoring\KategoriMeteran', 'kategori_id');
	}
	public function Bagian()
	{
		return $this->hasMany('App\Models\energy_monitoring\Bagian', 'workcenter_id','id');
	}
}
