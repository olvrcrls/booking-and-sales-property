<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$now = date('Y-m-d h:i:s');
        $this->call(UserTypeTableSeeder::class);
        $this->call(UserTableSeeder::class); // comment this on production.
        $this->call(RegionTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(PropertyStatusTableSeeder::class);
        $this->call(PropertyTypeTableSeeder::class);
        $this->call(FeatureTypeTableSeeder::class);
        App\AuditTrail::insert([
        		'audit_action' => "Pre-populated data to the database. Pre-populated at $now",
        		'audit_user' => 1
        	]);
    }
}
