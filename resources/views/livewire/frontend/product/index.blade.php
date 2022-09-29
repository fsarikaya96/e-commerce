@forelse($products as $product)
    <div class="col-md-3">
        <a href="{{ url("collections/$category->slug/$product->slug") }}">
            <div class="product-card">
                <div class="product-card-img">
                    @if($product->quantity > 5)
                        <label class="stock bg-success">Stokta Mevcut</label>
                    @elseif ($product->quantity <= 5 && $product->quantity >=1)
                        <label class="stock bg-warning">Stokta Tükenmek Üzere</label>
                    @else
                        <label class="stock bg-danger">Stokta Yok</label>
                    @endif

                    @if($product->productImages->count() > 0)
                        <div class="img-hover">
                            <img src="{{ asset($product->productImages[0]->image) }}" alt="Laptop">
                        </div>
                    @endif

                </div>
                <div class="product-card-body">
                    <p class="product-brand">{{ $product->brand }}</p>
                    <h5 class="product-name">{{ $product->name }}</h5>
                    <div>
                        <span class="selling-price">{{ $product->selling_price }} TL</span>
                        <span class="original-price">{{ $product->original_price }} TL</span>
                    </div>
                    <div class="mt-2">
                        <a href="#test" class="btn btn1">Sepete Ekle</a>
                        <a href="#test2" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                        <a href="#test3" class="btn btn1"> Görüntüle </a>
                    </div>
                </div>
            </div>
        </a>
    </div>
@empty
    <div class="col-12">
        <div class="p-2">
            <h4>"{{ $category->name }}" Kategorisine ait ürün bulunamadı. </h4>
        </div>
    </div>
@endforelse
