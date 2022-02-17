<?php

namespace App\Models;

use App\Models\ItemCollection;
use App\Models\Languages;
use App\Models\LanguageType;
use App\Models\Eloquent\Language as LanguageEloquent;
use App\Services\FileStorage;
use Illuminate\Support\Collection;

abstract class PageBase
{
    public readonly Languages $languages;

    public function __construct(
        public readonly LanguageType $languageCurrent
    ) {
        $this->languages = $this->getLanguages();
    }

    private function getLanguages(): Languages
    {
        $languageEloquent = LanguageEloquent::getByType($this->languageCurrent);

        return new Languages(
            LanguageEloquent::get()->map(fn($item) => new ItemCollection($item->two_letter, $item->native_name)),
            new ItemCollection($languageEloquent->two_letter, $languageEloquent->native_name)
        );
    }
}
