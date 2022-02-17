<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuilderQuery;
use App\Http\Requests\OrderingRequest;
use App\Http\Requests\PaginationRequest;
use App\Http\Requests\Admin\FilterRequest;
use App\Http\Requests\Admin\CreatorRequest;
use App\Http\Requests\Admin\EditorRequest;
use App\Http\Requests\Admin\PresetRequest;
use App\Models\Validate;
use App\Models\CRUD\CoinPreset;
use App\Models\CRUD\Creator\Page as PageCreator;
use App\Models\CRUD\Editor\Page as PageEditor;
use App\Models\CRUD\Reader\PageIndex;
use App\Models\CRUD\Reader\PageShow;
use App\Models\CRUD\Saving\Page as PageSaving;
use App\Models\CRUD\Updater\Page as PageUpdater;
use App\Services\Provider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CoinsController extends Controller
{
    private string $queryExceptPaginator;
    public function __construct(
        private PaginationRequest $paginationRequest,
        private FilterRequest $filterRequest,
        private OrderingRequest $orderingRequest,
        private Provider $services
    ) {
        $this->queryExceptPaginator = BuilderQuery::build(false, $this->filterRequest, $this->orderingRequest);
        $this->queryFull = BuilderQuery::build(
            false,
            $this->paginationRequest,
            $this->filterRequest,
            $this->orderingRequest
        );
        $this->queryComplete = BuilderQuery::build(
            true,
            $this->paginationRequest,
            $this->filterRequest,
            $this->orderingRequest
        );
    }

    public function index(): View
    {
        return view("admin.index", [
            "page" => PageIndex::create(
                $this->filterRequest->getFilter(),
                $this->orderingRequest->getOrdering(),
                $this->services->getLangCurrent(),
                $this->services->getStorage()
            ),
            "queryExceptPaginator" => $this->queryExceptPaginator
        ]);
    }

    public function create(): View
    {
        return view("admin.coins.create", [
            "page" => PageCreator::create(
                $this->filterRequest->getFilter(),
                $this->orderingRequest->getOrdering(),
                $this->services->getLangCurrent(),
                $this->services->getStorage()
            ),
            "query" => $this->queryFull,
            "queryExceptPaginator" => $this->queryExceptPaginator
        ]);
    }

    public function store(CreatorRequest $request): RedirectResponse
    {
        $coinId = PageSaving::store(
            $request->getPage(),
            $this->services->getLangCurrent(),
            $this->services->getStorage()
        );

        return redirect(route("admin.coins.show", $coinId) . $this->queryComplete)
            ->with("message", __("message.store.ok"));
    }

    public function show(string $coinId): View
    {
        Validate::coinId($coinId);

        return view("admin.coins.show", [
            "page" => PageShow::create(
                $this->filterRequest->getFilter(),
                $this->orderingRequest->getOrdering(),
                (int)$coinId,
                $this->services->getLangCurrent(),
                $this->services->getStorage()
            ),
            "query" => $this->queryFull,
            "queryExceptPaginator" => $this->queryExceptPaginator
        ]);
    }

    public function edit(string $coinId): View
    {
        Validate::coinId($coinId);

        return view("admin.coins.edit", [
            "page" => PageEditor::create(
                $this->filterRequest->getFilter(),
                $this->orderingRequest->getOrdering(),
                (int)$coinId,
                $this->services->getLangCurrent(),
                $this->services->getStorage()
            ),
            "query" => $this->queryFull,
            "queryExceptPaginator" => $this->queryExceptPaginator
        ]);
    }

    public function update(EditorRequest $request): RedirectResponse
    {
        $coinId = PageUpdater::update(
            $request->getPage(),
            $this->services->getLangCurrent(),
            $this->services->getStorage()
        );

        return redirect(route("admin.coins.show", $coinId) . $this->queryComplete)
            ->with("message", __("message.update.ok"));
    }

    public function destroy(string $coinId): RedirectResponse
    {
        Validate::coinId($coinId);

        PageUpdater::delete((int)$coinId, $this->services->getStorage());

        return redirect(route("admin.index") . $this->queryComplete)
            ->with("message", __("message.delete.ok"));
    }

    public function savePreset(PresetRequest $request): JsonResponse
    {
        CoinPreset::save($request->getCoinPreset());

        return response()->json(["message" => __("message.preset.ok")]);
    }
}
