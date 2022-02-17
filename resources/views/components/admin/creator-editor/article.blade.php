<section class="coin-card">
    <h2 class="text-center">{{ __("article.section_title") }}</h2>

    <div class="coin-table-editor">
        <div class="coin-table-label">{{ __("article.title.name") }}</div>
        <textarea class="coin-table-value" id="article-title" name="article-title">{{ $title }}</textarea>
        <small class="coin-table-help">{{ __("article.title.rule") }}</small>
        @error("article-title")
            <em class="coin-table-alert">
                {{ $message }}
            </em>
        @enderror
    
        <div class="coin-table-label">{{ __("article.content.name") }}</div>
        <textarea class="coin-table-value" name="article-content">{{ $content }}</textarea>
        @error("article-content")
            <em class="coin-table-alert">
                {{ $message }}
            </em>
        @enderror
    </div>
</section>