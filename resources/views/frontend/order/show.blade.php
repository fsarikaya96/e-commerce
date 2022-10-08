@extends('layouts.app')
@section('title','Siparişler')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shadow bg-white p-3">
                    <h4>
                        <i class="fa fa-shopping-cart"></i> Sipariş Detayı
                        <a href="{{ route('orders') }}" class="btn btn-danger float-end">Geri</a>
                    </h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Sipariş Detayları</h5>
                            <hr>
                            <h6>Sipariş Numarası : {{ $order->id }}</h6>
                            <h6>Takip Numarası : {{ $order->tracking_no }}</h6>
                            <h6>Sipariş Tarihi : {{ $order->created_at }}</h6>
                            <h6 class="border p-2 text-success">
                                Sipariş Durumu :
                                @if($order->status_message == 'in progress')
                                    <span class="text-uppercase">İşleniyor</span>
                                @elseif($order->status_message == 'completed')
                                    <span class="text-uppercase">Tamamlandı</span>
                                @elseif($order->status_message == 'pending')
                                    <span class="text-uppercase">Bekleniyor</span>
                                @elseif($order->status_message == 'cancelled')
                                    <span class="text-uppercase">İptal Edildi</span>
                                @else
                                    <span class="text-uppercase">Dağıtımda</span>
                                @endif
                            </h6>

                        </div>
                        <div class="col-md-6">
                            <h5>Kullanıcı Bilgileri</h5>
                            <hr>
                            <h6>İsim Soyisim : {{ $order->full_name }}</h6>
                            <h6>E-mail : {{ $order->email }}</h6>
                            <h6>Telefon : {{ $order->phone }}</h6>
                            <h6>Adres : {{ $order->address }}</h6>
                            <h6>{{ $order->province . " / " . $order->county }}</h6>
                        </div>
                    </div>
                    <br>
                    <h5>Siparişler</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Ürün No</th>
                                <th>Fotoğraf</th>
                                <th>Ürün Adı ve Renk</th>
                                <th>Birim Fiyat</th>
                                <th>Adet</th>
                                <th>Toplam</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $totalPrice = 0; @endphp
                            @forelse($order->orderItems as $orderItem)
                                <tr>
                                    <td width="5%">{{ $orderItem->id }}</td>
                                    <td width="10%" style="text-align: center">
                                        <label class="product-name">
                                            <a href="{{ url("collections/".$orderItem->products->category->slug."/".$orderItem->products->slug) }}">
                                            @if($orderItem->products->productImages)
                                                <img src="{{ asset($orderItem->products->productImages[0]->image) }}"
                                                     style="width: 75px;" alt="">
                                            @else
                                                <img src="" style="width: 75px; height: 75px" alt="Bulunamadı.">
                                            @endif
                                            </a>
                                        </label>
                                    </td>
                                    <td width="10%">{{ $orderItem->products->name }}
                                        @if($orderItem->productColors)
                                            @if($orderItem->productColors->colors)
                                                <span>- Renk : {{ $orderItem->productColors->colors->name }}</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td width="10%">{{ $orderItem->price }} TL</td>
                                    <td width="10%">{{ $orderItem->quantity }}</td>
                                    <td width="10%">{{ $orderItem->quantity*$orderItem->price }} TL</td>
                                    @php $totalPrice+=$orderItem->quantity*$orderItem->price; @endphp
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Sipariş Bulunmamaktadır.</td>
                                </tr>
                            @endforelse
                            <tr>
                                <td colspan="5" class="fw-bold">Toplam Tutar</td>
                                <td colspan="1" class="fw-bold">{{ $totalPrice }} TL</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
