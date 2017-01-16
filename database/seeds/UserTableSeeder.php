<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::insert([
                [
        		'user_name' => 'Web Administrator',
        		'password' => bcrypt('__password'),
        		'user_user_type_id' => 3, //web master
        		'user_email' => 'oli@fandomcafe.com'
                ],
                [
                'user_name' => 'Administrator',
                'password' => bcrypt('__password'),
                'user_user_type_id' => 1, //administrator
                'user_email' => 'admin@fandomcafe.com'
                ],
                [
                'user_name' => 'Staff',
                'password' => bcrypt('__password'),
                'user_user_type_id' => 2, //staff
                'user_email' => 'staff@fandomcafe.com'
                ],
        	]);
    }
}
