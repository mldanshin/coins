<?php
/**
 * @var App\Models\CRUD\Reader\PageIndex $page
 * @var string $queryExceptPaginator
 */
?>
@extends("admin.layout")

@section("content")
<div class="content-container-index">
    <aside class="overflow-y-auto">
        <form class="flex-column" id="admin-filter-form" method="GET" action="{{ route('admin.index') }}">
            <x-ordering :model="$page->orderingForm" />
            <fieldset class="filter-container">
                <legend class="filter-container-title">{{ __("filters.name") }}</legend>
                @include("partials.offcanvas.button-show", ["targetId" => "filter-group"])
                <div class="filter-group collapse" id="filter-group">
                    @include("partials.offcanvas.button-close", ["targetId" => "filter-group"])
                    <x-admin.filters :model="$page->filtersForm"/>
                </div>
            </fieldset>
        </form>
    </aside>
    <main class="flex-column align-items-center gap-row-1 margin-y-1">
        <div class="coin-dashboard">
            @include ("admin.dashboard.create", [
                "query" => $queryExceptPaginator
            ])
        </div>
        <x-admin.reader.coins :paginator="$page->coins" :query="$queryExceptPaginator" />
    </main>
</div>
@endsection