<?php

namespace Database\Factories;

use App\Models\Commentary;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CommentaryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Commentary::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $creationDate = $this->faker->dateTimeInInterval('-1 days', '-1 minutes');
        return [
            'user_id' => rand(9,18),
            'post_id' => rand(150, 166),
            'parent_id' => null,
            'content' => $this->faker->sentence(rand(8,12)),
            'created_at' => $creationDate,
            'updated_at' => $creationDate,
        ];
    }
}
