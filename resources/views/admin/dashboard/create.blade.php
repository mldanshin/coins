<?php
/**
 * @var string $query
 */
?>
<a class="button"
    href="{{ route('admin.coins.create') }}@if($query){{ "?$query" }}@endif"
    title="{{ __('dashboard.create.tooltip') }}"
    tabindex="0"
    >
    <img class="icon" src="{{ asset('img/dashboard/create.svg') }}" alt="button-create">
</a>