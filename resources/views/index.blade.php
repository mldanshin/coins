<?php
/**
 * @var App\Models\PageIndex $page
 * @var string $queryPagination
 * @var string $queryExceptPaginator
 */
?>
@extends("layout", [
    "page" => $page,
    "query" => $queryPagination . ((empty($queryExceptPaginator)) ? "" : "&$queryExceptPaginator")
])

@section("title")
    {{ $page->seo->title }}
@endsection

@section("meta-description")
    {{ $page->seo->description }}
@endsection

@section("meta-keywords")
    {{ $page->seo->keywords }}
@endsection

@section("content")
<div class="content-container-index">
    <!--noindex-->
    <aside class="overflow-y-auto">
        <form class="flex-column" method="GET" action="{{ route('index', ['lang' => App::currentLocale()]) }}">
            <x-ordering :model="$page->orderingForm" />
            <x-filters :model="$page->filtersForm" />
        </form>
    </aside>
    <!--/noindex-->
    <main class="flex-column align-items-center gap-row-2">
        <x-coins :paginator="$page->coins" :query="$queryExceptPaginator" />
    </main>
</div>
@endsection