<fieldset class="ordiring-section">
    <legend class="ordiring-section-title">
        {{ __("ordering.label") }}
    </legend>
    <x-selection
        class=""
        id="ordering-selection"
        name="ordering"
        :required="true"
        :items="$parameters"
        :selectedItem="$values->value"/>
    <input class="button icon-md"
        type="image"
        src="{{ asset('img/ordering/update.svg') }}"
        alt="{{ __('ordering.submit.label') }}"
        title="{{ __('ordering.submit.tooltip') }}">
</fieldset>