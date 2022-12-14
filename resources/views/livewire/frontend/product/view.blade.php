<div class="single-product-page">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mt-3">
                <div class="bg-white" wire:ignore>
                    @if($product->productImages)
                        {{--                        <img src="{{ asset($product->productImages[0]->image) }}" class="w-100" alt="Img"--}}
                        {{--                             style="max-height: 440px;border-radius: 6px;border: solid 1px #e6e6e6;overflow: hidden;">--}}
                        <div class="exzoom" id="exzoom">
                            <div class="exzoom_img_box">
                                <ul class='exzoom_img_ul'>
                                    @foreach($product->productImages as $image)
                                        <li><img src="{{ asset($image->image) }}"/></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="exzoom_nav"></div>
                            <p class="exzoom_btn">
                                <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                                <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                            </p>
                        </div>
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
                        <a class="brand-crumb-a" href="{{ url('/') }}">Anasayfa</a> /
                        <a class="brand-crumb-a"
                           href="{{ url("/collections/$category->slug") }}">{{ $category->name}}</a>
                        / <a class="brand-crumb-a"
                             href="{{ url("/collections/$category->slug/$product->slug") }}">{{ $product->name }}</a>
                    </p>
                    <div>
                        <span class="selling-price">{{ $product->selling_price }} TL</span>
                        <span class="original-price">{{ $product->original_price }} TL</span>
                    </div>

                    <div>
                        @if($product->productColors->count() > 0)
                            <p class="" style="font-size: 14px; font-weight: 600;">Renk Seçin</p>
                            @if($product->productColors)
                                @foreach($product->productColors as $productColor)
                                    @if($productColor->quantity != 0)
                                        <label class="colorSelectionLabel text-white"
                                               style="background: {{ $productColor->colors->code }}"
                                               wire:click="colorSelected({{ $productColor->id }})">
                                        </label>
                                    @endif
                                @endforeach
                            @endif
                            @if($this->productColorSelected)
                                <div>Seçilen Renk : <span
                                        style="font-size: 14px; font-weight: 600">{{ $this->productColorSelected }}</span>
                                </div>
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
                            <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                            <input type="text" id="qty" wire:model.defer="quantityCount"
                                   value="{{ $this->quantityCount }}"
                                   class="input-quantity"/>
                            <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                            <button type="button" wire:click="addToWishList({{ $product->id }})" class="btn btn1">
                                <i class="fa fa-heart"></i>
                                Favorilere Ekle
                            </button>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button wire:click="addToCart({{ $product->id }})" class="btn btn1" style="width: 272px"
                                onClick="return empty()"><span>Sepete Ekle</span>
                        </button>
                    </div>
                    <div class="mt-3">
                        <h5 class="mb-0">Küçük Açıklama</h5>
                        <p>
                            {{ $product->small_description }}
                        </p>
                        <h5 class="mb-0">Uzun Açıklama</h5>
                        <p>
                            {!! $product->description !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        {{--        <div class="row">--}}
        {{--            <div class="col-md-12 mt-3">--}}
        {{--                <div class="card">--}}
        {{--                    <div class="card-header bg-white">--}}
        {{--                        <h4>Açıklama</h4>--}}
        {{--                    </div>--}}
        {{--                    <div class="card-body">--}}
        {{--                        <p>--}}
        {{--                            {!! $product->description !!}--}}
        {{--                        </p>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
    </div>
</div>
@push('scripts')
    <script>
        // Select your input element.
        const numInput = document.getElementById('qty');

        numInput.addEventListener("keypress", function (e) {
            if (e.which < 48 || e.which > 57) {
                e.preventDefault();
            }
        });
        $("#qty").keyup(function () {
            let length = $(this).val().length;
            if (length < 1) {
                $(this).val(1);

            }
        });
        $(function () {
            $("#exzoom").exzoom({
                "navWidth": 60,
                "navHeight": 60,
                "navItemNum": 5,
                "navItemMargin": 7,
                "navBorder": 1,
                "autoPlay": false,
                "autoPlayTimeout": 2000
            });
        });
    </script>
@endpush

