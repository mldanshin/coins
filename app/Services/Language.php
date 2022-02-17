<?php

namespace App\Services;

use App\Exceptions\PageNotFoundException;
use App\Models\LanguageType;
use App\Models\Eloquent\Language as LanguageEloquent;
use Illuminate\Support\Facades\App;

final class Language
{
    public function current(): LanguageType
    {
        $langId = LanguageEloquent::where("two_letter", App::currentLocale())->value("id");
        return LanguageType::from($langId);
    }

    public function setCurrent(string $lang): void
    {
        $this->validateLang($lang);
        App::setLocale($lang);
    }

    /**
     * @throws PageNotFoundException
     */
    public function validateLang(string $lang): bool
    {
        $supportedLocale = config("app.supported_locales");
        if (!in_array($lang, $supportedLocale)) {
            throw new PageNotFoundException("The page with lang=$lang does not exist. ");
        }

        return true;
    }

    /**
     * @return string[]
     */
    public function getSupported(): array
    {
        return config("app.supported_locales");
    }
}
