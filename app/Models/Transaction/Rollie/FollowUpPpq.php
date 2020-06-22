<?php

namespace App\Models\Transaction\Rollie;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;

class FollowUpPpq extends ResourceModel
{
    protected $connection   = 'transaction_data';
    protected $table        = 'follow_up_ppqs';
    protected $guarded      = ['id'];
    public static function boot()
    {
        parent::boot();
    }
    public function ppq()
    {
        return $this->belongsTo('App\Models\Transaction\Rollie\Ppq', 'ppq_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\Models\Master\User', 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\Master\User', 'updated_by', 'id');
    }

    public function correctiveActions()
    {
        return $this->hasMany('App\Models\Transaction\Rollie\CorrectiveAction', 'follow_up_ppq_id', 'id');
    }

    public function preventiveActions()
    {
        return $this->hasMany('App\Models\Transaction\Rollie\PreventiveAction', 'follow_up_ppq_id', 'id');
    }
}
