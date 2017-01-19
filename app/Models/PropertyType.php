<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    protected $table = 'property_types';
    protected $primaryKey = 'property_type_id';
    protected $guarded = [];
    public $timestamps = false;
    public $dates = [
        'created_date', 'modified_date'
    ];
    protected $casts = [
        'property_type_active' => 'boolean',
    ];
    public function getTable()
    {
    	return $this->table;
    } // static function to return the table name of the Model.

    public function properties()
    {
    	return $this->hasMany(\App\Models\Property::class, 'properties');
    }

    public function getPropertyTypeNameAttribute($value)
    {
        return ucwords($value);
    }

    public function setPropertyTypeNameAttribute($value)
    {
        $this->attributes['property_type_name'] = ucwords($value);
    }
}
