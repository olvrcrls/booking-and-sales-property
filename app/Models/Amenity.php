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
    protected $casts = [
    	'amenity_active' => 'boolean',
    ];
}
