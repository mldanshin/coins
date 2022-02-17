<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuilderQuery;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\OrderingRequest;
use App\Http\Requests\PaginationRequest;
use App\Models\PageIndex;
use App\Models\PageShow;
use App\Models\Validate;
use App\Services\Provider;
use Illuminate\View\View;

final class CoinsController extends Controller
{
    public function __construct(
        private PaginationRequest $paginationRequest,
        private FilterRequest $filterRequest,
        private OrderingRequest $orderingRequest,
        private Provider $services
    ) {
    }

    public function index(): View
    {
        return view("index", [
            "page" => PageIndex::create(
                $this->filterRequest->getFilter(),
                $this->orderingRequest->getOrdering(),
                $this->services->getLangCurrent(),
                $this->services->getStorage()
            ),
            "queryPagination" => BuilderQuery::build(false, $this->paginationRequest),
            "queryExceptPaginator" => BuilderQuery::build(false, $this->filterRequest, $this->orderingRequest)
        ]);
    }

    public function show(string $coinId): View
    {
        Validate::coinId($coinId);

        return view("show", [
            "page" => PageShow::create(
                (int)$coinId,
                $this->services->getLangCurrent(),
                $this->services->getStorage()
            ),
            "query" => BuilderQuery::build(
                false,
                $this->paginationRequest,
                $this->filterRequest,
                $this->orderingRequest
            )
        ]);
    }
}
