<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $createDate = $this->faker->dateTimeInInterval('-1 days', '-5 minutes');
        return [
            'title' => $this->faker->sentence(4),
            'content' => $this->faker->sentence(20),
            'user_id' => rand(9,18),
            'created_at' => $createDate,
            'updated_at' => $createDate,
        ];
    }
}
