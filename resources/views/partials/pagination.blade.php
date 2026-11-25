@if ($paginator->hasPages())
  <nav class="ap-pagination" aria-label="Product pages">
    {{-- Previous --}}
    @if ($paginator->onFirstPage())
      <span class="pg-nav is-disabled" aria-disabled="true"><i class="fa-solid fa-arrow-left-long"></i> Previous</span>
    @else
      <a href="{{ $paginator->previousPageUrl() }}" class="pg-nav" rel="prev"><i class="fa-solid fa-arrow-left-long"></i> Previous</a>
    @endif

    {{-- Page numbers --}}
    <ul>
      @foreach ($elements as $element)
        @if (is_string($element))
          <li class="dots">…</li>
        @endif

        @if (is_array($element))
          @foreach ($element as $page => $url)
            <li>
              @if ($page == $paginator->currentPage())
                <a href="{{ $url }}" class="active" aria-current="page">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</a>
              @else
                <a href="{{ $url }}">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</a>
              @endif
            </li>
          @endforeach
        @endif
      @endforeach
    </ul>

    {{-- Next --}}
    @if ($paginator->hasMorePages())
      <a href="{{ $paginator->nextPageUrl() }}" class="pg-nav" rel="next">Next <i class="fa-solid fa-arrow-right-long"></i></a>
    @else
      <span class="pg-nav is-disabled" aria-disabled="true">Next <i class="fa-solid fa-arrow-right-long"></i></span>
    @endif
  </nav>
@endif