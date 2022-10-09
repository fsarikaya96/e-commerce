<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if($carts->count() < 1)
                <div class="empty-wishlist">
                    <h5>Sepet Listeniz Henüz Boş</h5>
                    <span>Sepet listenizde ürün bulunamadı. “Alışverişe Başla” butonuna tıklayarak dilediğiniz ürünleri sepete ekleyebilirsiniz.</span>
                    <a href="/">Alışverişe Başla</a>
                </div>
            @else
                <div class="shopping-cart">

                    <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Ürünler</h4>
                            </div>
                            <div class="col-md-1">
                                <h4>Fiyat</h4>
                            </div>
                            <div class="col-md-1">
                                <h4>Toplam</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Adet</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Sil</h4>
                            </div>
                        </div>
                    </div>
                    @foreach($carts as $cart)
                        @if($cart->products)
                            <div class="cart-item">
                                <div class="row">
                                    <div class="col-md-6 my-auto">
                                        <a href="{{ "collections/".$cart->products->category->slug."/".$cart->products->slug }}">
                                            <label class="product-name">
                                                @if($cart->products->productImages)
                                                    <img src="{{ asset($cart->products->productImages[0]->image) }}"
                                                         style="width: 75px; height: 75px" alt="">
                                                @else
                                                    <img src="" style="width: 75px; height: 75px" alt="Bulunamadı.">
                                                @endif
                                                {{ $cart->products->name }}
                                                @if($cart->productColors)
                                                    @if($cart->productColors->colors)
                                                        <span>- Renk : {{ $cart->productColors->colors->name }}</span>
                                                    @endif
                                                @endif
                                            </label>
                                        </a>
                                    </div>
                                    <div class="col-md-1 my-auto">
                                        <label class="price">{{ $cart->products->selling_price }} TL</label>
                                    </div>
                                    <div class="col-md-1 my-auto">
                                        <label class="price">{{ $cart->products->selling_price * $cart->quantity }}
                                            TL</label>
                                        @php $totalPrice+=$cart->products->selling_price * $cart->quantity @endphp

                                    </div>
                                    <div class="col-md-2 col-7 my-auto">
                                        <div class="quantity">
                                            <div class="input-group">
                                                <button type="button" wire:loading.attr="disabled"
                                                        wire:click="decrementQuantity({{ $cart->id }})"
                                                        class="btn btn1"><i class="fa fa-minus"></i></button>
                                                <input type="text" value="{{ $cart->quantity }}"
                                                       class="input-quantity"/>
                                                <button type="button" wire:loading.attr="disabled"
                                                        wire:click="incrementQuantity({{ $cart->id }})"
                                                        class="btn btn1"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-5 my-auto">
                                        <div class="remove">
                                            <button type="button" wire:loading.attr="disabled"
                                                    wire:click="removeCart({{ $cart->id }})"
                                                    class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i> Sil
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-8 my-md-auto mt-3">
                        <h5>
                            En iyi fırsatları ve teklifleri alın şimdi <a href="{{ url('/collections') }}">Alışverişe
                                Devam Et</a>
                        </h5>
                    </div>
                    <div class="col-md-4 mt-3">
                        <div class="shadow-sm bg-white p-3">
                            <h4>Toplam :
                                <span class="float-end">{{ $totalPrice }} TL</span>
                            </h4>
                            <hr>
                            <a href="{{ route('checkout') }}" class="btn btn-warning w-100">Devam Et</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

</div>
