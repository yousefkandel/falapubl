@if ($paginator->hasPages())
    <nav class="admin-pagination" role="navigation" aria-label="التنقل بين الصفحات" dir="rtl">
        <ul class="admin-pagination__list">
            @if ($paginator->onFirstPage())
                <li class="is-disabled">
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                        <svg class="admin-pagination__icon" viewBox="0 0 24 24" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg>
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ __('pagination.previous') }}">
                        <svg class="admin-pagination__icon" viewBox="0 0 24 24" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg>
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="is-disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="is-active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('pagination.next') }}">
                        <svg class="admin-pagination__icon" viewBox="0 0 24 24" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
                    </a>
                </li>
            @else
                <li class="is-disabled">
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                        <svg class="admin-pagination__icon" viewBox="0 0 24 24" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
