<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        $types = Type::all();
        $ids = $types->pluck('id')->all();

        for ($i = 0; $i < 10; $i++) {

            $project = new Project();

            $project->title = $faker->sentence(6);
            $project->slug = Str::slug($project->title);
            $project->description = $faker->text(50);
            $project->type_id = $faker->optional()->randomElement($ids);
            $project->link = 'https://github.com/MattiaBologna/laravel-dc-comics.git';

            $project->save();
        }
    }
}
