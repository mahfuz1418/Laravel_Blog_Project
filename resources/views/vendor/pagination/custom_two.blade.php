<div class="pagination">
        <div class="container-fluid">
            <div class="pagination-area">
                <div class="row"> 
                    <div class="col-lg-12">
                        <div class="pagination-list">
                            <ul class="list-inline">
                                @if ($paginator->onFirstPage())
                                    <li class=" disabled"><a href="#" tabindex="-1"><i class="las la-arrow-left"></i></a></li>
                                @else
                                    <li class=""><a href="{{ $paginator->previousPageUrl() }}"><i
                                                class="las la-arrow-left"></i></a></li>
                                @endif
            
                                @foreach ($elements as $element)
                                    @if (is_string($element))
                                        <li class=" disabled">{{ $element }}</li>
                                    @endif
                                    @if (is_array($element))
                                        @foreach ($element as $page => $url)
                                            @if ($page == $paginator->currentPage())
                                                <li class=" active"><a href="#"
                                                        class="active">{{ $page }}</a></li>
                                            @else
                                                <li class=""><a href="{{ $url }}">{{ $page }}</a></li>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
            
                                @if ($paginator->hasMorePages())
                                    <li>
                                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="las la-arrow-right"></i></a>
                                    </li>
                                @else
                                    <li class="disabled">
                                        <a href="#"><i class="las la-arrow-right"></i></a>
                                    </li>
                                @endif
            
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
