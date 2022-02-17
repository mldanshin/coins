<?php

namespace App\Support;

use App\Models\Download\Repository as BaseRepository;
use App\Services\FileStorage;

final class DownloadRepository extends BaseRepository
{
    public function __construct(FileStorage $storage)
    {
        parent::__construct($storage);
    }

    public function createDirectory(): void
    {
        if (!$this->storage->exists($this->directory)) {
            $this->storage->createDirectory($this->directory);
        }
    }
}
