<section class="coin-card">
    <h2 class="text-center">
        {{ __("coin.section_title") }}
    </h2>
    @if (isset($coin->picture))
        <x-admin.picture :model="$coin->picture" width="140" />
    @else
        <x-admin.picture :model="null" width="140" />
    @endif
    @isset($coin->id)
        <input name="coin-id" value="{{ $coin->id }}" type="hidden">
    @endisset
    <div class="coin-table-editor">
        <div class="coin-table-label">
            {{ __("coin.country") }}
        </div>
        <x-selection class="coin-table-value"
            id="coin-country"
            name="coin-country"
            :required="true"
            :items="$coin->parameters->countries()"
            :selectedItem="$coin->country"
            />
        <div class="coin-table-label">
            {{ __("coin.nominal") }}
        </div>
        <x-selection class="coin-table-value"
            id="coin-nominal"
            name="coin-nominal"
            :required="true"
            :items="$coin->parameters->nominals()"
            :selectedItem="$coin->nominal"
            />
        <div class="coin-table-label">
            {{ __("coin.coinage") }}
        </div>
        <x-selection class="coin-table-value"
            id="coin-coinage"
            name="coin-coinage"
            :required="true"
            :items="$coin->parameters->coinages()"
            :selectedItem="$coin->coinage"
            />
        <div class="coin-table-label">
            {{ __("coin.material") }}
        </div>
        <x-selection class="coin-table-value"
            id="coin-material"
            name="coin-material"
            :required="true"
            :items="$coin->parameters->materials()"
            :selectedItem="$coin->material"
            />
        <div class="coin-table-label">
            {{ __("coin.currency") }}
        </div>
        <x-selection class="coin-table-value"
            id="coin-currency"
            name="coin-currency"
            :required="true"
            :items="$coin->parameters->currencies()"
            :selectedItem="$coin->currency"
            />
        @error("coin-currency")
            <em class="coin-table-alert">
                {{ $message }}
            </em>
        @enderror
        <div class="coin-table-label">
            {{ __("coin.shape") }}
        </div>
        <x-selection class="coin-table-value"
            id="coin-shape"
            name="coin-shape"
            :required="true"
            :items="$coin->parameters->shapes()"
            :selectedItem="$coin->shape"
            />
        <div class="coin-table-label">
            {{ __("coin.theme") }}
        </div>
        <x-selection class="coin-table-value"
            id="coin-theme"
            name="coin-theme"
            :required="true"
            :items="$coin->parameters->themes()"
            :selectedItem="$coin->theme"
            />
        <div class="coin-table-label">
            {{ __("coin.mintmark") }}
        </div>
        <x-selection class="coin-table-value"
            id="coin-mintmark"
            name="coin-mintmark"
            :required="false"
            :items="$coin->parameters->mintmarks()"
            :selectedItem="$coin->mintmark"
            />
        <label for="coin-year" class="coin-table-label">
            {{ __("coin.year") }}
        </label>
        <input class="coin-table-value"
            id="coin-year"
            type="text"
            name="coin-year"
            value="{{ $coin->year }}"
            pattern="^[1-9][0-9]{3}$"
            maxlength="4"
            required>
        <div class="coin-table-label">
            {{ __("coin.quality") }}
        </div>
        <x-selection class="coin-table-value"
            id="coin-quality"
            name="coin-quality"
            :required="true"
            :items="$coin->parameters->qualities()"
            :selectedItem="$coin->quality"
            />
        <div class="coin-table-label">
            {{ __("coin.storage") }}
        </div>
        <x-selection class="coin-table-value"
            id="coin-storage"
            name="coin-storage"
            :required="true"
            :items="$coin->parameters->storages()"
            :selectedItem="$coin->storage"
            />
    </div>
</section>