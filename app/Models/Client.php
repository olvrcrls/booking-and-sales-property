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

}
