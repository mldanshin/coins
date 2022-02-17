<?php

namespace App\Models\Download\Pictures;

use App\Models\Download\Repository;
use App\Models\Download\Pictures\Picture\Picture;
use Illuminate\Support\Collection;

final class CreatorZip extends CreatorBase
{
    private string $fileName = "coin_pictures.zip";
    private ?string $filePath = null;

    /**
     * @param Collection<Picture> $pictures
     */
    public function __construct(
        Repository $repository,
        Collection $pictures
    ) {
        parent::__construct($repository, $pictures);

        if ($pictures->count() > 0) {
            $this->initializePath();
            $this->writeFile();
        }
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    private function initializePath(): void
    {
        $this->filePath = $this->repository->getPath($this->fileName);
    }

    private function writeFile(): void
    {
        $zip = new \ZipArchive();
        if (file_exists($this->filePath)) {
            $zip->open($this->filePath, \ZipArchive::OVERWRITE);
        } else {
            $zip->open($this->filePath, \ZipArchive::CREATE);
        }

        foreach ($this->pictures as $picture) {
            $zip->addFile($picture->path, $picture->entryName);
        }

        $zip->close();
    }
}
