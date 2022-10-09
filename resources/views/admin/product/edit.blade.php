@extends('layouts.admin')
@section('title','Ürün Düzenle')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Ürün Güncelle
                        <a href="{{ route('admin.products') }}" class="btn btn-danger text-white float-end">Geri</a>
                    </h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.products.update',$product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
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
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false">
                                    Ürün Resimleri
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color-tab-pane" type="button" role="tab" aria-controls="color-tab-pane" aria-selected="false">
                                    Ürün Renkleri
                                </button>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                                <div class="mb-3">
                                    <label for="category_id">Kategori Seçiniz</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? "selected" : "" }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="name">Ürün İsim</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ $product->name }}">
                                </div>

                                <div class="mb-3">
                                    <label for="slug">Ürün Slug</label>
                                    <input type="text" id="slug" name="slug" class="form-control" value="{{ $product->slug }}">
                                </div>

                                <div class="mb-3">
                                    <label for="brand">Marka Seçiniz</label>
                                    <select name="brand" id="brand" class="form-control">
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->name }}" {{ $brand->name == $product->brand ? "selected" : "" }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="small_description">Kısaltılmış Açıklama (500 kelime)</label>
                                    <input type="text" id="small_description" name="small_description" class="form-control" value="{{ $product->small_description }}">
                                </div>

                                <div class="mb-3">
                                    <label for="description">Ürün Açıklama</label>
                                    <textarea type="text" id="description" name="description" class="form-control">{{ $product->description }}</textarea>
                                </div>

                            </div>
                            <div class="tab-pane fade border p-3" id="seo-tab-pane" role="tabpanel" aria-labelledby="seo-tab" tabindex="0">
                                <div class="mb-3">
                                    <label for="meta_title">Meta Başlık</label>
                                    <input type="text" id="meta_title" name="meta_title" class="form-control" value="{{ $product->meta_title }}">
                                </div>

                                <div class="mb-3">
                                    <label for="meta_keyword">Meta Kelimeler</label>
                                    <input type="text" id="meta_keyword" name="meta_keyword" class="form-control" value="{{ $product->meta_keyword }}">
                                </div>

                                <div class="mb-3">
                                    <label for="meta_description">Meta Açıklama</label>
                                    <input type="text" id="meta_description" name="meta_description" class="form-control" value="{{ $product->meta_description }}">
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="original_price">Gerçek Fiyat</label>
                                            <input type="text" id="original_price" name="original_price" class="form-control" value="{{ $product->original_price }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="selling_price">Satış Fiyat</label>
                                            <input type="text" id="selling_price" name="selling_price" class="form-control" value="{{ $product->selling_price }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="quantity">Adet</label>
                                            <input type="number" min="1" id="quantity" name="quantity" class="form-control" value="{{ $product->quantity }}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-2">
                                            <label for="trending">Trend olsun mu ? </label><br>
                                            <input type="checkbox" id="trending" name="trending" style="width: 25px; height: 25px;" @checked(old('trending',$product->trending)) >
                                        </div>
                                        <div class="mb-3 col-2">
                                            <label for="featured">Öne çıkan olsun mu ? </label><br>
                                            <input type="checkbox" id="featured" name="featured" style="width: 25px; height: 25px;" @checked(old('featured',$product->featured))
                                                   class="status-checkbox">
                                        </div>
                                        <div class="mb-3 col-2">
                                            <label for="status">Durum aktif olsun mu?</label><br>
                                            <input type="checkbox" id="status" name="status" style="width: 25px; height: 25px;" @checked(old('status',$product->status))>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                                <div class="mb-3">
                                    <label for="image"></label>
                                    <input type="file" id="image" name="image[]" multiple class="form-control">
                                    @if(count($product->productImages) > 0)
                                        <div class="row">
                                            @foreach($product->productImages as $image)
                                            <div class="col-md-2">
                                                <img src="{{ asset($image->image) }}" alt="Fotoğraf Bulunamadı." width="75px" height="75px" class="mt-2 me-4 category-img">
                                                <a href="{{ route('admin.products.deleteImage',$image->id) }}" class="d-block">Kaldır</a>
                                            </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <h5 class="mt-2">Ürüne Ait Fotoğraf Yok.</h5>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="color-tab-pane" role="tabpanel" aria-labelledby="color-tab" tabindex="0">
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
                                                    <input type="number" min="1" name="color_quantity[]" id="color_quantity" style="width: 70px; border: 1px solid #CCC">
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-md-12">
                                               Daha Fazla Renk Bulunamadı.
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                                Ürüne Ait Olan Renkler
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Renk Adı</th>
                                                <th>Adet</th>
                                                <th>Sil</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($product->productColors as $productColor)
                                            <tr>
                                                <td>{{ $productColor->colors->name }}</td>
                                                <td>
                                                    <div class="input-group mb-3" style="width: 150px">
                                                        <input type="number" min="1" value="{{ $productColor->quantity }}" class="form-control form-control-sm qty">
                                                        <button class="btn btn-primary btn-sm text-white updateQuantityBtn" value="{{ $productColor->id }}">Güncelle</button>
                                                        <span class="qty-msg mt-2" style="display: none"></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm text-white deleteQuantityBtn" value="{{ $productColor->id }}">Sil</button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">Ürüne Ait Renk Bulunamadı.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
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

        $(document).ready(function (){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Update Product Color
            $(document).on('click','.updateQuantityBtn',function (e) {
                e.preventDefault();
                let product_id = "{{ $product->id }}"
                let product_color_id = $(this).val();
                let obj = $(this);
                let qty = $(this).closest('tbody tr').find('.qty').val();

                if(qty <= 0)
                {
                    alert("Adet 0 ve altında olamaz.")
                    return false;
                }
                let data = {
                    'product_id': product_id,
                    'qty': qty
                }
                $.ajax({
                   'url' : '{{ route('admin.products.updateProductColor') }}' + '/' + product_color_id ,
                   'type' : 'POST',
                   'data' : data,
                    success:function (result) {
                        $(obj).closest('tbody tr').find('.qty-msg').text(result.message).show();
                        setTimeout(function() {
                            $(obj).closest('tbody tr').find('.qty-msg').text(result.message).fadeOut();
                        }, 1000);
                    }

                });

            });

            // Delete Product Color
            $(document).on('click','.deleteQuantityBtn',function (e) {
                e.preventDefault();
                let product_color_id = $(this).val();
                let obj = $(this);
                $.ajax({
                    'url' : '{{ route('admin.products.deleteProductColor') }}' + '/' + product_color_id,
                    'type' : 'POST',
                    'data' : { 'product_color_id' : product_color_id },
                    success:function (result)
                    {
                        $(obj).closest('tr').remove();
                        alert(result.message);
                    }
                });
            });

        });

        ClassicEditor.create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            });
    </script>
@endpush
