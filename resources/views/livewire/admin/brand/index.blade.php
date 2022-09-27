<div>
    @include('livewire.admin.brand.modal')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Markalar
                        <a class="btn btn-primary btn-sm float-end" data-bs-toggle="modal"
                           data-bs-target="#addBrandModal">Marka Ekle</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>İsim</th>
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
                                <td>{{ $brand->slug }}</td>
                                <td>@if($brand->status == 1)
                                        <span class="status-success">Yayında</span>
                                    @else
                                        <span class="status-danger">Yayında Değil</span>
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
                                <td colspan="5">Marka Bulunamadı.</td>
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


