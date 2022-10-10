@extends('layouts.admin')
@section('title','Ana Sayfa')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">

            <div class="me-md-3 me-xl-5">
                <h2>Admin Paneli</h2>
                <p class="mb-md-0">Analitik kontrol paneli şablonunuz.</p>
                <hr>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="card card-body bg-primary text-white mb-3">
                        <label>Toplam Siparişler</label>
                        <h1>{{ $totalOrders }}</h1>
                        <a href="{{ route('admin.orders') }}" class="text-white">Görüntüle</a>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="card card-body bg-success text-white mb-3">
                        <label>Bugünün Siparişleri</label>
                        <h1>{{ $todayOrder }}</h1>
                        <a href="{{ route('admin.orders') }}" class="text-white">Görüntüle</a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-body bg-warning text-white mb-3">
                        <label>Aylık Siparişler</label>
                        <h1>{{ $monthOrder }}</h1>
                        <a href="{{ route('admin.orders') }}" class="text-white">Görüntüle</a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-body bg-facebook text-white mb-3">
                        <label>Yıllık Siparişler</label>
                        <h1>{{ $yearOrder }}</h1>
                        <a href="{{ route('admin.orders') }}" class="text-white">Görüntüle</a>
                    </div>
                </div>
                <hr>
                <div class="col-md-3">
                    <div class="card card-body bg-primary text-white mb-3">
                        <label>Toplam Ürün</label>
                        <h1>{{ $totalProducts }}</h1>
                        <a href="{{ route('admin.products') }}" class="text-white">Görüntüle</a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-body bg-success text-white mb-3">
                        <label>Toplam Kategori</label>
                        <h1>{{ $totalCategories }}</h1>
                        <a href="{{ route('admin.category') }}" class="text-white">Görüntüle</a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-body bg-warning text-white mb-3">
                        <label>Toplam Marka</label>
                        <h1>{{ $totalBrands }}</h1>
                        <a href="{{ route('admin.brands') }}" class="text-white">Görüntüle</a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-body bg-facebook text-white mb-3">
                        <label>Toplam Kullanıcı</label>
                        <h1>{{ $totalUsers }}</h1>
                        <a href="{{ route('admin.users') }}" class="text-white">Görüntüle</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
