<?php

namespace App\Models\Download\Document;

use App\Models\LanguageType;
use App\Models\Download\Repository;
use App\Services\Language;
use App\Services\FileStorage;
use Illuminate\Support\Collection;

final class Manager
{
    private LanguageType $lang;
    private Repository $repository;
    private FileStorage $storage;
    private CreatorBase $creator;

    /**
     * @var Collection<Coin> $coins
     */
    private Collection $coins;

    public function __construct(string $type, ?string $coin)
    {
        $this->lang = (new Language())->current();
        $this->storage = FileStorage::instance();
        $this->repository = Repository::instance();
        $this->initializeCoins($coin);
        $this->initializeCreator($type);
    }

    public function getFilePath(): string
    {
        return $this->creator->getFilePath();
    }

    private function initializeCoins(?string $coin): void
    {
        if ($coin === null) {
            $this->coins = Coin::getCollection($this->lang, $this->storage);
        } else {
            $this->coins = collect([Coin::getById((int)$coin, $this->lang, $this->storage)]);
        }
    }

    private function initializeCreator(string $type): void
    {
        $this->creator = match ($type) {
            "pdf" => new CreatorPdf($this->repository, $this->coins),
            default => throw new \Exception("Not supported type. ")
        };
    }
}
