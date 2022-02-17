<?php

namespace App\Http\Requests;

use App\Http\Requests\BuilderQueryContract;

final class BuilderQuery
{
    private string $query = "";

    public function __construct(bool $charQuestion = false)
    {
        if ($charQuestion === true) {
            $this->query = "?";
        }
    }

    public static function build(bool $isComplete, BuilderQueryContract ...$contracts): string
    {
        $builderQuery = new self($isComplete);

        foreach ($contracts as $contract) {
            $contract->shareQuery($builderQuery);
        }

        return $builderQuery->getQuery();
    }

    public function getQuery(): string
    {
        if ($this->query === "?") {
            return "";
        } else {
            return $this->query;
        }
    }

    /**
     * @param array<string>|null $value
     */
    public function addArrayString(string $key, ?array $value): void
    {
        if (!empty($key) && $value !== null && $value !== []) {
            $this->addAmpersanIfNotEmpty();
            $count = count($value);
            for ($i = 0; $i < $count; $i++) {
                $this->query .= "{$key}[]={$value[$i]}";
                if ($i + 1 != $count) {
                    $this->query .= "&";
                }
            }
        }
    }

    public function addString(string $key, ?string $value): void
    {
        if (!empty($key) && $value !== null) {
            $this->addAmpersanIfNotEmpty();
            $this->query .= "$key=$value";
        }
    }

    private function addAmpersanIfNotEmpty(): void
    {
        if (!empty($this->query) && $this->query !== "?") {
            $this->query .= "&";
        }
    }
}
