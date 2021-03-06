<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertySalesTransaction extends Model
{
    protected $table = 'property_sales_transactions';
    protected $primaryKey = 'property_sales_transaction_id';
    public $dates = [
    	'created_at'
    ];

    public function clients()
    {
    	return $this->belongsTo(App\Models\Client::class, 'property_sales_transaction_client', 'property_sales_transaction_client');
    }
}
