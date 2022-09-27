@extends('layouts.admin')

@section('content')

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Kategori Güncelle
                        <a href="{{ route('admin.category') }}" class="btn btn-primary float-end text-white">Geri</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.category.update',$category->id) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="name">Kategori Adı <small>*</small></label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ $category->name }}">
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="slug">Slug<small> (İsteğe Bağlı)</small></label>
                                <input type="text" id="slug" name="slug" class="form-control" value="{{ $category->slug }}">
                                @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="description">Açıklama <small>*</small></label>
                                <textarea name="description" class="form-control" id="description" rows="3">{{ $category->description }}</textarea>
                                @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="image">Resim</label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/jpg,image/png,image/jpeg">
                                <img class="mt-3 category-img" src="{{ asset("/uploads/category/$category->image") }}" alt="Fotoğraf Bulunumadı.">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status">Durum</label><br>
                                <input type="checkbox" id="status" name="status" {{ $category->status== 1 ? "checked" : "" }}>
                            </div>
                            <div class="col-md-12">
                                <h3>Seo Etiketleri<small> (İsteğe Bağlı)</small></h3>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="meta_title">Başlık</label>
                                <input type="text" id="meta_title" name="meta_title" class="form-control" value="{{ $category->meta_title }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="meta_keyword">Anahtar Kelime</label>
                                <input type="text" id="meta_keyword" name="meta_keyword" class="form-control" value="{{ $category->meta_keyword }}">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="meta_description">Açıklama</label>
                                <textarea name="meta_description" class="form-control" id="meta_description" rows="3">{{ $category->meta_description }}</textarea>
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
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush
