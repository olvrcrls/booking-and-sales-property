<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $primaryKey = 'client_id';
    protected $guarded = [];
    public $timestamps = false;
    public $dates = [
        'created_date'
    ];
    public function getTable()
    {
    	return $this->table;
    } // static function to return the table name of the Model.

    public function getClientFirstnameAttribute($value)
    {
        return ucwords($value);
    }

    public function setClientFirstnameAttribute($value)
    {
        $this->attributes['client_firstname'] = ucwords($value);
    }

    public function getClientLastnameAttribute($value)
    {
        return ucwords($value);
    }

    public function setClientLastnameAttribute($value)
    {
        $this->attributes['client_lastname'] = ucwords($value);
    }

    public function getClientMiddlenameAttribute($value)
    {
        return ucwords($value);
    }

    public function setClientMiddlenameAttribute($value)
    {
        $this->attributes['client_middlename'] = ucwords($value);
    }
}
