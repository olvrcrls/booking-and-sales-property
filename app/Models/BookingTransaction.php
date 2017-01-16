<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingTransaction extends Model
{
    protected $table = 'booking_transactions';
    protected $primaryKey = 'booking_transaction_id';
    protected $guarded = [];
    public $dates = [
    	'created_date', 'modified_date'
    ];
    protected $casts = [
    	'booking_transaction_cancelled' => 'boolean',
    ];
}
