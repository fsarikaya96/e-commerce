@extends('layouts.app')
@section('title')
    {{ ucfirst($category->meta_title) }}
@endsection
@section('meta_keyword')
    {{ ucfirst($category->meta_keyword) }}
@endsection
@section('meta_description')
    {{ ucfirst($category->meta_description) }}
@endsection


@section('content')
    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-4">Ürünler</h4>
                </div>
                <livewire:frontend.product.index :category="$category" />
            </div>
        </div>
    </div>
@endsection
