<?php declare(strict_types=1);

namespace Blogging;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @method PostFactory hasTags(int $amount)
 */
final class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'author_id' => 1,
            'slug' => static fn (array $attributes) => Str::slug($attributes['title']),
            'title' => $this->faker->unique()->words(5, true),
            'body' => '',
            'summary' => '',
            'state' => PostState::Draft,
        ];
    }

    public function hasBody(): self
    {
        return $this->state(['body' => $this->faker->text(300)]);
    }

    public function hasSummary(): self
    {
        return $this->state(['summary' => $this->faker->text(100)]);
    }

    public function publishable(): self
    {
        return $this->hasTags(1)->hasBody()->hasSummary();
    }

    public function published(): self
    {
        return $this->publishable()->state([
            'published_at' => '1970-01-01 00:00:00',
            'state' => PostState::Published,
        ]);
    }
}
