@extends('layouts.app', [
    'activePage' => 'HomePage',
    'breadcrumbMenu' => [
        [
            'name' => __('homepage.homepage'),
            'url' => route('home', ['page' => 'homepage']),
        ],
        isset($page) && $page != 'homepage' && trim($page) != ''
            ? [
                'name' => __('homepage.' . $page),
                'url' => route('home', ['page' => $page]),
            ]
            : null,
    ],
])

<style>
    .products-scroll-container {
        overflow-x: auto;
        padding-bottom: 10px;
    }

    .row {
        display: flex;
        gap: 20px; 
    }

    .card-product {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
    }
</style>
@section('content')
    <div class="card-container">
        <div class="products-scroll-container">
            @foreach ($products->chunk(4) as $chunk)
                <div class="row flex-nowrap">
                    @foreach ($chunk as $product)
                        <div class="col-7 col-sm-4 col-md-auto mb-4">
                            <div class="card-product">
                                <div class="card-content">
                                    <a href="{{ route('product.search.detail', ['page' => $page ?? ' ', 'sku' => $product->sku]) }}"
                                        data-toggle="tooltip" data-placement="top" title="View Product Details">
                                        <img src="{{ Storage::url(optional($product->productImages->first())->image_url) }}"
                                            class="card-img-top" alt="Example Image" style="cursor: pointer;" />
                                    </a>
                                    <h3>{{ $product->name }}</h3>
                                    <p>{{ $product->brand }}</p>
                                    <p class="price">{{ number_format($product->price) }} {{ __('homepage.bath') }} </p>
                                    <button class="click-card" data-product-name="{{ $product->name }}" data-sku="{{ $product->sku }}"
                                        data-product-price="{{ number_format($product->price) }}"
                                        id="{{ $product->sku }}">{{ __('homepage.add_card') }}</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        
        {{-- <form action="{{ route('product.images') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="image" id="image" class="form-control" required>
                <button type="submit" class="btn btn-primary">submit</button>
             </form> --}}


    </div>
@endsection

@push('scripts')
    <script src="{{ mix('js/pages/homepage/index.js') }}" type="text/javascript"></script>
@endpush
