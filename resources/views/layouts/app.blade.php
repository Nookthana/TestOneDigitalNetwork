<meta name="csrf-token" content="{{ csrf_token() }}">
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Homepage')</title>

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/image.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/path/to/your/favicon.ico" type="image/x-icon">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/nav.css') }}" rel="stylesheet">
    <link href="{{ mix('css/card.css') }}" rel="stylesheet">
    <link href="{{ mix('css/footer.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" type="text/javascript" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
</head>

<body>
    <div id="app">
        @include('layouts.nav')
        
        <div class="wrapper">
            @include('layouts.breadcrumb') 
        <div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card border-0"> 
                            <div class="card-body">
                                <h6 class="card-title text-center">{{ __('homepage.search_of_product') }}</h6>
                                <form action="{{ route('product.search.product.filter') }}" method="GET" id="search-product-filter" >
                                    @csrf
                                    <input type="hidden" name="data[page]" value="{{ isset($page) ? $page : ' ' }}" id="page-filter">
                                    <div class="row justify-content-center text-center pt-3 d-none d-md-flex">
                                        <div class="col-4">
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle dropdownBrand" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-tag fa-rotate-90" style="color: #74C0FC;"></i> {{ __('homepage.choose_a_brand') }}
                                                </button>
                                                <input type="hidden" name="data[brand]" id="search-brand" value=" " />
                                                <input type="hidden" name="data[sku]" id="search-product-sku" value=" " />
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    @foreach ($filter_brand as $brands)
                                                        <li><a class="dropdown-item" data-type="brand" href="#">{{ $brands }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                              
                                        </div>
                                        <div class="col-4">
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle dropdownProduct" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-filter" style="color: #74C0FC;"></i> {{ __('homepage.choose_a_product') }}
                                                </button>
                                                <input type="hidden" name="data[product]" id="search-product" value=" "/>
                                                <ul class="dropdown-menu product-list" aria-labelledby="dropdownMenuButton2">
                                                    @foreach ($products as $product)
                                                        <li><a class="dropdown-item" data-type="product" data-sku="{{ $product->sku }}" href="#">{{ $product->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
            
                                        <div class="button-container">
                                            <button class="search-button" type="submit">{{ __('homepage.search') }}</button>
                                            <button class="reset-button" type="reset"> {{ __('homepage.reset') }} <i class="fa fa-arrow-rotate-right"></i></button>
                                          </div>
                                    </div>
            
                                    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detailsModalLabel">{{ __('homepage.detailed_search') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row justify-content-center text-center pt-3">
                                                        <div class="col-auto">
                                                            <div class="dropdown">
                                                                <button class="btn dropdown-toggle dropdownBrand" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa fa-tag fa-rotate-90" style="color: #74C0FC;"></i> {{ __('homepage.choose_a_brand') }}
                                                                </button>
                                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                    @foreach ($filter_brand as $brands)
                                                                        <li><a class="dropdown-item" data-type="brand" href="#">{{ $brands }}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            <div class="dropdown">
                                                                <button class="btn dropdown-toggle dropdownProduct" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa fa-filter" style="color: #74C0FC;"></i> {{ __('homepage.choose_a_product') }}
                                                                </button>
                                                                <ul class="dropdown-menu product-list" aria-labelledby="dropdownMenuButton2">
                                                                    @foreach ($products as $product)
                                                                        <li><a class="dropdown-item" data-type="product" data-sku="{{ $product->sku }}" href="#">{{ $product->name }}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="button-container">
                                                        <button class="search-button" type="submit">{{ __('homepage.search')  }}</button>
                                                        <button class="reset-button">{{ __('homepage.reset')  }}<i class="fa fa-arrow-rotate-right"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            
                                </form>

                                <div class="d-md-none">
                                    <div class="button-container">
                                        <button class="search-button" data-bs-toggle="modal" data-bs-target="#detailsModal">
                                            <i class="fa fa-bars" style="color: #ffffff;"></i> {{ __('homepage.detailed_search') }}
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
        </div>
        
        @include('layouts.footer') 
    </div>

    @stack('scripts')
    <script>
        const locale = @json(app()->getLocale());
        var translations = @json(mergeTranslationFiles());
        const product_all = {!! json_encode($products) !!};
        const route = @json(route('product.search'));

        $(function () {
            $(document).on('click', '.dropdown-item', function (event) {
                if ($(this).data('type') == 'brand') {
                    $('.dropdownBrand').text($(this).text());
                    $('#search-brand').val($(this).text());
                    searchProductByBrand(event);  
                    $('.dropdownProduct').html(`<i class="fa fa-filter" style="color: #74C0FC;"></i>${translate('homepage.choose_a_product')}`);
                } else {
                    $('.dropdownProduct').text($(this).text());
                    $('#search-product').val($(this).text());
                    $('#search-product-sku').val($(this).data('sku'));
                }
            });

            $(document).on('click', '.reset-button', function (event) {
                $('.dropdownBrand').html(`<i class="fa fa-tag fa-rotate-90" style="color: #74C0FC;"></i> ${translate('homepage.choose_a_brand')}`);
                $('.dropdownProduct').html(`<i class="fa fa-filter" style="color: #74C0FC;"></i> ${translate('homepage.choose_a_product')}`);
                $('#search-brand').val('');
                $('#search-product').val('');

                let new_list = '';
                $('.dropdown-menu.product-list').empty();
                product_all.forEach(e => {
                    new_list += `<li><a class="dropdown-item" data-sku="${e.sku}" data-type="product" href="#">${e.name}</a></li>`;
                });
                $('.dropdown-menu.product-list').append(new_list);
            });

            function searchProductByBrand(e) {
                e.preventDefault();      
                $.ajax({
                    url: route,  
                    type: 'GET',  
                    data: {
                        page: $('#page-filter').val(),
                        product: $('#search-product').val(),
                        sku: $('#search-product-sku').val(),
                        brand: $('#search-brand').val(),
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        if (response.success == true) {
                                const data = response.data;
                                let new_list = '';
                                $('.dropdown-menu.product-list').empty();
                                data.forEach(e => {
                                    new_list += `<li><a class="dropdown-item" data-sku="${e.sku}" data-type="product" href="#">${e.name}</a></li>`;
                                });
                                $('.dropdown-menu.product-list').append(new_list);
                            } else {
                                console.log('Error:', response.massage);
                            }
                        
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                    }
                });
            }
        });

    </script>
</body>
</html>
