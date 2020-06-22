<?php

namespace App\Models\energy_monitoring;

use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    protected $connection = 'energy_monitoring';
    protected $table = "bagian";
    protected $guarded = ['id'];
	public function Pengamatan()
	{
		return $this->hasMany('App\Models\energy_monitoring\Pengamatan', 'bagian_id','id');
	}
    public function Penggunaan()
    {
        return $this->hasMany('App\Models\energy_monitoring\Penggunaan', 'bagian_id','id');
    }
    public function Workcenter()
    {
        return $this->belongsTo('App\Models\energy_monitoring\Workcenter', 'workcenter_id');
    }

    public function Satuan()
    {
        return $this->belongsTo('App\Models\energy_monitoring\Satuan', 'satuan_id');
    }
/*    public function workcenter(){
        return $this->belongsTo('App\Models\utilityOnline\Workcenter', 'workcenter_id');
    }
    public function satuan(){
        return $this->belongsTo('App\Models\utilityOnline\Satuan', 'satuan_id');
    }
    public function kategoriPencatatan(){
        return $this->belongsTo('App\Models\utilityOnline\KategoriPencatatan', 'kategori_pencatatan_id');
    }
    public function rasioHead(){
        return $this->hasOne('App\Models\utilityOnline\RasioHead', 'bagian_id');
    }*/
}
