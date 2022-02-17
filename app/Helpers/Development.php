<?php

namespace App\Helpers;

use Danshin\Development\Models\Author as Author;
use Danshin\Development\Models\Year as Year;
use Illuminate\Support\Facades\App;

final class Development
{
    private static Author $author;
    private static string $year;

    public static function getAuthorRoleComment(): string
    {
        self::initialize();
        return self::$author->roleComment;
    }

    public static function getAuthorName(): string
    {
        self::initialize();
        return self::$author->surnameAndName;
    }

    public static function getAuthorEmail(): string
    {
        self::initialize();
        return self::$author->email;
    }

    public static function getYear(): string
    {
        self::initialize();
        return self::$year;
    }

    private static function initialize(): void
    {
        if (empty(self::$author)) {
            self::$author = Author::get(App::currentLocale());
        }

        if (empty(self::$year)) {
            self::$year = (new Year())->periodFrom(2022);
        }
    }
}
