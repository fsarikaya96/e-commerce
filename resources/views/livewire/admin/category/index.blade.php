<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kategori Sil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyCategory">
                    <div class="modal-body">
                        <h6>Kategoriyi silmek istediğinize emin misiniz?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Evet, Sil</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Kategori
                        <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-sm float-end">Ekle</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Resim</th>
                            <th>İsim</th>
                            <th>Slug</th>
                            <th>Durum</th>
                            <th>Eylemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td><img class="category-img" src="{{ asset("/uploads/category/$category->image") }}"
                                         alt="Fotoğraf Bulunumadı."></td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->status ? "Hidden" : "Visible" }}</td>
                                <td>
                                    <a href="{{ route('admin.category.edit',$category->id) }}" class="btn btn-success">Düzenle</a>
                                    <a href="#" wire:click="deleteCategory({{ $category->id }})"
                                       data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger">Sil</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        window.addEventListener('close-modal',event => {
            $('#deleteModal').modal('hide');
        });
    </script>

@endpush
