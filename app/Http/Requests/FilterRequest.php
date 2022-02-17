<?php

namespace App\Http\Requests;

use App\Http\Requests\Request as BaseRequest;
use App\Models\Filters\Request\Coin;
use App\Models\Filters\Request\Period;
use App\Models\Filters\Request\Search;

final class FilterRequest extends BaseRequest implements BuilderQueryContract
{
    /**
     * @return mixed[]
     */
    public function rules(): array
    {
        return [
            "search" => "nullable|string",
            "period_first" => "nullable|date_format:Y|before_or_equal:period_last|before_or_equal:now",
            "period_last" => "nullable|date_format:Y|after_or_equal:start_date|before_or_equal:now",
            "countries" => "nullable|array",
            "countries.*" => "nullable|numeric|exists:countries,id",
            "nominals" => "nullable|array",
            "nominals.*" => "nullable|numeric|exists:nominals,id",
            "coinages" => "nullable|array",
            "coinages.*" => "nullable|numeric|exists:coinages,id",
            "materials" => "nullable|array",
            "materials.*" => "nullable|numeric|exists:materials,id",
            "currencies" => "nullable|array",
            "currencies.*" => "nullable|numeric|exists:currencies,id",
            "shapes" => "nullable|array",
            "shapes.*" => "nullable|numeric|exists:shapes,id",
            "themes" => "nullable|array",
            "themes.*" => "nullable|numeric|exists:themes,id",
            "mintmarks" => "nullable|array",
            "mintmarks.*" => "nullable|numeric|exists:mintmarks,id",
        ];
    }

    public function getFilter(): Coin
    {
        return new Coin(
            new Search($this->input("search", "")),
            new Period($this->input("period_first"), $this->input("period_last")),
            $this->input("countries", []),
            $this->input("nominals", []),
            $this->input("coinages", []),
            $this->input("materials", []),
            $this->input("currencies", []),
            $this->input("shapes", []),
            $this->input("themes", []),
            $this->input("mintmarks", []),
        );
    }

    public function shareQuery(BuilderQuery $builderQuery): void
    {
        $builderQuery->addString("search", $this->input("search"));
        $builderQuery->addString("period_first", $this->input("period_first"));
        $builderQuery->addString("period_last", $this->input("period_last"));
        $builderQuery->addArrayString("countries", $this->input("countries"));
        $builderQuery->addArrayString("nominals", $this->input("nominals"));
        $builderQuery->addArrayString("coinages", $this->input("coinages"));
        $builderQuery->addArrayString("materials", $this->input("materials"));
        $builderQuery->addArrayString("currencies", $this->input("currencies"));
        $builderQuery->addArrayString("shapes", $this->input("shapes"));
        $builderQuery->addArrayString("themes", $this->input("themes"));
        $builderQuery->addArrayString("mintmarks", $this->input("mintmarks"));
    }
}
