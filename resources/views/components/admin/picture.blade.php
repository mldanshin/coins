<div class="picture-editor">
    <div class="grid-column-1 grid-row-1 text-center">{{ __("coin.picture.obverse") }}</div>
    @if ($obverse !== null)
        @include("admin.coins.partials.picture", ["source" => $obverse])
    @endif
    <label class="button grid-column-1 grid-row-3 align-self-center"
        for="picture-obverse-button"
        title="{{ __("dashboard.upload_picture.tooltip") }}"
        >
        <img class="icon-lg" src="{{ asset("img/dashboard/upload.svg") }}" alt="{{ __("dashboard.upload_picture.label") }}">
    </label>
    <input class="picture-file-add"
        id="picture-obverse-button"
        type="file"
        name="picture-obverse-file"
        data-name-target="picture-obverse"
        accept="{{ $supportedExtensions }}"
        data-url="{{ route('admin.partials.upload_picture') }}"
        data-target-id="picture-obverse-container"
        style="display: none">
    <div class="grid-column-2 grid-row-1 text-center">{{ __("coin.picture.reverse") }}</div>
    @if ($reverse !== null)
        @include("admin.coins.partials.picture", ["source" => $reverse])
    @endif
    <label class="button grid-column-2 grid-row-3 align-self-center"
        for="picture-reverse-button"
        title="{{ __("dashboard.upload_picture.tooltip") }}"
        >
        <img class="icon-lg" src="{{ asset("img/dashboard/upload.svg") }}" alt="{{ __("dashboard.upload_picture.label") }}">
    </label>
    <input class="picture-file-add"
        id="picture-reverse-button"
        type="file"
        name="picture-reverse-file"
        accept="{{ $supportedExtensions }}"
        data-url="{{ route('admin.partials.upload_picture') }}"
        data-target-id="picture-reverse-container"
        style="display: none">
</div>