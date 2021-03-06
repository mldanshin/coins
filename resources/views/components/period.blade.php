<fieldset class="{{ $classSection }}">
    <legend class="{{ $classTitle }}">{{ __("period.title") }}</legend>
    <label for="period_first">{{ __("period.fast") }}</label>
    <input class="date-year {{ $classResettable }}"
        id="period_first"
        type="text"
        name="period_first"
        value="{{ $first }}"
        pattern="^[1-9][0-9]{3}$"
        maxlength="4">
    <label for="period_last">{{ __("period.last") }}</label>
    <input class="date-year {{ $classResettable }}"
        id="period_last"
        type="text"
        name="period_last"
        value="{{ $last }}"
        pattern="^[1-9][0-9]{3}$"
        maxlength="4">
</fieldset>