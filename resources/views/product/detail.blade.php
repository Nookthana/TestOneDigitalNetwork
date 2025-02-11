@extends('layouts.app', [
    'activePage' => 'ProductDetail',
    'breadcrumbMenu' => [
        [
            'name' => __('homepage.homepage'),
            'url' => route('home', ['page' => 'homepage']),
        ],
        (isset($page) && $page != 'homepage' && trim($page) != '') 
        ? [
            'name' => __('homepage.' . $page), 
            'url' => route('home', ['page' => $page]),
        ] 
        : null,
        [
            'name' => collect($products)->first()['name'],  
            'url' => route('product.search.detail', ['page' => $page, 'sku' => collect($products)->first()['sku']]),  
        ],
    ]
])

<style>

.product-image {
    text-align: center;
}

.product-image img {
    max-width: 100%;
    height: auto;
}

.product-details {
    margin-top: 20px;
}

.product-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 10px;
}

.product-price {
    font-size: 20px;
    color: #007bff;
    margin-bottom: 10px;
}

.product-info {
    font-size: 16px;
    color: #666;
}

.product-info i {
    margin-right: 5px;
}




.unique-product-container {
  display: flex;
  width: 100%;
  flex-wrap: wrap; 
  align-items: flex-start; 
}

.unique-product-gallery {
  width: 50%;
  position: relative; 
}

.unique-product-main-image {
  position: relative;
  max-width: 450px; 
  max-height: 281px; 
  width: 100%; 
  height: auto; 
  overflow: hidden; 
  z-index: 1; 
}

.unique-product-main-image img {
  width: 100%; 
  height: 100%; 
  object-fit: contain; 
}

.unique-product-nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  display: flex;
  justify-content: space-between;
  width: 100%;
  padding: 0 10px;
  z-index: 2; 
}

.unique-prev-button,
.unique-next-button {
  color: white;
  border: none;
  padding: 10px;
  cursor: pointer;
  z-index: 3; 
}

.unique-product-mini-images {
  display: flex;
  justify-content: space-between; 
  flex-wrap: wrap;
  gap: 10px; 
  margin-top: 10px;
  width: 100%;
}

.unique-mini-image-container {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  width: 100%;
}

.unique-product-mini-images img {
  width: 68px; 
  height: 46px; 
  cursor: pointer;
  object-fit: cover;
}

.unique-product-details {
  width: 50%;
  padding: 20px;
  z-index: 1;
}

@media (max-width: 768px) {
  .unique-product-container {
    flex-direction: column; 
    align-items: center;
  }

  .unique-product-gallery {
    width: 100%;
  }

  .unique-product-main-image {
    width: 100%;
    max-width: 100%;
  }

  .unique-product-nav {
    display: flex;
    justify-content: space-between;
    width: 100%;
    padding: 0 10px;
  }

  .unique-product-mini-images img {
    width: 50px;
    height: 34px;
  }

  .unique-product-details {
    width: 100%;
    padding: 10px;
    text-align: center; /* จัดให้อยู่ตรงกลาง */
  }

  .unique-product-details h2 {
    font-size: 1.2rem;
  }

  .unique-product-details p {
    font-size: 1rem;
  }

}

</style>
@section('content')
    <div class="container pt-5">
        <div class="row justify-content-center ">
            <div class="col-md-10">
                <div class="product-details">
                    <h1 class="product-title">{{ collect($products)->first()['name'] }}</h1>
                    <div class="product-details">
                        <p class="product-price" style="display: inline-block; margin-right: 15px;">{{ number_format(collect($products)->first()['price']) }} บาท</p>
                        <div class="product-info" style="display: inline-block;">
                            <p style="display: inline-block; margin-right: 15px;"><i class="fas fa-calendar-alt"></i> {{ __('homepage.as_of') }} {{ $date }}</p>
                            <p style="display: inline-block; margin-right: 15px;"><i class="fas fa-eye"></i>{{ collect($products)->first()['view'] }}</p>
                        </div>
                    </div>
                </div>
                <hr>
            </div>

            <div class="col-md-10">
                <div class="unique-product-container">
                    <div class="unique-product-gallery">
                    <div class="unique-product-main-image">
                        <div class="badge-sale" style="position: absolute; top: 5px; left: 5px; background-color: yellow; color: black; padding: 5px 10px; font-size: 16px; font-weight: bold; border-radius: 20px; z-index: 3;">
                            {{ __('homepage.sale') }}
                          </div>
                        <div class="unique-main-image-container">
                            @foreach($other_products->take(4) as $product)
                            <div>
                            <img src="{{ Storage::url(optional($product->productImages->first())->image_url) }}" alt="Thumbnail 1">
                            </div>
                        @endforeach
                        </div>
                        <div class="unique-product-nav">
                        <button class="unique-prev-button"><</button>
                        <button class="unique-next-button">></button>
                        </div>
                    </div>
                    <div class="unique-product-mini-images">
                        <div class="unique-mini-image-container">
                        @foreach($other_products->take(4) as $product)
                            <div>
                            <img src="{{ Storage::url(optional($product->productImages->first())->image_url) }}" alt="Thumbnail 1">
                            </div>
                        @endforeach
                        </div>
                    </div>
                    </div>
                    <div class="unique-product-details">
                    <h2>Nomad [E]</h2>
                    <p>Know Productivity - Efficiency - Passion - Creativity with no limits. A crisp IPS display boasts everything from pomodoro timer, to a playful Tamagotchi-style companion, a trusty clock and much more.</p>
                    <p><b>Backed by science</b>
                        The integrated pomodoro timer leverages a scientifically proven work/rest methodology that is adaptable to any workflow – empowering you to accomplish more in less time.</p>
                    <p><b>Mechanical & hotswap</b>
                        We redesigned our custom keycaps to hug your fingertips even more perfectly than before. Mounted on our custom tuned “Atomic” MX Gateron hotswap switches, so you can try different switches without needing to desolder them.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center pt-5">
            <div class="col-md-auto">
                <div class="product-details">
                    <h1 class="product-title">{{ __('homepage.other_products_from') }} {{ collect($other_products)->first()['brand'] }}</h1>
                    <div class="card-container justify-content-start">
                        <div class="table-responsive">
                            <div class="d-flex flex-nowrap overflow-auto">
                                @foreach($other_products->take(4) as $product)
                                    <div class="col-md-auto col-sm-7 px-2">
                                        <div class="card-product">
                                            <div class="card-content">
                                                <a href="{{ route('product.search.detail', ['page' => $page ?? ' ', 'sku' => $product->sku]) }}"
                                                    data-toggle="tooltip" 
                                                    data-placement="top" 
                                                    title="View Product Details">
                                                    <img src="{{ Storage::url(optional($product->productImages->first())->image_url) }}" 
                                                         class="card-img-top" 
                                                         alt="Example Image"
                                                         style="cursor: pointer;" />
                                                </a>
                                                <h3>{{ $product->name }}</h3>
                                                <p>{{ $product->brand }}</p>
                                                <p class="price">{{ number_format($product->price) }} {{ __('homepage.bath') }} </p>
                                                <button class="click-card" 
                                                    data-product-name="{{ $product->name }}" 
                                                    data-sku="{{ $product->sku }}" 
                                                    data-product-price="{{ number_format($product->price) }}" 
                                                    id="{{ $product->sku }}">
                                                    {{ __('homepage.add_card') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>            
                    </div>
                </div>

                <div class="product-details">
                    <h1 class="product-title">{{ __('homepage.tar_get_product') }}</h1>
                    <div class="card-container justify-content-start">
                        <div class="table-responsive">
                            <div class="d-flex flex-nowrap overflow-auto">
                                @foreach($favorite_products->take(4) as $product)
                                    <div class="col-md-auto col-sm-7 px-2">
                                        <div class="card-product">
                                            <div class="card-content">
                                                <a href="{{ route('product.search.detail', ['page' => $page ?? ' ', 'sku' => $product->sku]) }}"
                                                    data-toggle="tooltip" 
                                                    data-placement="top" 
                                                    title="View Product Details">
                                                    <img src="{{ Storage::url(optional($product->productImages->first())->image_url) }}" 
                                                         class="card-img-top" 
                                                         alt="Example Image"
                                                         style="cursor: pointer;" />
                                                </a>
                                                <h3>{{ $product->name }}</h3>
                                                <p>{{ $product->brand }}</p>
                                                <p class="price">{{ number_format($product->price) }} บาท </p>
                                                <button class="click-card" 
                                                    data-product-name="{{ $product->name }}" 
                                                    data-sku="{{ $product->sku }}" 
                                                    data-product-price="{{ number_format($product->price) }}" 
                                                    id="{{ $product->sku }}">
                                                    {{ __('homepage.add_card') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>            
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ mix('js/pages/product/index.js') }}" type="text/javascript"></script>
@endpush
