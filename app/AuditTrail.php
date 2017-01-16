<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    protected $table = 'audit_trails';
    protected $primaryKey = 'audit_id';
    protected $guarded = [];
    public $timestamps = false;
    public $dates = [
        'audit_datetime'
    ];

    public function getTable()
    {
    	return $this->table;
    } // static function to return the table name of the Model.

    public function users()
    {
    	return $this->belongsTo(User::class, 'audit_user', 'user_id');
    }

}
