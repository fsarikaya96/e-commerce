@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Ürün Listesi
                            <a href="{{ route('admin.products.create') }}" class="btn btn-primary text-white float-end">Ürün Ekle</a>
                        </h3>
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
@endsection

