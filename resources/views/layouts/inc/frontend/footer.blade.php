<div class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h4 class="footer-heading">JFeel E-Ticaret</h4>
                <div class="footer-underline"></div>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                </p>
            </div>
            <div class="col-md-3">
                <h4 class="footer-heading">Hızlı Erişim</h4>
                <div class="footer-underline"></div>
                <div class="mb-2"><a href="{{ route('frontend.home') }}" class="text-white">Anasayfa</a></div>
                <div class="mb-2"><a href="" class="text-white">Hakkımızda</a></div>
                <div class="mb-2"><a href="" class="text-white">İletişim</a></div>
                <div class="mb-2"><a href="" class="text-white">Blog</a></div>
                <div class="mb-2"><a href="" class="text-white">Site Haritaları</a></div>
            </div>
            <div class="col-md-3">
                <h4 class="footer-heading">Şimdi Satın Al</h4>
                <div class="footer-underline"></div>
                <div class="mb-2"><a href="{{ route('frontend.category') }}" class="text-white">Kategoriler</a></div>
                <div class="mb-2"><a href="{{ route('frontend.home') }}" class="text-white">Trend Ürünler</a></div>
                <div class="mb-2"><a href="{{ route('frontend.products.newArrival') }}" class="text-white">Yeni Gelen
                        Ürünler</a></div>
                <div class="mb-2"><a href="{{ route('frontend.products.featured') }}" class="text-white">Öne Çıkan
                        Ürünler</a></div>
                <div class="mb-2"><a href="{{ route('carts') }}" class="text-white">Sepet</a></div>
            </div>
            <div class="col-md-3">
                <h4 class="footer-heading">Şimdi Alışverişe Ulaşın</h4>
                <div class="footer-underline"></div>
                <div class="mb-2">
                    <p>
                        <i class="fa fa-map-marker"></i> {{ $appSetting->address ?? '' }}
                    </p>
                </div>
                <div class="mb-2">
                    <a href="" class="text-white">
                        <i class="fa fa-phone"></i> {{ $appSetting->phone1 ?? '' }}
                    </a>
                </div>
                <div class="mb-2">
                    <a href="" class="text-white">
                        <i class="fa fa-envelope"></i> {{ $appSetting->email1 ?? '' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="copyright-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <p class=""> &copy; 2022 - JFeel - E-Ticaret. Tüm hakları Saklıdır.</p>
            </div>
            <div class="col-md-4">
                <div class="social-media">
                    @if($appSetting->facebook)
                        <a href="{{ $appSetting->facebook }}" target="_blank"><i class="fa fa-facebook"></i></a>
                    @endif
                    @if($appSetting->twitter)
                        <a href="{{ $appSetting->twitter }}" target="_blank"><i class="fa fa-twitter"></i></a>
                    @endif
                    @if($appSetting->instagram)
                        <a href="{{ $appSetting->instagram }}" target="_blank"><i class="fa fa-instagram"></i></a>
                    @endif
                    @if($appSetting->youtube)
                        <a href="{{ $appSetting->youtube }}" target="_blank"><i class="fa fa-youtube"></i></a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
