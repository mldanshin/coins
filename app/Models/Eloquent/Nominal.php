<?php

namespace App\Models\Eloquent;

use App\Models\ItemCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property float $value
 */
final class Nominal extends Model
{
    use HasFactory;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array<string>
     */
    protected $fillable = [
        "value",
    ];

    /**
     * @return Collection<ItemCollection>
     */
    public static function getPairCollection(): Collection
    {
        return Nominal::select("id", "value")->get()
            ->map(fn($item) => new ItemCollection($item->id, $item->value));
    }
}
