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
final class Article extends Model
{
    use HasFactory;

    /**
     * @var array<string>
     */
    protected $fillable = [
        "coin_id"
    ];

    public function language(): HasMany
    {
        return $this->hasMany(ArticleLanguage::class);
    }

    public function translate(LanguageType $lang): ?ArticleLanguage
    {
        return $this->language()->where("language_id", $lang)->first();
    }
}
