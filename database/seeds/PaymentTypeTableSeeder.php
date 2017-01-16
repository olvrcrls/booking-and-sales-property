<?php

use Illuminate\Database\Seeder;

class PaymentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\PaymentType::insert([
        		[
        			'payment_type_name' => 'Bank Deposit',
        			'created_by' => 1
        		],
        		[
        			'payment_type_name' => 'Credit Card Method / Paypal',
        			'created_by' => 1
        		],
        		[
        			'payment_type_name' => 'Cash',
        			'created_by' => 1
        		]
        	]);
    }
}
