<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyStatus extends Model
{
    protected $table = 'property_statuses';
    protected $primaryKey = 'property_status_id';
    protected $guarded = [];
    public $timestamps = false;
    public $dates = [
        'created_date', 'modified_date'
    ];
    protected $casts = [
        'property_status_active' => 'boolean',
    ];
    public function getTable()
    {
    	return $this->table;
    } // static function to return the table name of the Model.

    public function properties()
    {
    	return $this->hasMany(\App\Models\Property::class, 'properties');
    }
}
