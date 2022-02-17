<div class="{{ $class }}">
    <figure>
        <img class="coin-picture"
            src="{{ asset($obverse) }}"
            alt="{{ $obverseDescription }}"
            width="{{ $width }}">
    </figure>
    <figure>
        <img class="coin-picture"
            src="{{ asset($reverse) }}"
            alt="{{ $reverseDescription }}"
            width="{{ $width }}">
    </figure>
</div>