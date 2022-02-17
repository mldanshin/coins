<?php

namespace App\Models\Download\Pictures;

use App\Exceptions\PageNotFoundException;

final class Validate
{
    /**
    * @throws PageNotFoundException
    */
    public static function type(string $type): bool
    {
        try {
            FileType::from($type);
        } catch (\ValueError) {
            throw new PageNotFoundException("Type $type not found. ");
        }

        return true;
    }
}
