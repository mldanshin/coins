<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $coin_id
 * @property int $mintmark_id
 */
final class CoinMintmark extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "coin_mintmark";

    /**
     * @var array<string>
     */
    protected $fillable = [
        "coin_id",
        "mintmark_id",
    ];
}
