<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'user_email', 'password', 'user_user_type_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'user_active' => 'boolean',
    ];

    public function getTable()
    {
       return $this->table;
    }

    public function types()
    {
        return $this->belongsTo(\App\Models\UserType::class, 'user_user_type_id', 'user_type_id');
    }
}