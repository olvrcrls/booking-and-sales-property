<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyRentRate extends Model
{
    protected $table = 'property_rent_rates';
    protected $primaryKey = 'property_rent_rate_id';
    protected $guarded = [];
    public $dates = [
    	'created_date', 'modified_date'
    ];
    protected $casts = [
    	'property_rent_rate_active' => 'boolean',
    ];
    public function getTable()
    {
    	return $this->table;
    } // static function to return the table name of the Model.
}
