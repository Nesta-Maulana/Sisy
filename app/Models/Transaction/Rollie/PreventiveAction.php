<?php

namespace App\Models\Transaction\Rollie;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResourceModel;

class PreventiveAction extends ResourceModel
{
    protected $connection   = 'transaction_data';
    protected $table        = 'preventive_actions';
    protected $guarded      = ['id'];
    public static function boot()
    {
        parent::boot();
    }
    public function createdBy()
    {
        return $this->belongsTo('App\Models\Master\User', 'created_by', 'id');
    }

    public function followUpRkj()
    {
        return $this->belongsTo('App\Models\Transaction\Rollie\FollowUpRkj', 'follow_up_rkj_id', 'id');
    }
    public function updatedBy()
    {
        return $this->belongsTo('App\Models\Master\User', 'updated_by', 'id');
    }
}
