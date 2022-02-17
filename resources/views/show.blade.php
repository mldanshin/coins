<?php
/**
 * @var App\Models\PageShow $page
 * @var string $query
 */
?>
@extends("layout", ["page" => $page])

@isset ($page->seo)
    @section("title")
        {{ $page->seo->title }}
    @endsection

    @section("meta-description")
        {{ $page->seo->description }}
    @endsection

    @section("meta-keywords")
        {{ $page->seo->keywords }}
    @endsection
@endisset

@section("content")
    <main class="flex-column align-items-center gap-row-1 margin-y-1">
        <a href="{{ route('index', ['lang' => App::currentLocale()]) }}@if($query){{ "?$query" }}@endif" title="{{ __('coins.return.label') }}">
            {{ __("coins.return.label") }}
        </a>
        <x-coin :model="$page->coin" />
        @isset ($page->article)
            <x-article :model="$page->article" />
        @endisset
    </main>
@endsection