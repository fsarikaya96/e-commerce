<div>
    <!-- Delete Brand Modal -->
    <div wire:ignore.self class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ürün Sil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div wire:loading class="align-self-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Yükleniyor...</span>
                    </div>
                    <span class="p-2">Yükleniyor...</span>
                </div>
                <div wire:loading.remove>
                    <form wire:submit.prevent="destroyProduct">
                        <div class="modal-body">
                            <h5>Ürünü fotoğraflarla birlikte silmek istediğinize emin misiniz?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                            <button type="submit" class="btn btn-primary text-white">Evet, Sil</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Ürün Listesi
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary text-white float-end">Ürün
                            Ekle</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kategori</th>
                            <th>Ürün İsmi</th>
                            <th>Satış Fiyat</th>
                            <th>Adet</th>
                            <th>Durum</th>
                            <th>Eylemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                @if($product->category)
                                    <td>{{ $product->category->name }}</td>
                                @else
                                    <td>Ürünün Kategorisi Bulunamadı.</td>
                                @endif
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->selling_price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>@if($product->status == 1)
                                        <span class="status-success">Yayında</span>
                                    @else
                                        <span class="status-danger">Yayında Değil</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.products.edit',$product->id) }}" class="btn btn-success">Düzenle</a>
                                    <a href="#" data-bs-toggle="modal"
                                       data-bs-target="#deleteProductModal"
                                       wire:click="deleteProduct({{ $product->id }})" class="btn btn-danger">Sil</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">Ürün Bulunamadı.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
