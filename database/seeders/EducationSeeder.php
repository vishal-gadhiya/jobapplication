<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Education;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $educations = [
            [
                'slug' => 'ssc',
                'name' => 'SSC'
            ],
            [
                'slug' => 'hsc',
                'name' => 'HSC'
            ],
            [
                'slug' => 'graduation',
                'name' => 'Graduation'
            ],
            [
                'slug' => 'master_degree',
                'name' => 'Master Degree'
            ]

        ];

        foreach ($educations as $education) {

            Education::firstOrCreate(

                ['slug' => $education['slug']],

                ['name' => $education['name']]
            );
            
        };
    }
}
