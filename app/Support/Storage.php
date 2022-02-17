<?php

namespace App\Support;

use App\Services\FileStorage;

final class Storage
{
    private FileStorage $fileStorage;
    private DownloadRepository $downloadRepository;
    private PictureRepository $pictureRepository;

    public function __construct()
    {
        $this->fileStorage = FileStorage::instance();
        $this->downloadRepository = new DownloadRepository($this->fileStorage);
        $this->pictureRepository = new PictureRepository($this->fileStorage);
    }

    public function createDirectoryIfNotExists(): void
    {
        $this->fileStorage->createDirectoryBase();
        $this->downloadRepository->createDirectory();
        $this->pictureRepository->createDirectoriesIfNotExists();
    }
}
