<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyReview extends Model
{
    protected $table = 'property_reviews';
    protected $primaryKey = 'property_review_id';
    protected $guarded = [];
    public $dates = [
    	'created_date', 'modified_date'
    ];
    protected $casts = [
    	'property_review_active' => 'boolean',
    ];
}
