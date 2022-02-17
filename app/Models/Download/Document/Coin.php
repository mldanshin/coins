<?php

namespace App\Models\Download\Document;

use App\Models\CoinTitle;
use App\Models\LanguageType;
use App\Models\Download\Document\Picture\Picture;
use App\Models\Download\Document\Picture\Repository;
use App\Models\Eloquent\Coin as CoinEloquent;
use App\Services\FileStorage;
use Illuminate\Support\Collection;

final class Coin
{
    public function __construct(
        public readonly CoinTitle $title,
        public readonly string $country,
        public readonly string $nominal,
        public readonly string $coinage,
        public readonly string $material,
        public readonly string $currency,
        public readonly string $shape,
        public readonly string $theme,
        public readonly ?string $mintmark,
        public readonly string $year,
        public readonly string $quality,
        public readonly string $storage,
        public readonly Picture $picture,
    ) {
    }

    public static function getById(
        int $id,
        LanguageType $lang,
        FileStorage $storage
    ): self {
        $eloquent = CoinEloquent::find($id);

        $nominal = $eloquent->nominal()->first()->value;
        $currency = $eloquent->currency()->first();

        return new self(
            new CoinTitle($nominal, $currency->id, $eloquent->year, $lang),
            $eloquent->country()->first()->translate($lang),
            $nominal,
            $eloquent->coinage()->first()->translate($lang),
            $eloquent->material()->first()->translate($lang),
            $currency->translate($lang),
            $eloquent->shape()->first()->translate($lang),
            $eloquent->theme()->first()->translate($lang),
            $eloquent->mintmark()->first()?->translate($lang),
            $eloquent->year,
            $eloquent->quality()->first()->translate($lang),
            $eloquent->storage()->first()->translate($lang),
            (new Repository($storage))->get($eloquent->id)
        );
    }

    /**
     * @return Collection<self>
     */
    public static function getCollection(LanguageType $lang, FileStorage $storage): Collection
    {
        $ids = CoinEloquent::pluck("id");

        $collection = collect();
        foreach ($ids as $id) {
            $collection->push(
                Coin::getById($id, $lang, $storage)
            );
        }

        return $collection;
    }
}
