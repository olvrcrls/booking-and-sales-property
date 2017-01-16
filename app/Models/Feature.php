<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table = 'features';
    protected $primaryKey = 'feature_id';
    protected $guarded = [];
    public $timestamps = false;
    public $dates = [
        'created_date', 'modified_date'
    ];
    protected $casts = [
        'feature_active' => 'boolean',
    ];
    public function getTable()
    {
    	return $this->table;
    } // static function to return the table name of the Model.

    public function properties()
    {
        return $this->belongsTo(\App\Models\Property::class, 'feature_property_id', 'property_id');
    }

    public function feature_types()
    {
        return $this->belongsTo(\App\Models\FeatureType::class, 'feature_type_id', 'feature_type_id');
    }
}
