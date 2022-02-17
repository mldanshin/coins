<?php

namespace App\Models\Download\Pictures;

use App\Models\Download\Repository;
use App\Models\Download\Pictures\Picture\Picture;
use Illuminate\Support\Collection;

abstract class CreatorBase
{
    /**
     * @param Collection<Picture> $pictures
     */
    public function __construct(
        protected Repository $repository,
        protected Collection $pictures
    ) {
    }

    abstract public function getFilePath(): ?string;
}
