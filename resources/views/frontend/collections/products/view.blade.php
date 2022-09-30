@extends('layouts.app')
@section('title')
    {{ ucfirst($product->meta_title) }}
@endsection
@section('meta_keyword')
    {{ ucfirst($product->meta_keyword) }}
@endsection
@section('meta_description')
    {{ ucfirst($product->meta_description) }}
@endsection


@section('content')
    <livewire:frontend.product.view :category="$category" :product="$product"/>
@endsection
