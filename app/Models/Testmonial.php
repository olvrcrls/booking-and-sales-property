<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testmonial extends Model
{
    protected $table = 'testimonials';
    protected $primaryKey = 'testimonial_id';
    protected $guarded = [];
    public $dates = [
    	'created_date', 'modified_date'
    ];
    protected $casts = [
    	'testimonial_active' => 'boolean',
    ];

    public function users()
    {
    	return $this->belongsTo(App\User::class, 'testimonial_user', 'testimonial_user');
    }
}
