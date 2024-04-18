<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->text(20);
        Storage::makeDirectory('project_images');
        return [
            'title' => $title,
            'content' => fake()->paragraphs(3, true),
            'slug' => Str::slug($title),
            'image' => Storage::putFile('project_images', fake()->image(null, 300, 300))
        ];
    }
}
