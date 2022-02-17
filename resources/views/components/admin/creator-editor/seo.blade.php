<section class="coin-card">
    <h2 class="text-center">{{ __("seo.section_title") }}</h2>

    <div class="coin-table-editor">
        <div class="coin-table-label">{{ __("seo.title.name") }}</div>
        <textarea class="coin-table-value" name="seo-title">{{ $title }}</textarea>
        <small class="coin-table-help">{{ __("seo.title.rule") }}</small>
        @error("seo-title")
            <em class="coin-table-alert">
                {{ $message }}
            </em>
        @enderror
    
        <div class="coin-table-label">{{ __("seo.description.name") }}</div>
        <textarea class="coin-table-value" name="seo-description">{{ $description }}</textarea>
        <small class="coin-table-help">{{ __("seo.description.rule") }}</small>
        @error("seo-description")
            <em class="coin-table-alert">
                {{ $message }}
            </em>
        @enderror
    
        <div class="coin-table-label">{{ __("seo.keywords.name") }}</div>
        <textarea class="coin-table-value" name="seo-keywords">{{ $keywords }}</textarea>
        <small class="coin-table-help">{{ __("seo.keywords.rule") }}</small>
        @error("seo-keywords")
            <em class="coin-table-alert">
                {{ $message }}
            </em>
        @enderror
    </div>
</section>