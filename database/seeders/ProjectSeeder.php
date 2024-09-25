<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Type;
use Faker\Generator as Faker;
use App\Functions\Helper;


class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 50; $i++) {
            $new_project = new Project();
            $new_project->type_id = Type::inRandomOrder()->first()->id;
            $new_project->title = $faker->word();
            $new_project->description = $faker->paragraph(4);
            $new_project->client = $faker->company();
            $new_project->start_date = $faker->date();
            $new_project->end_date = $faker->optional()->date();
            $new_project->image = $faker->optional()->imageUrl(640, 480, 'business', true);
            $new_project->project_url = $faker->optional()->url();
            $new_project->slug = Helper::generateSlug($new_project->title, Project::class);
            $new_project->save();
        }
    }
}
