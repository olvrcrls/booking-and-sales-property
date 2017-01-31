<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyAmenity extends Model
{
    protected $table = 'property_amenities';
    protected $primaryKey = 'property_amenity_id';
    protected $guarded = [];
    public $dates = [
    	'created_date', 'modified_date'
    ];
    protected $casts = [
    	'property_amenity_active' => 'boolean',
    ];

    public function amenities()
    {
    	return $this->belongsTo(\App\Models\Amenity::class, 'property_amenity_amenity_id', 'amenity_id');
    }

    public function properties()
    {
    	return $this->belongsTo(\App\Models\Property::class, 'property_amenity_property_id', 'property_id');
    }
}
