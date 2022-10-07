@extends('layouts.app')
@section('title','Siparişler')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shadow bg-white p-3">
                    <h4 class="mb-4">
                        Siparişlerim
                    </h4>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Sipariş Numarası</th>
                                <th>Takip Numarası</th>
                                <th>İsim Soyisim</th>
                                <th>Sipariş Tarihi</th>
                                <th>Sipariş Durumu</th>
                                <th>Eylem</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->tracking_no}}</td>
                                    <td>{{auth()->user()->name}}</td>
                                    <td>{{$order->created_at}}</td>
                                    <td>{{$order->status_message}}</td>
                                    <td><a href="{{ route('show',$order->id) }}" class="btn btn-sm btn-primary">Görüntüle</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Sipariş Bulunmamaktadır.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
