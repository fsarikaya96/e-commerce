@extends('layouts.app')
@section('title','Teşekkürler')
@section('content')
    <h5>Siparişleriniz</h5>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th scope="col"># Sipariş Kodu</th>
            <th>Ürün</th>
            <th>Renk</th>
            <th>Adet</th>
            <th>Fiyat</th>
            <th>Durum</th>
            <th>Sipariş Tarihi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($userOrders as $order)
        <tr>
            <th scope="row">{{ $order->orders->tracking_no }}</th>
            <td>{{ $order->products->name }}</td>
            <td>Otto</td>
            <td>@mdo</td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
