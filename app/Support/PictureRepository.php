<?php

namespace App\Support;

use App\Models\Eloquent\Coin;
use App\Models\Picture\RepositoryBase;
use App\Services\FileStorage;
use Illuminate\Support\Facades\File;

final class PictureRepository extends RepositoryBase
{
    public function __construct(FileStorage $storage)
    {
        parent::__construct($storage);
    }

    public function seed(): void
    {
        File::cleanDirectory($this->storage->buildPath("image"));
        File::copyDirectory(storage_path("app/demo"), $this->storage->buildPath(""));

        $coins = Coin::pluck("id");
        foreach ($coins as $coin) {
            $this->createDirectoryIfNotExists($this->directoryInside . $coin);
        }
    }

    public function clearTemp(): bool
    {
        $files = File::allFiles(
            $this->storage->buildPath($this->directoryInsideTemp)
        );
        $timeCurrent = time();
        $fileStorageTime = config("app.picture_storage_time");

        foreach ($files as $file) {
            $time = File::lastModified($file);
            if (($timeCurrent - $time) > $fileStorageTime) {
                $res = File::delete($file);
                if ($res === false) {
                    return false;
                }
            }
        }

        return true;
    }

    public function createDirectoriesIfNotExists(): void
    {
        if (!$this->storage->exists($this->directoryInside)) {
            $this->storage->createDirectory($this->directoryInside);
        }

        if (!$this->storage->exists($this->directoryInsideTemp)) {
            $this->storage->createDirectory($this->directoryInsideTemp);
        }
    }

    private function createDirectoryIfNotExists(string $pathPart): void
    {
        if (!$this->storage->exists($pathPart)) {
            $this->storage->createDirectory($pathPart);
        }
    }
}
