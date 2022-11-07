<?php

namespace Database\Factories;

use Core\Showcasing\Resource;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Resource>
 */
class ResourceFactory extends Factory
{
    protected $model = Resource::class;

    public function definition(): array
    {
        return [
            'category' => $this->faker->word(),
            'name' => $this->faker->words(5, true),
        ];
    }
}
