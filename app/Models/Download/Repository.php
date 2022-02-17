<?php

namespace App\Models\Download;

use App\Services\FileStorage;
use Illuminate\Support\Facades\File;

class Repository
{
    protected readonly string $directory;

    public function __construct(protected FileStorage $storage)
    {
        $this->directory = "download/";
    }

    public static function instance(): self
    {
        return new self(FileStorage::instance());
    }

    public function getPath(string $fileName): string
    {
        return $this->storage->buildPath($this->directory . $fileName);
    }
}
