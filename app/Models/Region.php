<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';
    protected $primaryKey = 'region_id';
    protected $guarded = [];
    public $timestamps = false;
    public $dates = [
        'created_date', 'modified_date'
    ];
    protected $casts = [
        'region_active' => 'boolean',
    ];
    public function getTable()
    {
    	return $this->table;
    } // static function to return the table name of the Model.

    public function cities()
    {
    	return $this->hasMany(\App\Models\City::class, 'cities');
    }

}
