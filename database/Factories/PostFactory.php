<?php declare(strict_types=1);

namespace Database\Factories;

use Domain\Blogging\Models\Post;
use Domain\Blogging\PostState;
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
            'author_id' => UserFactory::new(),
            'slug' => static fn (array $attributes) => Str::slug($attributes['title']),
            'title' => $this->faker->words(5, true),
            'body' => $this->faker->text(300),
            'summary' => $this->faker->text(100),
            'state' => PostState::Draft,
        ];
    }
}
