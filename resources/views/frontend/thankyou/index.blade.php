@extends('layouts.app')
@section('title','Teşekkürler')
@section('content')
    <div class="empty-wishlist">
        <h5>Teşekkürler</h5>
        <span>Alışverişiniz tamamlanmıştır.</span>
        <a href="{{ route('orders') }}">Siparişlerime Git</a>
    </div>
@endsection
