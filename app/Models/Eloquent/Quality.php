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
 * @property string $english_name
 */
final class Quality extends Model
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
        "english_name",
    ];

    public function language(): HasMany
    {
        return $this->hasMany(QualityLanguage::class);
    }

    public function translate(LanguageType $lang): string
    {
        if ($lang === LanguageType::en) {
            return $this->english_name;
        } else {
            return $this->language()->where("language_id", $lang)->first()->name;
        }
    }

    /**
     * @return Collection<ItemCollection>
     */
    public static function getPairCollection(LanguageType $lang): Collection
    {
        if ($lang === LanguageType::en) {
            return self::select("id", "english_name")->orderBy("english_name")->get()
                ->map(fn($item) => new ItemCollection($item->id, $item->english_name));
        } else {
            return self::join(
                "quality_language",
                fn($join) => $join->on("qualities.id", "=", "quality_language.quality_id")
                    ->where("quality_language.language_id", $lang)
            )
            ->select("qualities.id", "quality_language.name")
            ->orderBy("name")
            ->get()
            ->map(fn($item) => new ItemCollection($item->id, $item->name));
        }
    }
}