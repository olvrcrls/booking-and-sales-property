<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnlineServiceFee extends Model
{
    protected $table = 'online_service_fees';
    protected $primaryKey = 'online_service_fee_id';
    protected $guarded = [];
    public $dates = [
    	'created_date', 'modified_date'
    ];
    protected $casts = [
    	'online_service_fee_active' => 'boolean',
    ];
}
