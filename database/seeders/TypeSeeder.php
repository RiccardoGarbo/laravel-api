<?php

namespace Database\Seeders;

use App\Models\Type;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $labels = ['FrontEnd', 'BackEnd', 'FullStack'];

        foreach ($labels as $label) {
            $type = new Type();
            $type->label = $label;
            $type->slug = Str::slug($label);
            $type->color = $faker->hexColor();
            $type->save();
        }
    }
}
