<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Type;
// importo il Faker e lo installo con composer require fakerphp/faker --dev
use Faker\Generator as Faker;
use App\Functions\Helper;


class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 60; $i++) {
            $new_project = new Project;
            // associo randomicamente un ID del type al project
            $new_project->type_id = Type::inRandomOrder()->first()->id;

            $new_project->title = $faker->word(9, true);
            $new_project->slug = Helper::createSlug($new_project->title, new Project());
            $new_project->link = $faker->url();
            $new_project->description = $faker->paragraph(8, true);
            $new_project->save();
        }
    }
}
