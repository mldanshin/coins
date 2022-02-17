<?php
/**
 * @var int $formId
 */
?>
<input type="image"
    form="{{ $formId }}"
    class="button icon"
    src="{{ asset('img/dashboard/store.svg') }}"
    alt="button-store"
    title="{{ __('dashboard.store.tooltip') }}"
    tabindex="0">