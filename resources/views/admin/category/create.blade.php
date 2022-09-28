@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Kategori Ekle
                        <a href="{{ route('admin.category') }}" class="btn btn-danger float-end text-white">Geri</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.category.store') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="name">Kategori Adı <small>*</small></label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="slug">Slug<small> (İsteğe Bağlı)</small></label>
                                <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug') }}">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="description">Açıklama <small>*</small></label>
                                <textarea name="description" class="form-control" id="description" rows="3">{{ old('description') }}</textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="image">Resim</label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/jpg,image/png,image/jpeg">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status">Durum</label><br>
                                <input type="checkbox" class="status-checkbox" id="status" name="status">
                            </div>
                            <div class="col-md-12">
                                <h3>Seo Etiketleri<small> (İsteğe Bağlı)</small></h3>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="meta_title">Başlık</label>
                                <input type="text" id="meta_title" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="meta_keyword">Anahtar Kelime</label>
                                <input type="text" id="meta_keyword" name="meta_keyword" class="form-control" value="{{ old('meta_keyword') }}">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="meta_description">Açıklama</label>
                                <textarea name="meta_description" class="form-control" id="meta_description" rows="3">{{ old('meta_description') }}</textarea>
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
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush
