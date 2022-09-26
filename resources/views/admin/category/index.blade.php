@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Kategori
                    <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-sm float-end">Ekle</a>
                    </h3>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
@endsection
