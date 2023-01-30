@extends('layouts.app')
@section('title')
    {{ ucfirst($product->meta_title ?? 'null') }}
@endsection
@section('meta_keyword')
    {{ ucfirst($product->meta_keyword ?? 'null') }}
@endsection
@section('meta_description')
    {{ ucfirst($product->meta_description ?? 'null') }}
@endsection


@section('content')
    <livewire:frontend.product.view :category="$category" :product="$product"/>
@endsection
