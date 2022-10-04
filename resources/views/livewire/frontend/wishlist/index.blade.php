<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shopping-cart">

                    <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Ürünler</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Fiyat</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Sil</h4>
                            </div>
                        </div>
                    </div>
                    @forelse($wishlist as $list)
                        @if($list->products)
                        <div class="cart-item">
                            <div class="row">
                                <div class="col-md-6 my-auto">
                                    <a href="">
                                        <label class="product-name">
                                            <img src="{{ asset($list->products->productImages[0]->image) }}" style="width: 75px; height: 75px" alt="">
                                            {{ $list->products->name }}
                                        </label>
                                    </a>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <label class="price">{{ $list->products->selling_price }} TL </label>
                                </div>
                                <div class="col-md-2 col-5 my-auto">
                                    <div class="remove">
                                        <a href="" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Sil
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @empty
                        <h4>Favorileriniz Boş.</h4>
                    @endforelse

                </div>
            </div>
        </div>

    </div>
</div>
