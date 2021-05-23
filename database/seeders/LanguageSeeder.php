<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            [
                'slug' => 'english',
                'name' => 'English'
            ],
            [
                'slug' => 'hindi',
                'name' => 'Hindi'
            ],
            [
                'slug' => 'gujrati',
                'name' => 'Gujrati'
            ]
        ];

        foreach ($languages as $language) {

            Language::firstOrCreate(

                ['slug' => $language['slug']],

                ['name' => $language['name']]
            );
            
        }

    }
}
