<?php
/**
 * @var App\Models\Coin $coin
 */
?>
<div class="coin-table-reader">
    <div>
        {{ __("coin.country") }}
    </div>
    <div>
        {{ $coin->country }}
    </div>
    <div>
        {{ __("coin.nominal") }}
    </div>
    <div>
        {{ $coin->nominal }}
    </div>
    <div>
        {{ __("coin.coinage") }}
    </div>
    <div>
        {{ $coin->coinage }}
    </div>
    <div>
        {{ __("coin.material") }}
    </div>
    <div>
        {{ $coin->material }}
    </div>
    <div>
        {{ __("coin.currency") }}
    </div>
    <div>
        {{ $coin->currency }}
    </div>
    <div>
        {{ __("coin.shape") }}
    </div>
    <div>
        {{ $coin->shape }}
    </div>
    <div>
        {{ __("coin.theme") }}
    </div>
    <div>
        {{ $coin->theme }}
    </div>
    <div>
        {{ __("coin.year") }}
    </div>
    <div>
        {{ $coin->year }}
    </div>
</div>