@extends('layouts.app')
@section('title','Yeni Gelenler')
@section('content')
    <div class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Yeni Gelenler</h4>
                    <div class="underline"></div>
                </div>
                @if($featuredProducts)
                    @forelse($featuredProducts as $product)
                        <div class="col-md-3">
                            <div class="product-card">
                                <div class="product-card-img">
                                    <label class="stock bg-danger">Yeni</label>
                                    @if($product->productImages->count() > 0)
                                        <div class="img-hover">
                                            <img src="{{ asset($product->productImages[0]->image) }}"/>
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
                        <div class="col-md-12 p-2">
                            <h4>Ürün bulunamadı. </h4>
                        </div>
                    @endforelse
                    <div class="text-center">
                        <a href="{{ url("collections") }}" class="btn btn-warning px-3">Daha Fazla Göster</a>
                    </div>
            </div>
            @endif
        </div>
    </div>
@endsection
