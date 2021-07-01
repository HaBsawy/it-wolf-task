<?php

namespace Database\Factories;

use App\Models\Blogger;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'blogger_id' => Blogger::all()->random(),
            'title'     => $this->faker->sentence(4),
            'topic'     => $this->faker->randomElement(['Science', 'Sports', 'Movies', 'Music', 'Literature']),
            'content'   => $this->faker->text(2000),
            'thumbnail' => url('uploads/thumbnail.jpg'),
            'cover'     => url('uploads/cover.jpg'),
        ];
    }
}
