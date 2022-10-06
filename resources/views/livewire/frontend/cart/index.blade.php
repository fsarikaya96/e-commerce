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
                                    <div class="col-md-2 my-auto">
                                        <label class="price">{{ $cart->products->selling_price }} TL</label>
                                    </div>
                                    <div class="col-md-2 col-7 my-auto">
                                        <div class="quantity">
                                            <div class="input-group">
                                                <button type="button" wire:loading.attr="disabled" wire:click="decrementQuantity({{ $cart->id }})" class="btn btn1"><i class="fa fa-minus"></i></button>
                                                <input type="text" value="{{ $cart->quantity }}" class="input-quantity"/>
                                                <button type="button" wire:loading.attr="disabled" wire:click="incrementQuantity({{ $cart->id }})" class="btn btn1"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
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
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
