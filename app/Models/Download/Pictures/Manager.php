<?php

namespace App\Models\Download\Pictures;

use App\Models\Download\Repository;
use App\Models\Download\Pictures\Picture\Picture;
use App\Models\Download\Pictures\Picture\Repository as RepositoryPicture;
use App\Services\FileStorage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage as StorageFacade;

final class Manager
{
    private Repository $repository;
    private FileStorage $storage;
    private CreatorBase $creator;

    /**
     * @var Collection<Picture> $pictures
     */
    private Collection $pictures;

    public function __construct(string $type)
    {
        $this->storage = new FileStorage(StorageFacade::disk("public"));
        $this->repository = new Repository($this->storage);
        $this->initializePictures();
        $this->initializeCreator($type);
    }

    public function getFilePath(): ?string
    {
        return $this->creator->getFilePath();
    }

    private function initializePictures(): void
    {
        $this->pictures = (new RepositoryPicture($this->storage))->getCollection();
    }

    private function initializeCreator(string $type): void
    {
        $this->creator = match ($type) {
            "zip" => new CreatorZip($this->repository, $this->pictures),
            default => throw new \Exception("Not supported type. ")
        };
    }
}
