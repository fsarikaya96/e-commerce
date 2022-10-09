<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Ana Sayfa</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.orders') }}">
                <i class="mdi mdi-sale menu-icon"></i>
                <span class="menu-title">Siparişler</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#category" aria-expanded="false" aria-controls="category">
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                <span class="menu-title">Kategoriler</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="category">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.category') }}">Kategoriler</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.category.create') }}">Kategori Ekle</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products">
                <i class="mdi mdi-plus-circle menu-icon"></i>
                <span class="menu-title">Ürünler</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="products">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.products') }}">Ürünler</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.products.create') }}">Ürün Ekle</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.brands') }}">
                <i class="mdi mdi-format-align-justify menu-icon"></i>
                <span class="menu-title">Markalar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.colors') }}">
                <i class="mdi mdi-format-align-justify menu-icon"></i>
                <span class="menu-title">Renkler</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users">
                <i class="mdi mdi-account-multiple-plus menu-icon"></i>
                <span class="menu-title">Kullanıcılar</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="users">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">Kullanıcılar</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Kullanıcı Ekle</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#sliders" aria-expanded="false" aria-controls="sliders">
                <i class="mdi mdi-cards menu-icon"></i>
                <span class="menu-title">Slider</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="sliders">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.sliders') }}">Slider</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.sliders.create') }}">Slider Ekle</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.settings') }}">
                <i class="mdi mdi-settings menu-icon"></i>
                <span class="menu-title">Ayarlar</span>
            </a>
        </li>
    </ul>
</nav>

