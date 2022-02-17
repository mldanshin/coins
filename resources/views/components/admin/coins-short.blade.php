@if ($paginator->count() > 0)
    <div class="margin-y-1">
        <ul>
            @foreach ($paginator as $item)
                <li class="flex-column margin-b-2">
                    <x-admin.coin-short :model="$item" />
                    <div class="coins-short-dashboard">
                        @include ("admin.dashboard.show", [
                            "coinId" => $item->id,
                            "query" => "{$paginator->getPageName()}={$paginator->currentPage()}" . ((empty($queryExceptPaginator)) ? "" : "&$queryExceptPaginator")
                        ])
                        @include ("admin.dashboard.edit", [
                            "coinId" => $item->id,
                            "query" => "{$paginator->getPageName()}={$paginator->currentPage()}" . ((empty($queryExceptPaginator)) ? "" : "&$queryExceptPaginator")
                        ])
                        @include ("admin.dashboard.delete", [
                            "coinId" => $item->id,
                            "query" => "{$paginator->getPageName()}={$paginator->currentPage()}" . ((empty($queryExceptPaginator)) ? "" : "&$queryExceptPaginator")
                        ])
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="paginator-link">
            {{ $paginator->onEachSide(1)->links("partials.pagination", ["query" => $queryExceptPaginator]) }}
        </div>
    </div>
@else
    <div class="coins-not-found">{{ __("coins.not_found") }}</div>
@endif