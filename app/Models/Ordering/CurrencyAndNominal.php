<?php

namespace App\Models\Ordering;

use App\Models\LanguageType;
use App\Models\Eloquent\Currency;
use Illuminate\Database\Eloquent\Builder;

final class CurrencyAndNominal implements Orderable
{
    public function apply(Builder $builder, LanguageType $lang): Builder
    {
        $mapTranslation = (new Currency())->getMapTranslation($lang);
        $tableTranslation = $mapTranslation["table"];
        $columnTranslation = $mapTranslation["property"];

        return $builder
            ->join("nominals", "coins.nominal_id", "=", "nominals.id")
            ->join($tableTranslation, "coins.currency_id", "=", "$tableTranslation.currency_id")
            ->orderBy("$tableTranslation.$columnTranslation")
            ->orderBy("nominals.value");
    }
}
