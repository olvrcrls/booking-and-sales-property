<?php

use Illuminate\Database\Seeder;

class OnlineServiceFeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\OnlineServiceFee::create([
        		'online_service_fee_rate' => 10,
        		'created_by' => 1
        	]);
    }
}
