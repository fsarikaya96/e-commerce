@extends('layouts.app')
@section('title','Ana Sayfa')
@section('content')
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
        <div class="carousel-indicators">
            @for($i=0; $i<count($sliders); $i++)
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide  {{ $i }}"></button>
            @endfor
        </div>
        <div class="carousel-inner">
            @foreach($sliders as $key=>$slider)
            <div class="carousel-item {{ $key==0 ? 'active' : '' }}">
                <img src="{{ $slider->image }}" class="d-block w-100" alt="..." height="750">
                <div class="carousel-caption d-none d-md-block">
                    <div class="custom-carousel-content">
                        <h1><span>{{ $slider->title }}</span></h1>
                        <p>{!! $slider->description !!}</p>
                        <div>
                            <a href="{{ $slider->link }}" class="btn btn-slider">
                                Alışverişe Başla
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endsection
