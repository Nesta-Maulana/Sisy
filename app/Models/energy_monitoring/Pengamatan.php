<?php

namespace App\Models\energy_monitoring;

use Illuminate\Database\Eloquent\Model;

class Pengamatan extends Model
{
    protected $connection = 'energy_monitoring';
    protected $table = "pengamatan";
    protected $guarded = ['id'];
	public function Bagian()
	{
		return $this->belongsTo('App\Models\energy_monitoring\Bagian', 'bagian_id');
	}
}
