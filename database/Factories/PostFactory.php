<?php declare(strict_types=1);

namespace Database\Factories;

use Core\Blogging\Models\Author;
use Core\Blogging\Models\Post;
use Core\Blogging\PostState;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
final class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'author_id' => Author::MUHAMMED,
            'slug' => static fn (array $attributes) => Str::slug($attributes['title']),
            'title' => $this->faker->words(5, true),
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

    public function published(): self
    {
        return $this->hasBody()->hasSummary()->state([
            'published_at' => '1970-01-01 00:00:00',
            'state' => PostState::Published,
        ]);
    }
}
