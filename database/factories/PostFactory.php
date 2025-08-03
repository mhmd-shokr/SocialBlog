<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title=fake()->sentence();
        return [
            'image'=>fake()->imageUrl(),
            'title'=> $title,
            'slug'=>str::slug( $title),
            'content'=>fake()->paragraph(50),
            'category_id'=>Category::inRandomOrder()->first()->id,
            'user_id'=>1,
            'published_at'=>fake()->optional()->dateTime(),
        ];
    }
}
