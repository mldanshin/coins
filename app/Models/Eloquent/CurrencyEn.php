<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $currency_id
 * @property string $singular
 * @property string $plural
 */
final class CurrencyEn extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "currencies_en";

    /**
     * @var bool
     */
    public $timestamps = false;
}
