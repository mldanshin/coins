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
final class Ordering extends Model
{
    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = "ordering";

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
        return $this->hasMany(OrderingLanguage::class);
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
            return self::join("ordering_language", "ordering.id", "=", "ordering_language.ordering_id")
                ->select("ordering.id", "ordering_language.name")
                ->orderBy("name")
                ->get()
                ->map(fn($item) => new ItemCollection($item->id, $item->name));
        }
    }
}
