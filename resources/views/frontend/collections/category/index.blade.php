@extends('layouts.app')
@section('title','Kategoriler')
@section('content')
    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-4">Kategoriler</h4>
                </div>
                @forelse($categories as $category)
                    <div class="col-6 col-md-3">
                        <div class="category-card">
                            <a href="{{ url('collections',$category->slug) }}">
                                <div class="category-card-img">
                                    <img src="{{ asset($category->image) }}" class="w-100" alt="Fotoğraf Bulunamadı." style="max-height: 300px;">
                                </div>
                                <div class="category-card-body">
                                    <h5>{{ $category->name }}</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <h5>Kategori Bulunamadı.</h5>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

@endsection
