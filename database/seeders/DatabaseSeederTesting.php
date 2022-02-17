<?php

namespace Database\Seeders;

use Database\Seeders\Testing\ArticleLanguageSeeder;
use Database\Seeders\Testing\ArticleSeeder;
use Database\Seeders\Testing\CoinSeeder;
use Database\Seeders\Testing\CoinageSeeder;
use Database\Seeders\Testing\CoinageLanguageSeeder;
use Database\Seeders\Testing\CoinMintmarkSeeder;
use Database\Seeders\Testing\CountryCurrencySeeder;
use Database\Seeders\Testing\CountryLanguageSeeder;
use Database\Seeders\Testing\CountrySeeder;
use Database\Seeders\Testing\CurrencyEnSeeder;
use Database\Seeders\Testing\CurrencyRuSeeder;
use Database\Seeders\Testing\CurrencySeeder;
use Database\Seeders\Testing\LanguageSeeder;
use Database\Seeders\Testing\MaterialLanguageSeeder;
use Database\Seeders\Testing\MaterialSeeder;
use Database\Seeders\Testing\MintmarkLanguageSeeder;
use Database\Seeders\Testing\MintmarkSeeder;
use Database\Seeders\Testing\NominalSeeder;
use Database\Seeders\Testing\OrderingLanguageSeeder;
use Database\Seeders\Testing\OrderingSeeder;
use Database\Seeders\Testing\QualityLanguageSeeder;
use Database\Seeders\Testing\QualitySeeder;
use Database\Seeders\Testing\SeoLanguageSeeder;
use Database\Seeders\Testing\SeoSeeder;
use Database\Seeders\Testing\ShapeLanguageSeeder;
use Database\Seeders\Testing\ShapeSeeder;
use Database\Seeders\Testing\StorageLanguageSeeder;
use Database\Seeders\Testing\StorageSeeder;
use Database\Seeders\Testing\ThemeLanguageSeeder;
use Database\Seeders\Testing\ThemeSeeder;
use Database\Seeders\Testing\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeederTesting extends Seeder
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
            UserSeeder::class,
            StorageSeeder::class,
            StorageLanguageSeeder::class,
            CoinSeeder::class,
            SeoSeeder::class,
            SeoLanguageSeeder::class,
            ArticleSeeder::class,
            ArticleLanguageSeeder::class,
            CoinMintmarkSeeder::class,
            OrderingSeeder::class,
            OrderingLanguageSeeder::class,
        ]);
    }
}
