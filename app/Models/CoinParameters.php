<?php

namespace App\Models;

use App\Models\ItemCollection;
use App\Models\LanguageType;
use App\Models\Eloquent\Coinage;
use App\Models\Eloquent\Country;
use App\Models\Eloquent\Currency;
use App\Models\Eloquent\Material;
use App\Models\Eloquent\Mintmark;
use App\Models\Eloquent\Nominal;
use App\Models\Eloquent\Quality;
use App\Models\Eloquent\Shape;
use App\Models\Eloquent\Storage;
use App\Models\Eloquent\Theme;
use Illuminate\Support\Collection;

final class CoinParameters
{
    private readonly LanguageType $lang;

    /**
     * @var Collection<ItemCollection> $countries
     */
    private Collection $countries;

    /**
     * @var Collection<ItemCollection> $nominals
     */
    private Collection $nominals;

    /**
     * @var Collection<ItemCollection> $coinages
     */
    private Collection $coinages;

    /**
     * @var Collection<ItemCollection> $materials
     */
    private Collection $materials;

    /**
     * @var Collection<ItemCollection> $currencies
     */
    private Collection $currencies;

    /**
     * @var Collection<ItemCollection> $shapes
     */
    private Collection $shapes;

    /**
     * @var Collection<ItemCollection> $themes
     */
    private Collection $themes;

    /**
     * @var Collection<ItemCollection> $mintmarks
     */
    private Collection $mintmarks;

    /**
     * @var Collection<ItemCollection> $qualities
     */
    private Collection $qualities;

    /**
     * @var Collection<ItemCollection> $storages
     */
    private Collection $storages;

    public function __construct(LanguageType $lang)
    {
        $this->lang = $lang;
    }

    /**
     * @return Collection<ItemCollection>
     */
    public function countries(): Collection
    {
        if (!isset($this->countries)) {
            $this->countries = Country::getPairCollection($this->lang);
        }

        return $this->countries;
    }

    /**
     * @return Collection<ItemCollection>
     */
    public function nominals(): Collection
    {
        if (!isset($this->nominals)) {
            $this->nominals = Nominal::getPairCollection();
        }

        return $this->nominals;
    }

    /**
     * @return Collection<ItemCollection>
     */
    public function coinages(): Collection
    {
        if (!isset($this->coinages)) {
            $this->coinages = Coinage::getPairCollection($this->lang);
        }

        return $this->coinages;
    }

    /**
     * @return Collection<ItemCollection>
     */
    public function materials(): Collection
    {
        if (!isset($this->materials)) {
            $this->materials = Material::getPairCollection($this->lang);
        }

        return $this->materials;
    }

    /**
     * @return Collection<ItemCollection>
     */
    public function currencies(): Collection
    {
        if (!isset($this->currencies)) {
            $this->currencies = Currency::getPairCollection($this->lang);
        }

        return $this->currencies;
    }

    /**
     * @return Collection<ItemCollection>
     */
    public function shapes(): Collection
    {
        if (!isset($this->shapes)) {
            $this->shapes = Shape::getPairCollection($this->lang);
        }

        return $this->shapes;
    }

    /**
     * @return Collection<ItemCollection>
     */
    public function themes(): Collection
    {
        if (!isset($this->themes)) {
            $this->themes = Theme::getPairCollection($this->lang);
        }

        return $this->themes;
    }

    /**
     * @return Collection<ItemCollection>
     */
    public function mintmarks(): Collection
    {
        if (!isset($this->mintmarks)) {
            $this->mintmarks = Mintmark::getPairCollection($this->lang);
        }

        return $this->mintmarks;
    }

    /**
     * @return Collection<ItemCollection>
     */
    public function qualities(): Collection
    {
        if (!isset($this->qualities)) {
            $this->qualities = Quality::getPairCollection($this->lang);
        }

        return $this->qualities;
    }

    /**
     * @return Collection<ItemCollection>
     */
    public function storages(): Collection
    {
        if (!isset($this->storages)) {
            $this->storages = Storage::getPairCollection($this->lang);
        }

        return $this->storages;
    }
}
