<fieldset class="filter-container">
    <legend class="filter-container-title">
        {{ __("filters.name") }}
    </legend>
    @include("partials.offcanvas.button-show", ["targetId" => "filter-group"])
    <div class="filter-group collapse" id="filter-group">
        @include("partials.offcanvas.button-close", ["targetId" => "filter-group"])
        <x-period
            :model="$values->period"
            classSection="filter-section-period"
            classTitle="filter-section-title"
            classResettable="filter-resettable-text"
            />
        <x-checkbox-collection
            :items="$parameters->countries()"
            :selectedItems="$values->countries"
            title="{{ __('filters.country') }}"
            prefixId="countries"
            name="countries[]"
            classSection="filter-section"
            classTitle="filter-section-title"
            classResettable="filter-resettable-checkbox"
            />
        <x-checkbox-collection
            :items="$parameters->nominals()"
            :selectedItems="$values->nominals"
            title="{{ __('filters.nominal') }}"
            prefixId="nominals"
            name="nominals[]"
            classSection="filter-section"
            classTitle="filter-section-title"
            classResettable="filter-resettable-checkbox"
            />
        <x-checkbox-collection
            :items="$parameters->coinages()"
            :selectedItems="$values->coinages"
            title="{{ __('filters.coinage') }}"
            prefixId="coinages"
            name="coinages[]"
            classSection="filter-section"
            classTitle="filter-section-title"
            classResettable="filter-resettable-checkbox"
            />
        <x-checkbox-collection
            :items="$parameters->materials()"
            :selectedItems="$values->materials"
            title="{{ __('filters.material') }}"
            prefixId="materials"
            name="materials[]"
            classSection="filter-section"
            classTitle="filter-section-title"
            classResettable="filter-resettable-checkbox"
            />
        <x-checkbox-collection
            :items="$parameters->currencies()"
            :selectedItems="$values->currencies"
            title="{{ __('filters.currency') }}"
            prefixId="currencies"
            name="currencies[]"
            classSection="filter-section"
            classTitle="filter-section-title"
            classResettable="filter-resettable-checkbox"
            />
        <x-checkbox-collection
            :items="$parameters->shapes()"
            :selectedItems="$values->shapes"
            title="{{ __('filters.shape') }}"
            prefixId="shapes"
            name="shapes[]"
            classSection="filter-section"
            classTitle="filter-section-title"
            classResettable="filter-resettable-checkbox"
            />
        <x-checkbox-collection
            :items="$parameters->themes()"
            :selectedItems="$values->themes"
            title="{{ __('filters.theme') }}"
            prefixId="themes"
            name="themes[]"
            classSection="filter-section"
            classTitle="filter-section-title"
            classResettable="filter-resettable-checkbox"
            />
        <x-checkbox-collection
            :items="$parameters->mintmarks()"
            :selectedItems="$values->mintmarks"
            title="{{ __('filters.mintmark') }}"
            prefixId="mintmarks"
            name="mintmarks[]"
            classSection="filter-section"
            classTitle="filter-section-title"
            classResettable="filter-resettable-checkbox"
            />
        @include("partials.filter-button")
    </div>
</fieldset>