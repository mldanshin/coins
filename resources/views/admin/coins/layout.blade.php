<?php
/**
 * @var Illuminate\Pagination\LengthAwarePaginator $coins
 * @var App\Models\CRUD\Filters\Form $form
 * @var string $queryExceptPaginator
 * @var string $actionFiltersForm
 */
?>
@extends("admin.layout")

@section("content")
    <div class="admin-coins-container">
        <aside class="admin-coins-list">
            <form class="flex-column" method="GET" action="{{ $actionFiltersForm }}">
                <details class="ordiring-container">
                    <summary class="text-center margin-1">
                        {{ __("ordering.name") }}
                    </summary>
                    <x-ordering :model="$page->orderingForm" />
                </details>
                <details class="filter-container">
                    <summary class="filter-container-title text-center">
                        {{ __("filters.name") }}
                    </summary>
                    <x-admin.filters :model="$form" />
                </details>
            </form>
            <x-admin.coins-short :paginator="$coins" :queryExceptPaginator="$queryExceptPaginator" />
        </aside>
        <div class="coin-container">
            <div class="coin-dashboard">
                @yield("dashboard")
            </div>
            <main>
                @yield("main")
            </main>
        </div>
    </div>
@endsection