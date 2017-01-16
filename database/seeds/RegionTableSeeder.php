<?php

use Illuminate\Database\Seeder;

class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Region::insert([
        		[
        			'region_name' => 'National Capital Region (NCR)',
                    'created_by' => 1
        		],
        		[
        			'region_name' => 'Region I (Ilocos Region)',
                    'created_by' => 1
        		],
        		[
        			'region_name' => 'Cordillera Administrative Region (CAR)',
                    'created_by' => 1
        		],
        		[
        			'region_name' => 'Region II (Cagayan Valley)',
                    'created_by' => 1
        		],
        		[
        			'region_name' => 'Region III (Central Luzon)',
                    'created_by' => 1
        		],
        		[
        			'region_name' => 'Region IV-A (CALABARZON)',
                    'created_by' => 1
        		],
        		[
        			'region_name' => 'Region IV-B (MIMAROPA)',
                    'created_by' => 1
        		],
        		[
        			'region_name' => 'Region V (Bicol Region)',
                    'created_by' => 1
        		],
        		[
        			'region_name' => 'Region VI (Western Visayas Region)',
                    'created_by' => 1
        		],
        		[
        			'region_name' => 'Region VII (Central Visayas Region)',
                    'created_by' => 1
        		],
        		[
        			'region_name' => 'Region XVIII (Negros Island Region)',
                    'created_by' => 1
        		],
        		[
        			'region_name' => 'Region VIII (Eastern Visayas Region)',
                    'created_by' => 1
        		],
        		[
        			'region_name' => 'Region IX (Zamboanga Peninsula Region)',
                    'created_by' => 1
        		],
        		[
        			'region_name' => 'Region X (Northern Mindanao Region)',
                    'created_by' => 1
        		],
        		[
        			'region_name' => 'Region XI (Davao Region)',
                    'created_by' => 1
        		],
        		[
        			'region_name' => 'Region XII (SOCCSKSARGEN Region)',
                    'created_by' => 1
        		],
        		[
        			'region_name' => 'Region XIII (Caraga Region)',
                    'created_by' => 1
        		],
        		[
        			'region_name' => 'ARMM (Autonomous Region in Muslim Mindanao Region)',
                    'created_by' => 1
        		],
        	]);
    }
}
