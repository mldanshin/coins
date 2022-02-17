<?php
/**
 * @var App\Models\CRUD\Editor\Picture\Source $source
 */
?>
<div class="flex-row justify-content-center grid-row-2 @if($source->type === PictureType::obverse){{ "grid-column-1" }}@else{{ "grid-column-2" }}@endif"
    id="picture-@if($source->type === PictureType::obverse){{ "obverse" }}@else{{ "reverse" }}@endif-container"
    >
    <figure class="flex-column justify-content-center">
        <img class="coin-picture"
            src="{{ asset($source->outside) }}"
            alt="@if ($source->type === PictureType::obverse) {{ "picture coin obverse" }} @else {{ "picture coin reverse" }} @endif"
            width="140">
    </figure>
    <button class="button picture-button-close icon-sm"
        type="button"
        title="{{ __('dashboard.delete.tooltip') }}"
        tabindex="0"
        >
        <img src="{{ asset('img/dashboard/close.svg') }}" alt="button close">
    </button>
    <input type="hidden"
        name="@if($source->type === PictureType::obverse){{ "picture-obverse" }}@else{{ "picture-reverse" }}@endif"
        value="{{ $source->inside }}">
</div>