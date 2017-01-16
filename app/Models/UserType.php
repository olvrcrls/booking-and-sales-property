<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
   	protected $table = 'user_types';
    protected $primaryKey = 'user_type_id';
    protected $guarded = [];
    public $timestamps = false;
    public $dates = [
        'created_date', 'modified_date'
    ];
    protected $casts = [
        'user_type_active' => 'boolean',
    ];
    public function getTable()
    {
    	return $this->table;
    } // static function to return the table name of the Model.


    public function users()
    {
        return $this->hasMany(\App\User::class, 'user_id');
    }
}
