<?php

namespace App\Models\Transaction\Rollie;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;

class AnalisaMikroResampling extends ResourceModel
{
    protected $connection   = 'transaction_data';
    protected $table        = 'analisa_mikro_resampling';
    protected $guarded      = ['id'];
    public static function boot()
    {
        parent::boot();
    }

    public function cppHead()
    {
        return $this->belongsTo('App\Models\Transaction\Rollie\CppHead', 'cpp_head_id', 'id');
    }
    public function analisaMikroUtama()
    {
        return $this->belongsTo('App\Models\Transaction\Rollie\AnalisaMikro', 'analisa_mikro_id', 'id');
    }
}
