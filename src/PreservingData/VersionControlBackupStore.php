<?php declare(strict_types=1);

namespace PreservingData;

use Illuminate\Filesystem\Filesystem;

final readonly class VersionControlBackupStore implements BackupStore
{
    private const FILENAME = 'backup.sql';
    private const MESSAGE = '[Backup] Preserve data';

    private Git $git;

    private Filesystem $fs;

    public function __construct(private string $destination)
    {
        $this->fs = new Filesystem();
        $this->git = new Git($destination);
    }

    public function preserve(string $data): void
    {
        $this->fs->put($this->destination . DIRECTORY_SEPARATOR . self::FILENAME, $data);

        if ($this->git->status($this->destination) === null) {
            return;
        }

        $this->git->add(path: self::FILENAME)->commit(message: self::MESSAGE)->pull(rebase: true)->push();
    }
}
