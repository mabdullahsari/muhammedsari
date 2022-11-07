<?php declare(strict_types=1);

namespace Database\Factories;

use Core\Showcasing\Repository;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Repository>
 */
final class RepositoryFactory extends Factory
{
    protected $model = Repository::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->slug(3),
            'description' => $this->faker->text(),
            'url' => $this->faker->url(),
        ];
    }
}
