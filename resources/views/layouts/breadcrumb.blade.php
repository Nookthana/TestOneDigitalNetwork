<div class="page-breadcrumb breadcrumb-sticky pt-4">
    <div class="container"> <div class="row align-items-center">
            <div class="col-auto">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        @foreach ($breadcrumbMenu as $breadcrumb)
                            @if ($breadcrumb)
                                <li class="breadcrumb-item">
                                    <a href="{{ $breadcrumb['url'] }}" style="text-decoration: none; color: black;">{{ $breadcrumb['name'] }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </nav>
                
            </div>
        </div>
    </div>
</div>