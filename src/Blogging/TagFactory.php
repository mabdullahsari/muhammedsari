<?php declare(strict_types=1);

namespace Blogging;

use Illuminate\Database\Eloquent\Factories\Factory;

final class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'slug' => static fn (array $attributes) => strtolower($attributes['name']),
        ];
    }
}
