<?php

namespace Database\Seeders;

use App\Models\Eloquent\Coin;
use Database\Seeders\Demo\ArticleLanguageSeeder;
use Database\Seeders\Demo\ArticleSeeder;
use Database\Seeders\Demo\CoinSeeder;
use Database\Seeders\Demo\CoinageSeeder;
use Database\Seeders\Demo\CoinageLanguageSeeder;
use Database\Seeders\Demo\CoinMintmarkSeeder;
use Database\Seeders\Demo\CountryCurrencySeeder;
use Database\Seeders\Demo\CountryLanguageSeeder;
use Database\Seeders\Demo\CountrySeeder;
use Database\Seeders\Demo\CurrencyEnSeeder;
use Database\Seeders\Demo\CurrencyRuSeeder;
use Database\Seeders\Demo\CurrencySeeder;
use Database\Seeders\Demo\LanguageSeeder;
use Database\Seeders\Demo\MaterialLanguageSeeder;
use Database\Seeders\Demo\MaterialSeeder;
use Database\Seeders\Demo\MintmarkLanguageSeeder;
use Database\Seeders\Demo\MintmarkSeeder;
use Database\Seeders\Demo\NominalSeeder;
use Database\Seeders\Demo\OrderingLanguageSeeder;
use Database\Seeders\Demo\OrderingSeeder;
use Database\Seeders\Demo\QualityLanguageSeeder;
use Database\Seeders\Demo\QualitySeeder;
use Database\Seeders\Demo\SeoLanguageSeeder;
use Database\Seeders\Demo\SeoSeeder;
use Database\Seeders\Demo\ShapeLanguageSeeder;
use Database\Seeders\Demo\ShapeSeeder;
use Database\Seeders\Demo\StorageLanguageSeeder;
use Database\Seeders\Demo\StorageSeeder;
use Database\Seeders\Demo\ThemeLanguageSeeder;
use Database\Seeders\Demo\ThemeSeeder;
use Database\Seeders\Demo\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeederDemo extends Seeder
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

        Coin::factory()->count(14)->create();
    }
}
