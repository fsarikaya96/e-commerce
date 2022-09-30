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
                    <h4 class="product-name" style="color: #333333">
                        {{ $product->name }}
                    </h4>
                    <hr>
                    <p class="product-path">
                        <a class="brand-crumb-a" href="{{ url('/') }}">Anasayfa</a> / <a class="brand-crumb-a" href="{{ url("/collections/$category->slug") }}">{{ $category->name}}</a> /
                        <a class="brand-crumb-a" href="{{ url("/collections/$category->slug/$product->slug") }}">{{ $product->name }}</a>
                    </p>
                    <div>
                        <span class="selling-price">{{ $product->selling_price }} TL</span>
                        <span class="original-price">{{ $product->original_price }} TL</span>
                    </div>
                    <p class="d-inline-block" style="font-size: 14px; font-weight: 600;">Renk Seçin</p>
                    <div>
                        @if($product->productColors->count() > 0)
                          @if($product->productColors)
                            @foreach($product->productColors as $productColor)
                                    <label class="colorSelectionLabel text-white" style="background: {{ $productColor->colors->code }}">
                                    </label>
                            @endforeach
                          @endif
                        @else
                            @if($product->quantity > 0)
                                <label class="py-2 mt-2 text-white btn btn-sm bg-success pe-none">Stokta Mevcut</label>
                            @else
                                <label class="py-2 mt-2 text-white btn btn-sm bg-danger pe-none">Stokta Yok</label>
                            @endif
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

