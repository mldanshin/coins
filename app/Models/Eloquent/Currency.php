<?php

namespace App\Models\Eloquent;

use App\Models\ItemCollection;
use App\Models\LanguageType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $english_name
 */
final class Currency extends Model
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

    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class);
    }

    public function translate(LanguageType $lang): string
    {
        $languageLetter = Language::getByType($lang)->two_letter;
        $map = $this->getMapTranslation($languageLetter);
        $class = $map["class"];
        $property = $map["property"];

        return $class::find($this->id)->$property;
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
            return self::select("id")->get()
                ->map(fn($item) => new ItemCollection($item->id, $item->translate($lang)))
                ->sortBy([
                    fn($a, $b) => $a->name > $b->name
                ]);
        }
    }

    /**
     * @return mixed[]
     */
    public function getMapTranslation(string|LanguageType $languageLetter): array
    {
        if ($languageLetter instanceof LanguageType) {
            $languageLetter = Language::getByType($languageLetter)->two_letter;
        }

        $array = [
            "en" => [
                "table" => "currencies_en",
                "class" => __NAMESPACE__ . "\CurrencyEn",
                "property" => "singular"
            ],
            "ru" => [
                "table" => "currencies_ru",
                "class" => __NAMESPACE__ . "\CurrencyRu",
                "property" => "singular_nominative"
            ],
        ];

        return $array[$languageLetter];
    }
}
