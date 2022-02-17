<?php
/**
 * @var string $targetId
 */
?>
<button class="button collapse-button-show"
    type="button"
    data-target="{{ $targetId }}"
    title="{{ __("offcanvas.button.show.tooltip") }}"
    tabindex="0"
    >
    <img class="icon-md"
        src="{{ asset("img/offcanvas/expand.svg") }}" 
        alt="{{ __("offcanvas.button.show.label") }}"
        />
</button>