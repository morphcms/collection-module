<?php

namespace Modules\Collection\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CollectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Collection\Models\Collection::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words,
            'slug' => $this->faker->slug,
        ];
    }
}

