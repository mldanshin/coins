<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $shape_id
 * @property int $language_id
 * @property string $name
 */
final class ShapeLanguage extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "shape_language";

    /**
     * @var bool
     */
    public $timestamps = false;
}
