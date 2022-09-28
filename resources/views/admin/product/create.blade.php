@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Ürün Ekle
                        <a href="{{ route('admin.products') }}" class="btn btn-danger text-white float-end">Geri</a>
                    </h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home-tab-pane" type="button" role="tab"
                                        aria-controls="home-tab-pane" aria-selected="true">
                                    Ürün
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="seo-tab" data-bs-toggle="tab"
                                        data-bs-target="#seo-tab-pane" type="button" role="tab"
                                        aria-controls="seo-tab-pane" aria-selected="false">
                                    SEO Etiketleri
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                        data-bs-target="#details-tab-pane" type="button" role="tab"
                                        aria-controls="details-tab-pane" aria-selected="false">
                                    Detaylar
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab"
                                        data-bs-target="#image-tab-pane" type="button" role="tab"
                                        aria-controls="image-tab-pane" aria-selected="false">
                                    Ürün Resimleri
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="color-tab" data-bs-toggle="tab"
                                        data-bs-target="#color-tab-pane" type="button" role="tab"
                                        aria-controls="color-tab-pane" aria-selected="false">
                                    Ürün Renkleri
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel"
                                 aria-labelledby="home-tab" tabindex="0">

                                <div class="mb-3">
                                    <label for="category_id">Kategori Seçiniz</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="name">Ürün İsim</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                           value="{{ old('name') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="slug">Ürün Slug</label>
                                    <input type="text" id="slug" name="slug" class="form-control"
                                           value="{{ old('slug') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="brand">Marka Seçiniz</label>
                                    <select name="brand_id" id="brand" class="form-control">
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="small_description">Kısaltılmış Açıklama (500 kelime)</label>
                                    <input type="text" id="small_description" name="small_description"
                                           class="form-control" value="{{ old('small_description') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="product_description">Ürün Açıklama</label>
                                    <textarea type="text" id="description" name="description"
                                              class="form-control">{{ old('description') }}</textarea>
                                </div>

                            </div>
                            <div class="tab-pane fade border p-3" id="seo-tab-pane" role="tabpanel"
                                 aria-labelledby="seo-tab" tabindex="0">
                                <div class="mb-3">
                                    <label for="meta_title">Meta Başlık</label>
                                    <input type="text" id="meta_title" name="meta_title" class="form-control"
                                           value="{{ old('meta_title') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="meta_keyword">Meta Kelimeler</label>
                                    <input type="text" id="meta_keyword" name="meta_keyword" class="form-control"
                                           value="{{ old('meta_keyword') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="meta_description">Meta Açıklama</label>
                                    <input type="text" id="meta_description" name="meta_description"
                                           class="form-control" value="{{ old('meta_description') }}">
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel"
                                 aria-labelledby="details-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="original_price">Gerçek Fiyat</label>
                                            <input type="text" id="original_price" name="original_price"
                                                   class="form-control" value="{{ old('original_price') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="selling_price">Satış Fiyat</label>
                                            <input type="text" id="selling_price" name="selling_price"
                                                   class="form-control" value="{{ old('selling_price') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="quantity">Adet</label>
                                            <input type="number" id="quantity" name="quantity" class="form-control"
                                                   value="{{ old('quantity') }}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-2">
                                            <label for="trending">Trend olsun mu ? </label><br>
                                            <input type="checkbox" id="trending" name="trending"
                                                   class="status-checkbox">
                                        </div>
                                        <div class="mb-3 col-2">
                                            <label for="status">Durum aktif olsun mu?</label><br>
                                            <input type="checkbox" id="status" name="status" class="status-checkbox">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel"
                                 aria-labelledby="image-tab" tabindex="0">
                                <div class="mb-3">
                                    <input type="file" id="photo-upload" name="image[]" multiple class="form-control">
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="color-tab-pane" role="tabpanel"
                                 aria-labelledby="color-tab" tabindex="0">
                                <div class="mb-3">
                                    <label>Renk Seçin</label>
                                    <hr>
                                    <div class="row">
                                        @forelse($colors as $color)
                                            <div class="col-md-3">
                                                <div class="p-2 border mb-3">
                                                    <label for="color">Renk</label>
                                                    <input type="checkbox" name="colors[]" id="color" value="{{ $color->id }}">
                                                    {{ $color->name }}
                                                    <br>
                                                    <label for="color_quantity">Adet</label>
                                                    <input type="number" name="color_quantity[]" id="color_quantity" style="width: 70px; border: 1px solid #CCC">
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-md-12">
                                                Renk Bulunamadı.
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary float-end text-white mt-2">Kaydet</button>
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
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
