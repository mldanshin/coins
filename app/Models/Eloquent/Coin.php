<?php

namespace App\Models\Eloquent;

use App\Models\LanguageType;
use App\Models\Filters\CoinSearch;
use App\Models\Filters\RequestBase as Filter;
use App\Models\Ordering\CoinOrdering;
use App\Models\Ordering\Request as Ordering;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $country_id
 * @property int $nominal_id
 * @property int $coinage_id
 * @property int $material_id
 * @property int $currency_id
 * @property int $shape_id
 * @property int $theme_id
 * @property string $year
 * @property int $quality_id
 * @property int $storage_id
 */
final class Coin extends Model
{
    use HasFactory;

    /**
     * @var array<string>
     */
    protected $fillable = [
        "country_id",
        "nominal_id",
        "coinage_id",
        "material_id",
        "currency_id",
        "shape_id",
        "theme_id",
        "year",
        "quality_id",
        "storage_id",
    ];

    public function country(): HasOne
    {
        return $this->hasOne(Country::class, "id", "country_id");
    }

    public function nominal(): HasOne
    {
        return $this->hasOne(Nominal::class, "id", "nominal_id");
    }

    public function coinage(): HasOne
    {
        return $this->hasOne(Coinage::class, "id", "coinage_id");
    }

    public function material(): HasOne
    {
        return $this->hasOne(Material::class, "id", "material_id");
    }

    public function currency(): HasOne
    {
        return $this->hasOne(Currency::class, "id", "currency_id");
    }

    public function shape(): HasOne
    {
        return $this->hasOne(Shape::class, "id", "shape_id");
    }

    public function theme(): HasOne
    {
        return $this->hasOne(Theme::class, "id", "theme_id");
    }

    public function mintmark(): HasOneThrough
    {
        return $this->hasOneThrough(Mintmark::class, CoinMintmark::class, "coin_id", "id", "id", "mintmark_id");
    }

    public function mintmarkPivot(): HasOne
    {
        return $this->hasOne(CoinMintmark::class, "coin_id", "id");
    }

    public function quality(): HasOne
    {
        return $this->hasOne(Quality::class, "id", "quality_id");
    }

    public function storage(): HasOne
    {
        return $this->hasOne(Storage::class, "id", "storage_id");
    }

    public function seo(): HasOne
    {
        return $this->hasOne(Seo::class, "coin_id", "id");
    }

    public function article(): HasOne
    {
        return $this->hasOne(Article::class, "coin_id", "id");
    }

    public static function search(Filter $filter, Ordering $ordering, LanguageType $lang): Builder
    {
        $builder = (new CoinSearch())->apply($filter);
        $builder = $builder->select(
            "coins.id",
            "coins.country_id",
            "coins.nominal_id",
            "coins.coinage_id",
            "coins.material_id",
            "coins.currency_id",
            "coins.shape_id",
            "coins.theme_id",
            "coins.year",
            "coins.quality_id",
            "coins.storage_id",
        );
        $builder = (new CoinOrdering($builder))->apply($ordering, $lang);
        return $builder;
    }
}
