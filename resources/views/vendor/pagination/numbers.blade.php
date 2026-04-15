@if ($paginator->hasPages())
    <ul class="pagination">
        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <li class="page-item {{ ($page == $paginator->currentPage()) ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
            @endif
        @endforeach
    </ul>
@endif
