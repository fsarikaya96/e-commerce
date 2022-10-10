@extends('layouts.app')
@section('title','Aranan Ürünler')
@section('content')
    <div class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>"{{ Request::get('search') }}" ait ürünler</h4>
                    <div class="underline"></div>
                </div>
                @if($products)
                    @forelse($products as $product)
                        <div class="col-md-8">
                            <div class="product-card">
                                <div class="row justify-content-center">
                                    <div class="col-md-3">
                                        <div class="product-card-img border-bottom-0">
                                            <label class="stock bg-danger">Yeni</label>
                                            @if($product->productImages->count() > 0)
                                                <div class="img-hover">
                                                    <img src="{{ asset($product->productImages[0]->image) }}"/>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="product-card-body">
                                            <a href="{{ url("collections/".$product->category->slug."/".$product->slug) }}">
                                                <p class="product-brand">{{ $product->brand }}</p>
                                                <h5 class="product-name">{{ $product->name }}</h5>
                                            </a>
                                            <div>
                                                <span class="selling-price">{{ $product->selling_price }} TL</span>
                                                <span class="original-price">{{ $product->original_price }} TL</span>
                                            </div>
                                            <div class="d-flex">
                                            <b>Açıklama : </b> <span class="px-2">{!! $product->description !!}</span>
                                            </div>
                                            <a href="{{ url("collections/".$product->category->slug."/".$product->slug) }}" class="view-btn">Görüntüle</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12 p-2">
                            <h4>Ürün bulunamadı. </h4>
                        </div>
                    @endforelse
                    <div>
                        {{ $products->appends(request()->input())->links() }}
                    </div>
            </div>
            @endif
        </div>
    </div>
@endsection
