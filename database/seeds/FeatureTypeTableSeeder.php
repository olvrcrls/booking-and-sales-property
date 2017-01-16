<?php

use Illuminate\Database\Seeder;

class FeatureTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\FeatureType::insert([
        		[
        			'feature_type_name' => 'Additional Information',
        			'feature_type_description' => 'Additional information about the property that will help in promoting/advertising.',
        			'created_by' => 1
        		],
        		[
        			'feature_type_name' => 'School',
        			'feature_type_description' => 'What schools or universities are near to the property so that it will help in promoting/advertising.',
        			'created_by' => 1
        		],
        		[
        			'feature_type_name' => 'Interior Design Information',
        			'feature_type_description' => 'Physical Design of the property internally.',
        			'created_by' => 1
        		],
        		[
        			'feature_type_name' => 'Malls / Groceries',
        			'feature_type_description' => 'Giving information of what are near malls and groceries to your unit.',
        			'created_by' => 1
        		],
        	]);
    }
}
