<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $currency_id
 * @property string $singular_nominative
 * @property string $singular_genitive
 * @property string $plural_nominative
 * @property string $plural_genitive
 */
final class CurrencyRu extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "currencies_ru";

    /**
     * @var bool
     */
    public $timestamps = false;
}
