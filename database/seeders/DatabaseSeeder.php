<?php

namespace Database\Seeders;

use Database\Seeders\Deploy\CoinageSeeder;
use Database\Seeders\Deploy\CoinageLanguageSeeder;
use Database\Seeders\Deploy\CountryCurrencySeeder;
use Database\Seeders\Deploy\CountryLanguageSeeder;
use Database\Seeders\Deploy\CountrySeeder;
use Database\Seeders\Deploy\CurrencyEnSeeder;
use Database\Seeders\Deploy\CurrencyRuSeeder;
use Database\Seeders\Deploy\CurrencySeeder;
use Database\Seeders\Deploy\LanguageSeeder;
use Database\Seeders\Deploy\MaterialLanguageSeeder;
use Database\Seeders\Deploy\MaterialSeeder;
use Database\Seeders\Deploy\MintmarkLanguageSeeder;
use Database\Seeders\Deploy\MintmarkSeeder;
use Database\Seeders\Deploy\NominalSeeder;
use Database\Seeders\Deploy\OrderingLanguageSeeder;
use Database\Seeders\Deploy\OrderingSeeder;
use Database\Seeders\Deploy\QualityLanguageSeeder;
use Database\Seeders\Deploy\QualitySeeder;
use Database\Seeders\Deploy\ShapeLanguageSeeder;
use Database\Seeders\Deploy\ShapeSeeder;
use Database\Seeders\Deploy\StorageLanguageSeeder;
use Database\Seeders\Deploy\StorageSeeder;
use Database\Seeders\Deploy\ThemeLanguageSeeder;
use Database\Seeders\Deploy\ThemeSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LanguageSeeder::class,
            CountrySeeder::class,
            CountryLanguageSeeder::class,
            NominalSeeder::class,
            CoinageSeeder::class,
            CoinageLanguageSeeder::class,
            MaterialSeeder::class,
            MaterialLanguageSeeder::class,
            CurrencySeeder::class,
            CurrencyEnSeeder::class,
            CurrencyRuSeeder::class,
            CountryCurrencySeeder::class,
            ShapeSeeder::class,
            ShapeLanguageSeeder::class,
            ThemeSeeder::class,
            ThemeLanguageSeeder::class,
            QualitySeeder::class,
            QualityLanguageSeeder::class,
            MintmarkSeeder::class,
            MintmarkLanguageSeeder::class,
            StorageSeeder::class,
            StorageLanguageSeeder::class,
            OrderingSeeder::class,
            OrderingLanguageSeeder::class,
        ]);
    }
}
