<?php
/**
 * @var Illuminate\Pagination\LengthAwarePaginator $paginator
 * @var string $query
 */
?>
@if ($paginator->hasPages())
    <nav class="text-center">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="pagination-disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&#10094;</span>
                </li>
            @else
                <li>
                    <a class="pagination-button"
                        href="{{ $paginator->previousPageUrl() }}&{{ $query }}"
                        rel="prev"
                        aria-label="@lang('pagination.previous')"
                        tabindex="0"
                        >
                        &#10094;
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="pagination-disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination-active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li>
                                <a class="pagination-button" href="{{ $url }}@if($query){{ "&$query" }}@endif" tabindex="0">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a class="pagination-button" href="{{ $paginator->nextPageUrl() }}@if($query){{ "&$query" }}@endif" tabindex="0" rel="next" aria-label="@lang('pagination.next')">&#10095;</a>
                </li>
            @else
                <li class="pagination-disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&#10095;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
