<div>
   @include('livewire.admin.brand.modal')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Markalar
                        <a class="btn btn-primary float-end text-white" data-bs-toggle="modal"
                           data-bs-target="#addBrandModal" wire:click="openModal">Marka Ekle</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>İsim</th>
                            <th>Kategori</th>
                            <th>Slug</th>
                            <th>Durum</th>
                            <th>Eylemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>
                                @if($brand->category)
                                    <td>{{ $brand->category->name }}</td>
                                    @else
                                    <td><span class="status-danger">Kategori bulunamadı.</span></td>
                                @endif
                                <td>{{ $brand->slug }}</td>
                                <td>@if($brand->status == 1)
                                        <span class="badge btn-success text-white">Yayında</span>
                                    @else
                                        <span class="badge btn-danger text-white">Yayında Değil</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" data-bs-toggle="modal"
                                       data-bs-target="#updateBrandModal" wire:click="editBrand({{ $brand->id }})" class="btn btn-success">Düzenle</a>
                                    <a data-bs-toggle="modal"
                                       data-bs-target="#deleteBrandModal" wire:click="deleteBrand({{ $brand->id }})" class="btn btn-danger">Sil</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Marka Bulunamadı.</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                    {{ $brands->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


