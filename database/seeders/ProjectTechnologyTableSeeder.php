<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Technology;

class ProjectTechnologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // generato 300 relazioni project/technology random
        for ($i = 0; $i < 300; $i++) {
            // estraggo il project random
            $project = Project::inRandomOrder()->first();

            // estraggo l'ID della technology random
            $technology_id = Technology::inRandomOrder()->first()->id;

            // aggiungo relazione tra project e technologies
            $project->technologies()->attach($technology_id);
        }
    }
}
