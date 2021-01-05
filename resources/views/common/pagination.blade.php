@if ($paginator->hasPages())
    <ul class="pagination justify-content-end">

        {{-- Anterior --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <a class="page-link"  aria-hidden="true">Anterior</a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link"  href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Anterior</a>
            </li>
        @endif

        {{-- Elementos de paginación --}}
        @foreach ($elements as $element)
        {{-- "Separador de tres puntos --}}
            @if (is_string($element))
            <li class="disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

        {{-- Listado de Paginas --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active page-item" aria-current="page"><a class="page-link" tabindex="-1" aria-disabled="true" >{{ $page }}</a></li>
                    @else
                        <li><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

         {{-- Siguientes --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link"  href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Siguiente</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <a class="page-link"  aria-hidden="true">Siguiente</a>
            </li>
    @endif

@endif
