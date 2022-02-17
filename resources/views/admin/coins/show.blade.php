<?php
/**
 * @var App\Models\CRUD\Reader\PageShow $page
 * @var string $query
 */
?>
@extends("admin.coins.layout", [
    "coins" => $page->coins,
    "form" => $page->filtersForm,
    "queryExceptPaginator" => $queryExceptPaginator,
    "actionFiltersForm" => route('admin.coins.show', ['coin' => $page->coin->id])
])

@section("dashboard")
    @include ("admin.dashboard.list", [
        "query" => $query
    ])
    @include ("admin.dashboard.create", [
        "query" => $query
    ])
    @include ("admin.dashboard.edit", [
        "coinId" => $page->coin->id,
        "query" => $query
    ])
    @include ("admin.dashboard.delete", [
        "coinId" => $page->coin->id,
        "query" => $query
    ])
    @include ("admin.dashboard.download-pdf", [
        "coinId" => $page->coin->id
    ])
@endsection

@section("main")
    <x-admin.reader.coin :model="$page->coin" :query="$query" />
    @isset ($page->seo)
        <x-admin.reader.seo :model="$page->seo" />
    @endisset
    @isset ($page->article)
        <x-admin.reader.article :model="$page->article" />
    @endisset
@endsection