<?php

namespace App\Support;

use App\Models\Eloquent\Coin;
use App\Services\Language;
use Danshin\Sitemap\Models\DTO\SitemapUrl as SitemapUrlModel;
use Danshin\Sitemap\Services\Changefreq;
use Danshin\Sitemap\Services\SitemapUrlContract;
use Illuminate\Support\Collection;

final class Sitemap implements SitemapUrlContract
{
    /**
     * @var Collection<SitemapUrlModel> $sitemapUrl
     */
    private Collection $sitemapUrl;

    /**
     * @var string[] $supportedLocales
     */
    private array $supportedLocales;

    public function __construct()
    {
        $this->supportedLocales = (new Language())->getSupported();
        $this->create();
    }
    /**
     * @return Collection<SitemapUrlModel>
     */
    public function get(): Collection
    {
        return $this->sitemapUrl;
    }

    private function create(): void
    {
        $this->sitemapUrl = collect();

        $this->addHome();

        $coins = Coin::get();
        foreach ($coins as $coin) {
            $this->addCoin($coin);
        }
    }

    /**
     * @return void
     */
    private function addHome()
    {
        foreach ($this->supportedLocales as $locale) {
            $this->sitemapUrl->push(
                new SitemapUrlModel(
                    "$locale",
                    new \DateTime(),
                    Changefreq::WEEKLY,
                    0.5
                )
            );
        }
    }

    /**
     * @return void
     */
    private function addCoin(Coin $coin)
    {
        foreach ($this->supportedLocales as $locale) {
            $this->sitemapUrl->push(
                new SitemapUrlModel(
                    "coin/$coin->id/$locale",
                    new \DateTime(),
                    Changefreq::WEEKLY,
                    0.5
                )
            );
        }
    }
}
