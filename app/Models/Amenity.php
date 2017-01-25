<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    protected $table = 'amenities';
    protected $primaryKey = 'amenity_id';
    protected $guarded = [];
    public $dates = [
    	'created_date', 'modified_date'
    ];
    public $timestamps = false;
    protected $casts = [
    	'amenity_active' => 'boolean',
    ];

    public function properties()
    {
    	$this->belongsTo(\App\Models\PropertyAmenity::class, 'property_amenity_amenity_id');
    }

    public function getAmenityNameAttribute($value)
    {
        return ucwords($value);
    }

    public function setAmenityNameAttribute($value)
    {
        $this->attributes['amenity_name'] = ucwords($value);
    }
}
