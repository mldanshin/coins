<?php
/**
 * @var int $coinId
 * @var string $query
 */
?>
<a class="button"
    href="{{ route('admin.coins.show', ['coin' => $coinId]) }}@if($query){{ "?$query" }}@endif"
    title="{{ __('dashboard.show.tooltip') }}"
    tabindex="0"
    >
    <img class="icon" src="{{ asset('img/dashboard/show.svg') }}" alt="button-show">
</a>