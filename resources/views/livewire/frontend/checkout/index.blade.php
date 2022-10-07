<div class="py-3 py-md-4 checkout">
    <div class="container">
        <div class="row">
            @if(count($cartItems) < 1)
                <div class="empty-wishlist">
                    <h5>Sepet Listeniz Henüz Boş</h5>
                    <span>Sepet listenizde ürün bulunamadı. “Alışverişe Başla” butonuna tıklayarak dilediğiniz ürünleri sepete ekleyebilirsiniz.</span>
                    <a href="/">Alışverişe Başla</a>
                </div>
            @else
                <div class="col-md-8 mb-4">
                    <div class="shadow bg-white p-3">
                        <h4>
                            Kişisel Bilgiler
                        </h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="full_name">İsim Soyisim <small class="text-danger">*</small></label>
                                <input type="text" id="full_name" wire:model.defer="full_name" class="form-control" placeholder="Lütfen İsim Soyisim Giriniz."/>
                                @error('full_name') <small class="text-danger">{{ $message}}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone">Telefon Numarası <small class="text-danger">*</small></label>
                                <input type="text" id="phone" wire:model.defer="phone" class="form-control" placeholder="Lütfen Telefon Numarasını Giriniz."/>
                                @error('phone') <small class="text-danger">{{ $message}}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">E-mail <small class="text-danger">*</small></label>
                                <input type="email" id="email" wire:model.defer="email" class="form-control" placeholder="Lütfen E-mail Giriniz."/>
                                @error('email') <small class="text-danger">{{ $message}}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="province">İl <small class="text-danger">*</small></label>
                                <input type="text" id="province" wire:model.defer="province" class="form-control" placeholder="Lütfen İl Giriniz."/>
                                @error('province') <small class="text-danger">{{ $message}}</small> @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="county">İlçe <small class="text-danger">*</small></label>
                                <input type="text" id="county" wire:model.defer="county" class="form-control" placeholder="Lütfen İlçe Giriniz."/>
                                @error('county') <small class="text-danger">{{ $message}}</small> @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="address">Adres <small class="text-danger">*</small></label>
                                <textarea id="address" wire:model.defer="address" class="form-control" placeholder="Lütfen Adres Giriniz."></textarea>
                                @error('address') <small class="text-danger">{{ $message}}</small> @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <button type="button" wire:click="payOrder" class="btn btn-primary">Ödeme Yap</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="shadow bg-white p-3">
                            <h4>Ürünler</h4>
                            @foreach($cartItems as $cart)
                                <hr>
                                <div style="display: flex;flex-direction: row; justify-content: space-between;">
                                    <a href="{{ "collections/".$cart->products->category->slug."/".$cart->products->slug }}">
                                    <img src="{{ asset($cart->products->productImages[0]->image) }}" width="75px" height="75px">
                                    </a>
                                    <span class="product-name" style="align-self: center;">{{ $cart->products->name }}</span>

                                    @if($cart->productColors)
                                        <span style="align-self: center;"> Renk : {{ $cart->productColors->colors->name}}</span>
                                    @else
                                        <span style="align-self: center;"> Renk : Yok</span>
                                    @endif
                                    <span class="product-price" style="align-self: center;">{{ $cart->products->selling_price * $cart->quantity }} TL</span>
                                    @php $totalPrice+=$cart->products->selling_price * $cart->quantity  @endphp
                                    <button type="button" wire:click="removeCart({{ $cart->id }})" class="btn btn-sm btn-danger" style="width: 50px;height: 45px;margin-top: 15px">Sil</button>
                                </div>

                            @endforeach
                            <hr>
                            <h5>
                                Toplam Fiyat :
                                <span class="float-end">{{ $totalPrice }} TL</span>
                            </h5>
                        </div>

                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
