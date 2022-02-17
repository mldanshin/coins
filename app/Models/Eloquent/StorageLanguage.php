<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $storage_id
 * @property int $language_id
 * @property string $name
 */
final class StorageLanguage extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "storage_language";

    /**
     * @var bool
     */
    public $timestamps = false;
}
