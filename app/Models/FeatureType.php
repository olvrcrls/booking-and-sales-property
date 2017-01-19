<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureType extends Model
{
    protected $table = 'feature_types';
    protected $primaryKey = 'feature_type_id';
    protected $guarded = [];
    public $timestamps = false;
    public $dates = [
        'created_date', 'modified_date'
    ];
    protected $casts = [
        'feature_type_active' => 'boolean',
    ];
    public function getTable()
    {
    	return $this->table;
    } // static function to return the table name of the Model.

    public function features()
    {
        return $this->hasMany(\App\Models\Feature::class, 'feature_id');
    }

    /**
     * Get the feature type's name.
     *
     * @param  string  $value
     * @return string
     */
    public function getFeatureTypeNameAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * Set the feature type's name.
     *
     * @param  string  $value
     * @return string
     */
    public function setFeatureTypeNameAtttribue($value)
    {
        $this->attributes['feature_type_name'] = ucwords($value);
    }
}
