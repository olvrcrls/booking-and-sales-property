<?php

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\City::insert([
        		[
        			'city_name' => 'caloocan City',
        			'city_zip_code' => '1400',
        			'city_region_id' => 1,
        			'created_by' => 1,
                    'url_slug' => 'caloocan-city'
        		],
        		[
        			'city_name' => 'Las Piñas City',
        			'city_zip_code' => '1740',
        			'city_region_id' => 1,
        			'created_by' => 1,
                    'url_slug' => 'las-piñas-city'
        		],
        		[
        			'city_name' => 'Makati City',
        			'city_zip_code' => '1200',
        			'city_region_id' => 1,
        			'created_by' => 1,
                    'url_slug' => 'makati-city'
        		],
        		[
        			'city_name' => 'Malabon City',
        			'city_zip_code' => '1470',
        			'city_region_id' => 1,
        			'created_by' => 1,
                    'url_slug' => 'malabon-city'
        		],
        		[
        			'city_name' => 'Mandaluyong City',
        			'city_zip_code' => '1550',
        			'city_region_id' => 1,
        			'created_by' => 1,
                    'url_slug' => 'mandaluyong-city'
        		],
        		[
        			'city_name' => 'Manila City',
        			'city_zip_code' => '0900',
        			'city_region_id' => 1,
        			'created_by' => 1,
                    'url_slug' => 'manila-city'
        		],
        		[
        			'city_name' => 'Marikina City',
        			'city_zip_code' => '1800',
        			'city_region_id' => 1,
        			'created_by' => 1,
                    'url_slug' => 'marikina-city'
        		],
        		[
        			'city_name' => 'Muntinlupa City',
        			'city_zip_code' => '1771',
        			'city_region_id' => 1,
        			'created_by' => 1,
                    'url_slug' => 'muntinlupa-city'
        		],
        		[
        			'city_name' => 'Navotas City',
        			'city_zip_code' => '1409',
        			'city_region_id' => 1,
        			'created_by' => 1,
                    'url_slug' => 'navotas-city'
        		],
        		[
        			'city_name' => 'Parañaque City',
        			'city_zip_code' => '1700',
        			'city_region_id' => 1,
        			'created_by' => 1,
                    'url_slug' => 'parañaque-city'
        		],
        		[
        			'city_name' => 'Pasay City',
        			'city_zip_code' => '1300',
        			'city_region_id' => 1,
        			'created_by' => 1,
                    'url_slug' => 'pasay-city'
        		],
        		[
        			'city_name' => 'Pasig City',
        			'city_zip_code' => '1600',
        			'city_region_id' => 1,
        			'created_by' => 1,
                    'url_slug' => 'pasig-city'
        		],
                [
                    'city_name' => 'San Juan City',
                    'city_zip_code' => '1500',
                    'city_region_id' => 1,
                    'created_by' => 1,
                    'url_slug' => 'san-juan-city'
                ],
        		[
        			'city_name' => 'Taguig City',
        			'city_zip_code' => '1630',
        			'city_region_id' => 1,
        			'created_by' => 1,
                    'url_slug' => 'taguig-city'
        		],
        		[
        			'city_name' => 'Valenzuela City',
        			'city_zip_code' => '1440',
        			'city_region_id' => 1,
        			'created_by' => 1,
                    'url_slug' => 'valenzuela-city'
        		],
        	]);
    }
}
