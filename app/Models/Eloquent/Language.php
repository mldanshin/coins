<?php

namespace App\Models\Eloquent;

use App\Models\LanguageType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $two_letter
 * @property string $native_name
 * @property string $english_name
 */
final class Language extends Model
{
    use HasFactory;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array<string>
     */
    protected $fillable = [
        "two_letter",
        "native_name",
        "english_name",
    ];

    public static function getIdByType(LanguageType $lang): int
    {
        return Language::where("id", $lang->value)->first()->id;
    }

    public static function getByType(LanguageType $lang): self
    {
        return Language::where("id", $lang->value)->first();
    }
}
