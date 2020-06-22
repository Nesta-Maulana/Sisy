<?php

namespace App\Models\energy_monitoring;

use Illuminate\Database\Eloquent\Model;

class Penggunaan extends Model
{
    protected $connection = 'energy_monitoring';
    protected $table = "penggunaan";
    protected $guarded = ['id'];
	public function Bagian()
	{
		return $this->belongsTo('App\Models\energy_monitoring\Bagian', 'bagian_id');
	}
}
