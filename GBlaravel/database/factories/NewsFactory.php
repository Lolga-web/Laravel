<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(rand(30,50)),
            'text' => $this->faker->realText(rand(1500,2000)),
            'isPrivate' => false,
            'image' => null,
            'category_id' => rand(1,2)
        ];
    }
}
