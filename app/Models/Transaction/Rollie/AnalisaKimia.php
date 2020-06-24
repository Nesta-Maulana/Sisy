<?php

namespace App\Models\Transaction\Rollie;

use App\Models\ResourceModel;
use Illuminate\Database\Eloquent\Model;

class AnalisaKimia extends ResourceModel
{
    protected $connection   = 'transaction_data';
    protected $table        = 'analisa_kimias';
    protected $guarded      = ['id'];
    public static function boot()
    {
        parent::boot();
    }
    
    public function cppHead()
    {
        return $this->belongsTo('App\Models\Transaction\Rollie\CppHead', 'cpp_head_id', 'id');
    }
    public function cppHead()
    {
        return $this->belongsTo('App\Models\Transaction\Rollie\Ppq', 'ppq_id', 'id');
    }

}
