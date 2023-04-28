<?php declare(strict_types=1);

namespace Scheduling;

use Illuminate\Database\Eloquent\Factories\Factory;

final class PublicationFactory extends Factory
{
    protected $model = Publication::class;

    public function definition(): array
    {
        return [
            'post_id' => $this->faker->randomNumber(),
            'publish_at' => $this->faker->dateTime(),
        ];
    }
}
