<select @if ($class !== null) class="{{ $class }}" @endif
    id="{{ $id }}" name="{{ $name }}"
    @if ($required === true) required @endif
    >
    @if ($selectedItem === null || $required === false)
        <option value=""
            @if ($selectedItem === null) selected @endif
            @if ($required === true) disabled @endif
            >
            ----
        </option>
    @endif

    @if ($required === true && $selectedItem !== null)
        <option value="" style="display: none">----</option>
    @endif

    @foreach ($items as $item)
        <option value="{{ $item->id }}"
            @if ($item->id == $selectedItem) selected @endif
            >
            <span>{{ $item->name }}</span>
        </option>
    @endforeach
</select>