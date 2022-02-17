@if ($paginator->count() > 0)
    <ul>
        @foreach ($paginator as $item)
            <li>
                <section class="coin-card">
                    <h2 class="text-center">
                        <x-coin-title :model="$item->title" />
                    </h2>
                    <x-picture class="picture-reader" :model="$item->picture" width="140" />
                    @include("admin.coins.partials.coin-reader-table", ["coin" => $item])
                    @if ($item->isHasSeo === true)
                        <div class="margin-y-1">
                            {{ __("coin.has_seo") }}
                        </div>
                    @endif
                    @if ($item->isHasArticle === true)
                        <div class="margin-y-1">
                            {{ __("coin.has_article") }}
                        </div>
                    @endif
                    <div class="coins-dashboard">
                        @include ("admin.dashboard.show", [
                            "coinId" => $item->id,
                            "query" => "{$paginator->getPageName()}={$paginator->currentPage()}" . ((empty($query)) ? "" : "&$query")
                        ])
                        @include ("admin.dashboard.edit", [
                            "coinId" => $item->id,
                            "query" => "{$paginator->getPageName()}={$paginator->currentPage()}" . ((empty($query)) ? "" : "&$query")
                        ])
                        @include ("admin.dashboard.delete", [
                            "coinId" => $item->id,
                            "query" => "{$paginator->getPageName()}={$paginator->currentPage()}" . ((empty($query)) ? "" : "&$query")
                        ])
                    </div>
                </section>
            </li>
        @endforeach
    </ul>
    <div class="paginator-link">
        {{ $paginator->onEachSide(1)->links("partials.pagination", ["query" => $query]) }}
    </div>
@else
    <div class="coins-not-found">{{ __("coins.not_found") }}</div>
@endif