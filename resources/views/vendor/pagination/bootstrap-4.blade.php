@if ($paginator->hasPages())
    <div style="display: flex; justify-content: center; gap: 0.5rem; margin-top: 2rem; flex-wrap: wrap;">
        @if ($paginator->onFirstPage())
            <span style="padding: 0.5rem 1rem; background: #e5e7eb; color: #9ca3af; border-radius: 0.5rem;">← Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" style="padding: 0.5rem 1rem; background: #667eea; color: white; border-radius: 0.5rem; text-decoration: none;">← Previous</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span style="padding: 0.5rem 1rem; background: #e5e7eb; color: #9ca3af; border-radius: 0.5rem;">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span style="padding: 0.5rem 1rem; background: #667eea; color: white; border-radius: 0.5rem;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="padding: 0.5rem 1rem; background: #f3f4f6; color: #374151; border-radius: 0.5rem; text-decoration: none;">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" style="padding: 0.5rem 1rem; background: #667eea; color: white; border-radius: 0.5rem; text-decoration: none;">Next →</a>
        @else
            <span style="padding: 0.5rem 1rem; background: #e5e7eb; color: #9ca3af; border-radius: 0.5rem;">Next →</span>
        @endif
    </div>
@endif
