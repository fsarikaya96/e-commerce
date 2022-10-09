@extends('layouts.app')
@section('title','Ana Sayfa')
@section('content')
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
        <div class="carousel-indicators">
            @for($i=0; $i<count($sliders); $i++)
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $i }}"
                        class="{{ $i == 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide  {{ $i }}"></button>
            @endfor
        </div>
        <div class="carousel-inner">
            @foreach($sliders as $key=>$slider)
                <div class="carousel-item {{ $key==0 ? 'active' : '' }}">
                    <img src="{{ $slider->image }}" class="d-block w-100" alt="..." height="750">
                    <div class="carousel-caption d-none d-md-block">
                        <div class="custom-carousel-content">
                            <h1><span>{{ $slider->title }}</span></h1>
                            <p>{!! $slider->description !!}</p>
                            <div>
                                <a href="{{ $slider->link }}" class="btn btn-slider">
                                    Alışverişe Başla
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="py-5 bg-white">
            <div class="container">
                <div class="row justify-content center">
                    <div class="col-md-8 text-center">
                        <h4>JFeel E-Ticaret Sitesine Hoşgeldiniz.</h4>

                        <div class="underline mx-auto"></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque deleniti in incidunt nemo
                            omnis quod saepe? Magnam, perferendis, placeat!
                            Libero, magni, numquam. Beatae dolore, eius illo ipsum itaque maiores rerum. Lorem ipsum
                            dolor sit amet, consectetur adipisicing elit.
                            Maiores, ullam voluptatum! Beatae eaque error illum inventore ipsum perspiciatis quidem
                            unde!
                        </p>
                    </div>
                </div>
            </div>
        </div>
        {{--    Trend Ürünler    --}}
        <div class="py-5 bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Trend Ürünler
                        <a href="{{ route('frontend.products.trends') }}" class="btn btn-warning float-end">Daha Fazla Görüntüle</a>
                        </h4>
                        <div class="underline"></div>
                    </div>
                    @if($trendingProducts)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme trending-product">
                        @forelse($trendingProducts as $product)

                                <div class="item">
                                    <div class="product-card">
                                        <div class="product-card-img">
                                            <label class="stock bg-danger">Trend</label>
                                            @if($product->productImages->count() > 0)
                                                <div class="img-hover">
                                                    <img src="{{ asset($product->productImages[0]->image) }}"
                                                         alt="Laptop">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="product-card-body">
                                            <a href="{{ url("collections/".$product->category->slug."/".$product->slug) }}">
                                                <p class="product-brand">{{ $product->brand }}</p>
                                                <h5 class="product-name">{{ $product->name }}</h5>
                                            </a>
                                            <div>
                                                <span class="selling-price">{{ $product->selling_price }} TL</span>
                                                <span class="original-price">{{ $product->original_price }} TL</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        @empty
                        </div>
                            <div class="col-md-12">
                                <div class="p-2">
                                    <h4>Ürün bulunamadı. </h4>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{--    Yeni Gelen Ürünler    --}}
        <div class="py-5 bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                            <a href="{{ route('frontend.products.newArrival') }}" class="btn btn-warning">Daha Fazla Görüntüle</a>
                        <h4 class="float-end">
                            Yeni Ürünler
                            <div class="underline"></div>
                        </h4>

                    </div>
                    @if($newArrivalProducts)
                        <div class="col-md-12">
                            <div class="owl-carousel owl-theme new-arrivals">
                                @forelse($newArrivalProducts as $product)

                                    <div class="item">
                                        <div class="product-card">
                                            <div class="product-card-img">
                                                <label class="stock bg-danger float-end">Yeni</label>
                                                @if($product->productImages->count() > 0)
                                                    <div class="img-hover">
                                                        <img src="{{ asset($product->productImages[0]->image) }}"
                                                             alt="Laptop">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="product-card-body">
                                                <a href="{{ url("collections/".$product->category->slug."/".$product->slug) }}">
                                                    <p class="product-brand">{{ $product->brand }}</p>
                                                    <h5 class="product-name">{{ $product->name }}</h5>
                                                </a>
                                                <div>
                                                    <span class="selling-price">{{ $product->selling_price }} TL</span>
                                                    <span class="original-price">{{ $product->original_price }} TL</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @empty
                            </div>
                            <div class="col-md-12">
                                <div class="p-2">
                                    <h4>Ürün bulunamadı. </h4>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{--    Öne Çıkan Ürünler    --}}
        <div class="py-5 bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Öne Çıkan Ürünler
                            <a href="{{ route('frontend.products.featured') }}" class="btn btn-warning float-end">Daha Fazla Görüntüle</a>

                        </h4>
                        <div class="underline"></div>
                    </div>
                    @if($featuredProducts)
                        <div class="col-md-12">
                            <div class="owl-carousel owl-theme featured-products">
                                @forelse($featuredProducts as $product)

                                    <div class="item">
                                        <div class="product-card">
                                            <div class="product-card-img">
                                                <label class="stock bg-danger">Öne Çıkan</label>
                                                @if($product->productImages->count() > 0)
                                                    <div class="img-hover">
                                                        <img src="{{ asset($product->productImages[0]->image) }}"
                                                             alt="Laptop">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="product-card-body">
                                                <a href="{{ url("collections/".$product->category->slug."/".$product->slug) }}">
                                                    <p class="product-brand">{{ $product->brand }}</p>
                                                    <h5 class="product-name">{{ $product->name }}</h5>
                                                </a>
                                                <div>
                                                    <span class="selling-price">{{ $product->selling_price }} TL</span>
                                                    <span class="original-price">{{ $product->original_price }} TL</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @empty
                            </div>
                            <div class="col-md-12">
                                <div class="p-2">
                                    <h4>Ürün bulunamadı. </h4>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    @endif
                </div>
            </div>
        </div>

@endsection
@section('script')
    <script>
        $('.trending-product, .new-arrivals, .featured-products').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })

    </script>

@endsection
