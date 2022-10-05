<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if($wishlist->count() <1)
                <div class="empty-wishlist">
                    <h5>Favoriler Listeniz Henüz Boş</h5>
                    <span>Favori listenizde ürün bulunamadı. “Alışverişe Başla” butonuna tıklayarak dilediğiniz ürünleri favoriye ekleyebilirsiniz.</span>
                    <a href="/">Alışverişe Başla</a>
                </div>
            @else
                <h5>Favorileriniz</h5>
                @foreach($wishlist as $list)
                    @if($list->products)
                        <div class="favored-product-container">
                            <div class="p-card-wrppr">
                                <div class="p-card-chldrn-cntnr">
                                    <div class="img-wrapper">
                                        <img class="p-card-img" src="{{ asset($list->products->productImages[0]->image) }}">
                                        <div class="new-promotion-container">
                                        </div>
                                    </div>
                                    <div class="prdct-desc-cntnr-wrppr">
                                        <span class="product-name-favorite">{{ $list->products->name }}</span>
                                        <div class="product-price">
                                            <div class="prc-box-dscntd">{{ $list->products->selling_price }} TL</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="view-product-btn">
                                    <a href="{{"collections/".$list->products->category->slug.'/'.$list->products->slug }}">Ürüne Git</a>
                                </div>
                                <div class="ufvrt-btn-wrppr"><span class="removeWishlist" wire:click="removeWishlistItem({{ $list->id }})">&#10005;</span></div>

                            </div>
                        </div>

                    @endif

                @endforeach
            @endif


        </div>
    </div>
</div>
