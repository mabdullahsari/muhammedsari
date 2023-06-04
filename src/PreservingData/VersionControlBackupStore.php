<?php declare(strict_types=1);

namespace PreservingData;

use Illuminate\Filesystem\Filesystem;

final readonly class VersionControlBackupStore implements BackupStore
{
    private const FILENAME = 'backup.sql';
    private const MESSAGE = '[Backup] Preserve data';

    private Git $git;

    public function __construct(private string $destination, private Filesystem $files)
    {
        $this->git = new Git($this->destination);
    }

    public function preserve(string $data): void
    {
        $this->files->put($this->destination . DIRECTORY_SEPARATOR . self::FILENAME, $data);

        if ($this->git->status($this->destination)) {
            $this->git->add(self::FILENAME)->commit(self::MESSAGE)->push();
        }
    }
}
