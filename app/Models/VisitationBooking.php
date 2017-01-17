<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitationBooking extends Model
{
    protected $table = 'visitation_bookings';
    protected $primaryKey = 'visitation_booking_id';
    protected $guarded = [];
    public $dates = [
    	'created_date', 'updated_date'
    ];
    protected $casts = [
    	'visitation_booking_cancelled' => 'boolean',
    ];

     public function clients()
    {
    	return $this->belongsTo(App\Models\Client::class, 'visitation_booking_client_id', 'visitation_booking_client_id');
    }

    public function properties()
    {
    	return $this->belongsTo(App\Models\Property::class, 'visitation_booking_property_id', 'visitation_booking_property_id');
    }
}
