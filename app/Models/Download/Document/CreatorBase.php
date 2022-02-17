<?php

namespace App\Models\Download\Document;

use App\Models\Download\Repository;
use Illuminate\Support\Collection;

abstract class CreatorBase
{
    /**
     * @param Collection<Coin> $coins
     */
    public function __construct(
        protected Repository $repository,
        protected Collection $coins
    ) {
    }

    abstract public function getFilePath(): string;
}
