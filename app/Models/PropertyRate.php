<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyRate extends Model
{
	// This model is for the properties that are only for rent
	// and available for booking reservations.

    protected $table = 'property_rates';
    protected $primaryKey = 'property_rate_id';
    protected $guarded = [];
    public $dates = [
    	'created_date', 'modified_date'
    ];
    public $casts = [
    	'property_rate_active' => 'boolean',
    ];
}
