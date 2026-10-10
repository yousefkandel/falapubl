<div style="max-width:1180px; margin: 0 auto 20px; color: rgba(248,245,240,.75);">
    {{ __('messages.search_results_for') }} «{{ $search }}» ({{ $total }} {{ $unit ?? __('messages.results') }})
    <a href="{{ $clearUrl }}" class="fk-link" style="margin-inline-start:10px;" data-search-clear>{{ __('messages.clear_search') }}</a>
</div>
