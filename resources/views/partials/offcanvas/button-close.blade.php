<?php
/**
 * @var string $targetId
 */
?>
<button class="button collapse-button-close"
    type="button"
    data-target="{{ $targetId }}"
    title="{{ __("offcanvas.button.close.tooltip") }}"
    tabindex="0"
    >
    <img class="icon-md"
        src="{{ asset("img/offcanvas/collapse.svg") }}" 
        alt="{{ __("offcanvas.button.close.label") }}"
        />
</button>