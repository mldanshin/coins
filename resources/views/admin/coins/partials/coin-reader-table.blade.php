<?php
/**
 * @var App\Models\CRUD\Reader\Coin $coin
 */
?>
<div class="coin-table-reader">
    <div>
        {{  __("coin.country") }}
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
    @isset ($coin->mintmark)
        <div>
            {{ __("coin.mintmark") }}
        </div>
        <div>
            {{ $coin->mintmark }}
        </div>
    @endisset
    <div>
        {{ __("coin.year") }}
    </div>
    <div>
        {{ $coin->year }}
    </div>
    <div>
        {{ __("coin.quality") }}
    </div>
    <div>
        {{ $coin->quality }}
    </div>
    <div>
        {{ __("coin.storage") }}
    </div>
    <div>
        {{ $coin->storage }}
    </div>
</div>