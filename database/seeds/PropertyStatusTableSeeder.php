<?php

use Illuminate\Database\Seeder;

class PropertyStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\PropertyStatus::insert([
        		[
        			'property_status_name' => 'Available',
        			'property_status_description' => 'The property/unit is available for occupants.',
        			'created_by' => 1
        		],
        		[
        			'property_status_name' => 'Not Available',
        			'property_status_description' => 'The property/unit is not available for occupants.',
        			'created_by' => 1
        		],
        		[
        			'property_status_name' => 'Reserved',
        			'property_status_description' => 'The property/unit is already reserved and will be occupied by occupants.',
        			'created_by' => 1
        		],
        		[
        			'property_status_name' => 'Sold',
        			'property_status_description' => 'The property/unit is already sold for new owners.',
        			'created_by' => 1
        		],
        		[
        			'property_status_name' => 'Under Renovation',
        			'property_status_description' => 'The property/unit is under renovation.',
        			'created_by' => 1
        		],
        	]);
    }
}
