<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = [
            [
                'slug' => 'php',
                'name' => 'PHP'
            ],
            [
                'slug' => 'laravel',
                'name' => 'Laravel'
            ],
            [
                'slug' => 'mysql',
                'name' => 'Mysql'
            ],
            [
                'slug' => 'jquery',
                'name' => 'Jquery'
            ],

        ];

        foreach ($skills as $skill) {

            Skill::firstOrCreate(

                ['slug' => $skill['slug']],

                ['name' => $skill['name']]
            );
            
        }

    }
}
