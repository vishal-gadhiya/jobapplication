<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            [
                'slug' => 'ahmedabad',
                'name' => 'Ahmedabad, Gujarat'
            ],
            [
                'slug' => 'rajkot',
                'name' => 'Rajkot, Gujarat'
            ],
            [
                'slug' => 'bengaluru',
                'name' => 'Bengaluru, Karnataka'
            ],
            [
                'slug' => 'mumbai',
                'name' => 'Mumbai, Maharashtra'
            ]

        ];

        foreach ($cities as $city) {

            City::firstOrCreate(

                ['slug' => $city['slug']],

                ['name' => $city['name']]
            );
            
        };
    }
}
