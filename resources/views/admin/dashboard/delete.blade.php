<?php
/**
 * @var int $coinId
 * @var string $query
 */
?>
<form action="{{ route('admin.coins.destroy', ['coin' => $coinId]) }}@if($query){{ "?$query" }}@endif" method="POST">
    @method('DELETE')
    @csrf
    <input type="image"
        class="button button-delete icon"
        src="{{ asset('img/dashboard/delete.svg') }}"
        alt="button delete"
        title="{{ __('dashboard.delete.tooltip') }}"
        tabindex="0">
</form>