<?php

namespace App\Models;

/**
 * supported translation types must match the values of the languages table from the database
 */
enum LanguageType: int
{
    case en = 1;
    case ru = 2;
}
