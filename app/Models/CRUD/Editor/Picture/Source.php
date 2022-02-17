<?php

namespace App\Models\CRUD\Editor\Picture;

use App\Models\Picture\PictureType;

final class Source
{
    public function __construct(
        public readonly string $inside,
        public readonly string $outside,
        public readonly PictureType $type
    ) {
    }
}
