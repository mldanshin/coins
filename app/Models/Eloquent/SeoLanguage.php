<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $seo_id
 * @property int $language_id
 * @property string $title
 * @property string $description
 * @property string $keywords
 */
final class SeoLanguage extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "seo_language";

    /**
     * @var array<string>
     */
    protected $fillable = [
        "seo_id",
        "language_id",
        "title",
        "description",
        "keywords",
    ];
}
