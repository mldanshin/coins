<?php

namespace App\Models\CRUD\Picture;

use App\Models\Picture\PictureType;
use Illuminate\Http\UploadedFile;

final class PictureUpload
{
    public function __construct(
        public readonly UploadedFile $file,
        public readonly PictureType $type
    ) {
    }
}
