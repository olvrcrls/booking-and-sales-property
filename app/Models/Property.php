<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'properties';
    protected $primaryKey = 'property_id';
    protected $guarded = [];
    public $timestamps = false;
    public $dates = [
        'created_date', 'modified_date'
    ];
    protected $casts = [
        'property_active' => 'boolean',
        'property_is_occupied' => 'boolean',
        'property_is_sold' => 'boolean',
        'property_is_negotiable' => 'boolean',
    ];
    public function getTable()
    {
    	return $this->table;
    } // static function to return the table name of the Model.

    public function getRouteKeyName()
    {
    	return 'url_slug';
    } // returning the route key name of the Model.

    public function getPropertyNameAttribute($value)
    {
        return ucwords($value);
    }

    public function setPropertyNameAttribute($value)
    {
        $this->attributes['property_name'] = ucwords($value);
    }

    public function cities()
    {
    	return $this->belongsTo(\App\Models\City::class, 'property_city_id', 'city_id');
    }

    public function statuses()
    {
    	return $this->belongsTo(\App\Models\PropertyStatus::class, 'property_status_id', 'property_status_id');
    }

    public function types()
    {
    	return $this->belongsTo(\App\Models\PropertyType::class, 'property_type_id', 'property_type_id');
    }

    public function features()
    {
        return $this->hasMany(\App\Models\Feature::class, 'feature_id');
    }

    public function photos()
    {
        return $this->hasMany(\App\Models\PropertyPhoto::class, 'property_photo_id');
    }

    public function amenities()
    {
        return $this->hasMany(\App\Models\PropertyAmenity::class, 'property_amenity_property_id');
    }

}
