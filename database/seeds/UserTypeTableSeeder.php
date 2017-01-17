<?php

use Illuminate\Database\Seeder;

class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\UserType::insert([
        		[
        			'user_type_name' => 'Administrator'
        		],
        		[
        			'user_type_name' => 'Staff'
        		],
                [
                    'user_type_name' => 'Web Master'
                ],
                [
                    'user_type_name' => 'Client'
                ]
        	]);
    }
}
