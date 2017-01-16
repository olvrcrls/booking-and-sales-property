<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingReservation extends Model
{
    protected $table = 'booking_reservations';
    protected $primaryKey = 'booking_reservation_id';
    protected $guarded = [];
    public $dates = [
    	'created_date', 'modified_date'
    ];
    protected $casts = [
    	'booking_reservation_cancelled' => 'boolean',
    ];
}
