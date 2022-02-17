@if ($paginator->count() > 0)
    <ul>
        @foreach ($paginator as $item)
            <li>
                <section class="coin-card">
                    <h2 class="text-center">
                        <a href="{{ route('show', ['lang' => App::currentLocale(), 'coinId' => $item->id]) }}?@if($query){{ "$query&" }}@endif{{ $paginator->getPageName() }}={{ $paginator->currentPage() }}">
                            <x-coin-title :model="$item->title" />
                        </a>
                    </h2>
                    <x-picture class="picture-reader" :model="$item->picture" width="140" />
                    @include("partials.coin-table", ["coin" => $item])
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