<?php

namespace App\Models\Picture;

use App\Services\FileStorage;

final class Repository extends RepositoryBase
{
    public function __construct(FileStorage $storage)
    {
        parent::__construct($storage);
    }

    public function get(
        int $coinId,
        string $country,
        string $nominal,
        string $currency,
        string $year
    ): Picture {
        $obverseId = $this->getId($coinId, "obverse");
        $reverseId = $this->getId($coinId, "reverse");

        return new Picture(
            $coinId,
            __("coin.name") . " $nominal $currency $year, $country",
            ($obverseId === null) ? null : $this->directoryOutside . $obverseId,
            ($reverseId === null) ? null : $this->directoryOutside . $reverseId,
            $this->directoryOutside . $this->default
        );
    }
}
