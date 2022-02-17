<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $mintmark_id
 * @property int $language_id
 * @property string $description
 */
final class MintmarkLanguage extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "mintmark_language";

    /**
     * @var bool
     */
    public $timestamps = false;
}
