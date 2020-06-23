<?php

namespace App\Models\Transaction\Rollie;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;

class AnalisaMikro extends ResourceModel
{
    protected $connection   = 'transaction_data';
    protected $table        = 'analisa_mikro';
    protected $guarded      = ['id'];
    public static function boot()
    {
        parent::boot();
    }
    
    public function cppHead()
    {
        return $this->belongsTo('App\Models\Transaction\Rollie\CppHead', 'cpp_head_id', 'id');
    }
    
    public function analisaMikroDetails()
    {
        return $this->hasMany('App\Models\Transaction\Rollie\AnalisaMikroDetail', 'analisa_mikro_id', 'id');
    }

    public function analisaMikroResamplings()
    {
        return $this->hasMany('App\Models\Transaction\Rollie\AnalisaMikroResampling', 'analisa_mikro_id', 'id');
    }
}
