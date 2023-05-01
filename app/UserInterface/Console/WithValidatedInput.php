<?php declare(strict_types=1);

namespace App\UserInterface\Console;

use Illuminate\Support\Facades\Validator;

/**
 * @mixin \Illuminate\Console\Command
 */
trait WithValidatedInput
{
    private function input(string $message, array $rules, string $name): string
    {
        /** @var string $input */
        $input = $this->ask($message);

        $validator = Validator::make([$name => $input], [$name => $rules]);

        if ($validator->passes()) {
            return $input;
        }

        foreach ($validator->errors()->all() as $error) {
            $this->error("⛔️ {$error}");
        }

        return $this->input($message, $rules, $name);
    }
}
