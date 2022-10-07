@extends('layouts.admin')
@section('title','Siparişler')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Siparişler</h3>
                </div>
                <div class="card-body">
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
                                <td>
                                    @if($order->status_message == 'in progress')
                                        <span class="status-warning p-2">İşleniyor</span>
                                    @elseif($order->status_message == 'completed')
                                        <span class="status-success">Tamamlandı</span>
                                    @endif
                                </td>
                                <td><a href="{{ route('admin.shows',$order->id) }}" class="btn btn-sm btn-primary text-white">Görüntüle</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Sipariş Bulunmamaktadır.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
