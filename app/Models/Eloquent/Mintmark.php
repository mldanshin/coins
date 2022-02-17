<?php

namespace App\Models\Eloquent;

use App\Models\ItemCollection;
use App\Models\LanguageType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $value
 * @property string $english_description
 */
final class Mintmark extends Model
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
        "value",
        "english_description",
    ];

    public function language(): HasMany
    {
        return $this->hasMany(MintmarkLanguage::class);
    }

    public function translate(LanguageType $lang): string
    {
        if ($lang === LanguageType::en) {
            return $this->english_description;
        } else {
            return $this->language()->where("language_id", $lang)->first()->description;
        }
    }

    /**
     * @return Collection<ItemCollection>
     */
    public static function getPairCollection(LanguageType $lang): Collection
    {
        if ($lang === LanguageType::en) {
            return self::select("id", "english_description")->orderBy("english_description")->get()
                ->map(fn($item) => new ItemCollection($item->id, $item->english_description));
        } else {
            return self::join(
                "mintmark_language",
                fn($join) => $join->on("mintmarks.id", "=", "mintmark_language.mintmark_id")
                    ->where("mintmark_language.language_id", $lang)
            )
            ->select("mintmarks.id", "mintmark_language.description")
            ->orderBy("description")
            ->get()
            ->map(fn($item) => new ItemCollection($item->id, $item->description));
        }
    }
}
