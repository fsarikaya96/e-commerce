@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Slider Düzenle
                        <a href="{{ route('admin.sliders') }}" class="btn btn-danger float-end text-white">Geri</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.sliders.update',$slider->id) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-md-12 mb-3">
                                <label for="title">Başlık <small>*</small></label>
                                <input type="text" id="title" name="title" class="form-control" value="{{ $slider->title }}">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="description">Açıklama <small>*</small></label>
                                <textarea name="description" class="form-control" id="description" rows="3">{{ $slider->description }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="link">Link <small>(İsteğe Bağlı)</small></label>
                                <input type="text" id="link" name="link" class="form-control" value="{{ $slider->link }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="image">Resim <small>(İsteğe Bağlı)</small></label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/jpg,image/png,image/jpeg">
                                <img class="mt-3 slider-img" src="{{ asset($slider->image) }}" alt="Fotoğraf Bulunumadı.">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status">Durum</label><br>
                                <input type="checkbox" {{ $slider->status== 1 ? "checked" : "" }} class="status-checkbox" id="status" name="status">
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary float-end text-white">Güncelle</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script>

        ClassicEditor
            .create( document.querySelector( '#description' ))

            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush
