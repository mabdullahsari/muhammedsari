<?php declare(strict_types=1);

namespace PreservingData;

use Symfony\Component\Process\Process;

final readonly class Git
{
    private const AUTHOR = 'Muhammed Sari <24608797+mabdullahsari@users.noreply.github.com>';

    public function __construct(private string $root) {}

    public function add(string $path): self
    {
        $this->run("add {$path}");

        return $this;
    }

    public function commit(string $message): self
    {
        $author = self::AUTHOR;

        $this->run("commit -m '{$message}'", "--author '{$author}'");

        return $this;
    }

    public function push(): self
    {
        $this->run('push');

        return $this;
    }

    public function status(string $directory = ''): string
    {
        return $this->run('status', trim("{$directory} -s"));
    }

    private function run(string $command, string $arguments = ''): string
    {
        $command = trim("git {$command} {$arguments}");

        return Process::fromShellCommandline($command, $this->root)->mustRun()->getOutput();
    }
}
