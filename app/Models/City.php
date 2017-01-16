<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $primaryKey = 'city_id';
    protected $guarded = [];
    public $timestamps = false;
    protected $casts = [
        'city_active' => 'boolean',
    ];
    public $dates = [
        'created_date', 'modified_date'
    ];

    public function getRouteKeyName()
    {
        return 'url_slug';
    } // returning the route key name of the Model.

    public function getTable()
    {
    	return $this->table;
    } // static function to return the table name of the Model.

    public function properties()
    {
    	return $this->hasMany(\App\Models\Property::class, 'property_id');
    }

    public function regions()
    {
        return $this->belongsTo(\App\Models\Region::class, 'city_region_id', 'region_id');
    }
}
