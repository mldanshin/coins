<?php
namespace Tests\DataProvider;

trait Lang
{
    private function getLang(): string
    {
        return config("app.locale");
    }

    private function setLangRu(): void
    {
        config(["app.locale" => "ru"]);
    }

    private function setLangEn(): void
    {
        config(["app.locale" => "en"]);
    }

    private function setLang(string $twoLetter): void
    {
        config(["app.locale" => $twoLetter]);
    }
}
