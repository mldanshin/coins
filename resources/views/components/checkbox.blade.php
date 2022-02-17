<input @if(!empty($class)) {{ "class=" . $class }} @endif
    id="{{ $id }}"
    type="checkbox"
    name="{{ $name }}"
    value="{{ $value }}"
    @if ($isSelected === true) {{ "checked" }} @endif>
<label for="{{ $id }}">{{ $label }}</label>