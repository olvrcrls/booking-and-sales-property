<?php

use Illuminate\Database\Seeder;

class AmenityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Amenity::insert([
        		[
        			'amenity_name' => "Wi-Fi Ready",
        			'amenity_description' => "It has a wireless fidelity connection.",
        			'created_by' => 1
         		],
         		[
        			'amenity_name' => "No Smoking Area",
        			'amenity_description' => "An area prohibited for smoking.",
        			'created_by' => 1
         		],
         		[
        			'amenity_name' => "No Pets Allowed",
                    'amenity_description' => "No Description.",
        			'created_by' => 1
         		],
         		[
        			'amenity_name' => "Fully Furnished",
        			'amenity_description' => "Complete in furnitures.",
        			'created_by' => 1
         		],
        	]);
    }
}
