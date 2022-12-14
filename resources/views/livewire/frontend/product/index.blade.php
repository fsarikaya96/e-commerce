<div class="row">
    <div class="col-md-3" wire:loading.class="opacity-50">
        @if($category->brands)
        <div class="card">
            <div class="card-header">Markalar</div>
            <div class="card-body">
                <div wire:loading class="brands-category-loading">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Yükleniyor...</span>
                    </div>
                </div>
                @foreach($category->brands as $brand)
                <label class="d-block">
                    <input type="checkbox" wire:model="brandInputs" value="{{ $brand->name }}"/> {{ $brand->name }}
                </label>
                @endforeach
            </div>
        </div>
        @endif
        <div class="card mt-3">
            <div class="card-header">Fiyat</div>
            <div class="card-body">
                <label class="d-block">
                    <input type="radio" wire:model="priceSort" value="high-to-low"/> Yüksekten Düşüğe
                </label>
                <label class="d-block">
                    <input type="radio" wire:model="priceSort" value="low-to-high"/> Düşükten Yükseğe
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-9">


        <div class="row">
            @forelse($products as $product)
                <div class="col-md-4">
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
                            <a href="{{ url("collections/$category->slug/$product->slug") }}">
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
                <div class="col-md-12">
                    <div class="p-2">
                        <h4>"{{ $category->name }}" Kategorisine ait ürün bulunamadı. </h4>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>


