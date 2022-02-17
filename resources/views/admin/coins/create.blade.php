<?php
/**
 * @var App\Models\CRUD\Editor\Page $page
 * @var string $query
 * @var string $queryExceptPaginator
 */
?>
@extends("admin.coins.layout", [
    "coins" => $page->coins,
    "form" => $page->filtersForm,
    "queryExceptPaginator" => $queryExceptPaginator,
    "actionFiltersForm" => route('admin.coins.create')
])

@section("dashboard")
    @include ("admin.dashboard.list", [
        "query" => $query
    ])
    @include ("admin.dashboard.create", [
        "query" => $query
    ])
    @include ("admin.dashboard.store", [
        "formId" => "coin-store"
    ])
    @include ("admin.dashboard.preset")
@endsection

@section("main")
    <form id="coin-store"
        action="{{ route('admin.coins.store') }}@if($query){{ "?$query" }}@endif"
        method="POST"
        enctype="multipart/form-data"
        >
        @csrf
        <x-admin.creator.coin :coin="$page->coin" :query="$query" />
        <x-admin.creator.seo :model="$page->seo" />
        <x-admin.creator.article :model="$page->article" />
    </form>
@endsection