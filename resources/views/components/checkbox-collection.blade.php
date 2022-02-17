<fieldset class="{{ $classSection }}">
    <legend class="{{ $classTitle }}">{{ $title }}</legend>
    @foreach ($items as $item)
        @php $isSelected = false; @endphp
        @foreach ($selectedItems as $selectedItem)
            @if ($selectedItem == $item->id)
                @php $isSelected = true; @endphp
            @endif
        @endforeach
        <x-checkbox
            :item="$item"
            :id="$prefixId"
            :class="$classResettable"
            :name="$name"
            :isSelected="$isSelected"
            />
    @endforeach
</fieldset>