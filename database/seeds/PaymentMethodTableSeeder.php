<?php

use Illuminate\Database\Seeder;

class PaymentMethodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\PaymentMethod::insert([
        		[
        			'payment_method_name' => 'Bank Deposit',
        			'created_by' => 1
        		],
        		[
        			'payment_method_name' => 'Credit Card Method / Paypal',
        			'created_by' => 1
        		],
        		[
        			'payment_method_name' => 'Cash',
        			'created_by' => 1
        		]
        	]);
    }
}
