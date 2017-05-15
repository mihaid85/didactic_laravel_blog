@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
            <li class="page-item disabled"><span class="page-link">Previous</span></li>
        @else
            <li><a href="{{ $paginator->url('1') }}" rel="prev">&laquo;</a></li>
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a></li>
            <li><a href="{{ $paginator->url($paginator->lastPage()) }}" rel="next">&raquo;</a></li>
        @else
            <li class="disabled"><span>Next</span></li>
            <li class="disabled"><span>&raquo;</span></li>
        @endif
    </ul>
@endif
