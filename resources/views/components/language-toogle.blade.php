<ul class="flex-column gap-1">
    @foreach ($languages->items as $language)
        <li @if ($language->id === $languages->current->id) {!! "class=\"language-active\"" !!} @endif >
            <a href="{{ route('index', ['lang' => $language->id]) }}@if($query){{ "?$query" }}@endif">
                {{ $language->name }}
            </a>
        </li>
    @endforeach
</ul>