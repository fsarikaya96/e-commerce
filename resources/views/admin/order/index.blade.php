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
                    <form action="" method="GET">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="date">Tarih Seçiniz</label>
                                <input type="date" id="date" name="date" value="{{ Request::get('date') ?? date('Y-m-d') }}" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="status">Duruma Göre</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="">Tüm Durumu Seç</option>
                                    <option value="in progress" {{ Request::get('status') == 'in progress' ? 'selected' : '' }}>İşleniyor</option>
                                    <option value="completed" {{ Request::get('status') == 'completed' ? 'selected' : '' }}>Tamamlandı</option>
                                    <option value="pending" {{ Request::get('status') == 'pending' ? 'selected' : '' }}>Bekleniyor</option>
                                    <option value="cancelled" {{ Request::get('status') == 'cancelled' ? 'selected' : ''}}>İptal Edildi</option>
                                    <option value="out-for-delivery" {{ Request::get('status') == 'out-for-delivery' ? 'selected' : '' }}>Dağıtımda</option>
                                </select>
                            </div>
                            <div class="col-md-3 mt-3">
                                <button type="submit" class="btn btn-primary text-white">Filtrele</button>
                            </div>
                        </div>
                    </form>
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
                                        <span class="status-warning pt-2 text-white">İşleniyor</span>
                                    @elseif($order->status_message == 'completed')
                                        <span class="status-success pt-2 text-white">Tamamlandı</span>
                                    @elseif($order->status_message == 'pending')
                                        <span class="status-warning pt-2 text-white">Bekleniyor</span>
                                    @elseif($order->status_message == 'cancelled')
                                        <span class="status-danger pt-2 text-white">İptal Edildi</span>
                                    @else
                                        <span class="status-primary pt-2 text-white">Dağıtımda</span>
                                    @endif
                                </td>
                                <td><a href="{{ route('admin.shows',$order->id) }}"
                                       class="btn btn-sm btn-primary text-white">Görüntüle</a></td>
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
