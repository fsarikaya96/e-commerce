<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mt-3">
                <div class="bg-white border">
                    @if($product->productImages)
                    <img src="{{ asset($product->productImages[0]->image) }}" class="w-100" alt="Img" style="max-height: 500px">
                    @else
                        <span>Ürüne Ait Fotoğraf Bulunamadı.</span>
                    @endif
                </div>
            </div>
            <div class="col-md-7 mt-3">
                <div class="product-view">
                    <h4 class="product-name">
                        {{ $product->name }}
                        @if($product->quantity > 5)
                            <label class="label-stock bg-success">Stokta Mevcut</label>
                        @elseif ($product->quantity <= 5 && $product->quantity >=1)
                            <label class="label-stock bg-warning">Stokta Tükenmek Üzere</label>
                        @else
                            <label class="label-stock bg-danger">Stokta Yok</label>
                        @endif
                    </h4>
                    <hr>
                    <p class="product-path">
                        <a href="{{ url('/') }}">Anasayfa</a> / <a href="{{ url("/collections/$category->slug") }}">{{ $category->name}}</a> /
                        <a href="{{ url("/collections/$category->slug/$product->slug") }}">{{ $product->name }}</a>
                    </p>
                    <div>
                        <span class="selling-price">{{ $product->selling_price }}</span>
                        <span class="original-price">{{ $product->original_price }}</span>
                    </div>
                    <div>
                        @if($product->productColors)
                            @foreach($product->productColors as $productColor)
                                <input type="radio" name="productColor" value="{{ $productColor->id }}">{{ $productColor->colors->name }}
                            @endforeach
                        @endif
                    </div>
                    <div class="mt-2">
                        <div class="input-group">
                            <span class="btn btn1"><i class="fa fa-minus"></i></span>
                            <input type="text" value="1" class="input-quantity" />
                            <span class="btn btn1"><i class="fa fa-plus"></i></span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <a href="" class="btn btn1"> <i class="fa fa-shopping-cart"></i> Sepete Ekle</a>
                        <a href="" class="btn btn1"> <i class="fa fa-heart"></i>Favorilere Ekle</a>
                    </div>
                    <div class="mt-3">
                        <h5 class="mb-0">Küçük Açıklama</h5>
                        <p>
                            {{ $product->small_description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header bg-white">
                        <h4>Açıklama</h4>
                    </div>
                    <div class="card-body">
                        <p>
                            {!! $product->description !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

