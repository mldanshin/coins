<?php

namespace App\Services;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage as StorageFacade;

final class FileStorage
{
    public function __construct(
        private readonly Filesystem $disk
    ) {
    }

    public static function instance(): self
    {
        return new self(StorageFacade::disk("public"));
    }

    public function createDirectory(string $pathPart): void
    {
        $path = $this->buildPath($pathPart);
        File::makeDirectory($path, force: true);
    }

    public function createDirectoryBase(): void
    {
        if (!File::exists($this->disk->path(""))) {
            File::makeDirectory($this->disk->path(""));
        }
    }

    public function exists(string $pathPart): bool
    {
        $path = $this->buildPath($pathPart);
        if (File::exists($path)) {
            return true;
        } else {
            return false;
        }
    }

    public function putFile(string $targetPathPart, UploadedFile $file): string
    {
        $path = $this->disk->putFile($targetPathPart, $file);
        $fileName = File::basename($path);
        return $fileName;
    }

    public function move(string $pathPartFrom, string $pathPartTo): void
    {
        File::move(
            $this->buildPath($pathPartFrom),
            $this->buildPath($pathPartTo)
        );
    }

    public function delete(string $pathPart): void
    {
        $path = $this->buildPath($pathPart);
        File::delete($path);
    }

    public function deleteDirectory(string $directory): void
    {
        $path = $this->buildPath($directory);
        File::deleteDirectory($path);
    }

    public function buildPath(string $pathPart): string
    {
        return $this->disk->path($pathPart);
    }
}
