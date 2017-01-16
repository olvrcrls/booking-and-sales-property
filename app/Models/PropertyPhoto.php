<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyPhoto extends Model
{
    protected $table = 'property_photos';
    protected $primaryKey = 'property_photo_id';
    protected $guarded = [];
    public $timestamps = false;
    public $dates = [
        'created_date', 'modified_date'
    ];
    protected $casts = [
        'property_photo_active' => 'boolean',
    ];
    public function getTable()
    {
    	return $this->table;
    } // static function to return the table name of the Model.

    public function properties()
    {
        return $this->belongsTo(\App\Models\Property::class, 'property_photo_property_id', 'property_id');
    }

}
