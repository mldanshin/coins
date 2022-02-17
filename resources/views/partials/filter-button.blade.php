<div class="filter-buttons">
    <button class="button"
        id="filter-reset"
        type="button"
        title="{{ __('filters.reset.tooltip') }}"
        tabindex="0"
        >
        <img class="icon-lg"
            src="{{ asset("img/filter/reset.svg") }}"
            alt="{{ __('filters.reset.label') }}">
    </button>
    <input class="button icon-lg"
        type="image"
        src="{{ asset('img/filter/search.svg') }}"
        alt="{{ __('filters.submit.label') }}"
        title="{{ __('filters.submit.tooltip') }}">
</div>