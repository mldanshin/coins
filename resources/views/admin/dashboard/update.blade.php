<?php
/**
 * @var int $formId
 */
?>
<input type="image"
    form="{{ $formId }}"
    class="button icon"
    src="{{ asset('img/dashboard/update.svg') }}"
    alt="button-update"
    title="{{ __('dashboard.update.tooltip') }}"
    tabindex="0">