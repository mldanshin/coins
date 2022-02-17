<?php

namespace App\Models;

use App\Models\LanguageType;
use App\Models\Eloquent\CurrencyEn;
use App\Models\Eloquent\CurrencyRu;
use App\Models\Eloquent\Language;
use Illuminate\Support\Str;

final class CoinTitle
{
    public readonly float $nominal;
    public readonly string $currency;
    public readonly string $year;
    private readonly string $langLetter;

    public function __construct(
        float $nominal,
        int $currencyId,
        string $year,
        LanguageType $lang
    ) {
        $this->nominal = $nominal;
        $this->year = $year;

        $this->langLetter = Language::getByType($lang)->two_letter;
        $this->currency = $this->getCurrency($nominal, $currencyId);
    }

    private function getCurrency(float $nominal, int $currencyId): string
    {
        $map = $this->getMap($this->langLetter);

        $class = $map["class"];
        $property = $map["getPropertyCallback"]($nominal);

        $currency = $class::where("currency_id", $currencyId)->first();
        return Str::of($currency->$property)->lower();
    }

    /**
     * @return mixed[]
     */
    private function getMap(string $langLetter): array
    {
        $array = [
            "en" => [
                "class" => CurrencyEn::class,
                "getPropertyCallback" => function (float $nominal) {
                    if ($nominal > 1) {
                        return "plural";
                    } else {
                        return "singular";
                    }
                },
            ],
            "ru" => [
                "class" => CurrencyRu::class,
                "getPropertyCallback" => function (float $nominal) {
                    $nominalString = (string)$nominal;

                    if (str_contains($nominalString, ".")) {
                        return "singular_genitive";
                    } elseif ($nominal >= 5 && $nominal <= 20) {
                        return "plural_genitive";
                    } elseif ($nominalString[strlen($nominalString) - 1] === "1") {
                        return "singular_nominative";
                    } elseif (in_array($nominalString[strlen($nominalString) - 1], ["2", "3", "4"])) {
                        return "plural_nominative";
                    } else {
                        return "plural_genitive";
                    }
                }
            ]
        ];

        return $array[$langLetter];
    }
}
