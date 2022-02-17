<?php
/**
 * @var int $coinId
 * @var string $query
 */
?>
<a class="button"
    href="{{ route('admin.coins.edit', ['coin' => $coinId]) }}@if($query){{ "?$query" }}@endif"
    title="{{ __('dashboard.edit.tooltip') }}"
    tabindex="0"
    >
    <img class="icon" src="{{ asset('img/dashboard/edit.svg') }}" alt="button-edit">
</a>