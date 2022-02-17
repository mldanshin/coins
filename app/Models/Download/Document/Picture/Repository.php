<?php

namespace App\Models\Download\Document\Picture;

use App\Models\Picture\RepositoryBase;
use App\Services\FileStorage;

final class Repository extends RepositoryBase
{
    public function __construct(FileStorage $storage)
    {
        parent::__construct($storage);
    }

    public function get(int $coinId): Picture
    {
        $obverseId = $this->getId($coinId, "obverse");
        $reverseId = $this->getId($coinId, "reverse");

        return new Picture(
            ($obverseId === null) ? null : $this->storage->buildPath($this->directoryInside . $obverseId),
            ($reverseId === null) ? null : $this->storage->buildPath($this->directoryInside . $reverseId),
        );
    }
}
