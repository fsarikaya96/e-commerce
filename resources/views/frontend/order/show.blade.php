@extends('layouts.app')
@section('title','Siparişler')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shadow bg-white p-3">
                   <h4>
                       <i class="fa fa-shopping-cart"></i> Sipariş Detayları
                       <a href="{{ route('orders') }}" class="btn btn-danger float-end">Geri</a>
                   </h4>
                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection
