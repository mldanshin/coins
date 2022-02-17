<?php

namespace App\Services;

use App\Models\LanguageType;
use App\Services\Language;
use App\Services\FileStorage;

final class Provider
{
    private LanguageType $langCurrent;
    private FileStorage $storage;

    public function getLangCurrent(): LanguageType
    {
        if (!isset($this->langCurrent)) {
            $this->langCurrent = (new Language())->current();
        }

        return $this->langCurrent;
    }

    public function getStorage(): FileStorage
    {
        if (!isset($this->storage)) {
            $this->storage = FileStorage::instance();
        }

        return $this->storage;
    }
}
