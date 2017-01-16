<?php

use Illuminate\Database\Seeder;

class PropertyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\PropertyType::insert([
        		[
        			'property_type_name' => 'Rental',
        			'created_by' => 1
        		],
        		[
        			'property_type_name' => 'Commercial',
        			'created_by' => 1
        		],
        		[
        			'property_type_name' => 'Private',
        			'created_by' => 1
        		],
                [
                    'property_type_name' => 'Residential',
                    'created_by' => 1
                ],
                [
                    'property_type_name' => 'Hotel',
                    'created_by' => 1
                ],
                [
                    'property_type_name' => 'Inn',
                    'created_by' => 1
                ],
        	]);
    }
}
