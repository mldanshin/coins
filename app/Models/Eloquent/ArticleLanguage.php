<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $article_id
 * @property int $language_id
 * @property string $title
 * @property string $content
 */
final class ArticleLanguage extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "article_language";

    /**
     * @var array<string>
     */
    protected $fillable = [
        "article_id",
        "language_id",
        "title",
        "content",
    ];
}
