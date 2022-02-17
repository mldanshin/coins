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
    "actionFiltersForm" => route('admin.coins.edit', ["coin" => $page->coin->id])
])

@section("dashboard")
    @include ("admin.dashboard.list", [
        "query" => $query
    ])
    @include ("admin.dashboard.create", [
        "query" => $query
    ])
    @include ("admin.dashboard.show", [
        "coinId" => $page->coin->id,
        "query" => $query
    ])
    @include ("admin.dashboard.update", [
        "coinId" => $page->coin->id,
        "formId" => "coin-update"
    ])
    @include ("admin.dashboard.delete", [
        "coinId" => $page->coin->id,
        "query" => $query
    ])
@endsection

@section("main")
    <form id="coin-update"
        action="{{ route('admin.coins.update', ["coin" => $page->coin->id]) }}@if($query){{ "?$query" }}@endif"
        method="POST"
        enctype="multipart/form-data"
        >
        @csrf
        @method("PUT")
        <x-admin.editor.coin :coin="$page->coin" :query="$query" />
        <x-admin.editor.seo :model="$page->seo" />
        <x-admin.editor.article :model="$page->article" />
    </form>
@endsection