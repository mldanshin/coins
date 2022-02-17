<?php

namespace App\Models\Eloquent;

use App\Models\LanguageType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $coin_id
 */
final class Seo extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "seo";

    /**
     * @var array<string>
     */
    protected $fillable = [
        "coin_id"
    ];

    public function language(): HasMany
    {
        return $this->hasMany(SeoLanguage::class);
    }

    public function translate(LanguageType $lang): ?SeoLanguage
    {
        return $this->language()->where("language_id", $lang)->first();
    }
}
