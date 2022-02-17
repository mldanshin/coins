<?php
/**
 * @var string $query
 */
?>
<a class="button" 
    href="{{ route('admin.index') }}@if($query){{ "?$query" }}@endif"
    title="{{ __('dashboard.list.tooltip') }}"
    tabindex="0"
    >
    <img class="icon" src="{{ asset('img/dashboard/list.svg') }}" alt="button-list">
</a>