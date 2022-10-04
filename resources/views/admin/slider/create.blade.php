@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Slider Ekle
                        <a href="{{ route('admin.sliders') }}" class="btn btn-danger float-end text-white">Geri</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.sliders.store') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="row">

                            <div class="col-md-12 mb-3">
                                <label for="title">Başlık <small>*</small></label>
                                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="description">Açıklama <small>*</small></label>
                                <textarea name="description" class="form-control" id="description" rows="3">{{ old('description') }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="link">Link <small>(İsteğe Bağlı)</small></label>
                                <input type="text" id="link" name="link" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="image">Resim <small>(İsteğe Bağlı)</small></label>
                                <input type="file" id="image" name="image" class="form-control" accept="images*">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status">Durum</label><br>
                                <input type="checkbox" class="status-checkbox" id="status" name="status">
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary float-end text-white">Kaydet</button>
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
