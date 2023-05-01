<?php declare(strict_types=1);

namespace Contacting;

use Illuminate\Database\Eloquent\Factories\Factory;

final class ContactFormFactory extends Factory
{
    protected $model = ContactForm::class;

    public function definition(): array
    {
        return [
            'email' => $this->faker->email(),
            'ip_address' => $this->faker->ipv4(),
            'message' => $this->faker->text(),
            'name' => $this->faker->name(),
        ];
    }
}
