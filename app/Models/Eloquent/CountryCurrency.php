<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $country_id
 * @property int $currency_id
 */
final class CountryCurrency extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "country_currency";

    /**
     * @var bool
     */
    public $timestamps = false;
}
