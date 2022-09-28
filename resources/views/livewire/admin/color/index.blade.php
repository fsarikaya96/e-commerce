<div>
    @include('layouts.partials.livewire_alert')
    @include('livewire.admin.color.modal')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Renkler
                        <a class="btn btn-primary float-end text-white" data-bs-toggle="modal"
                           data-bs-target="#addColorModal" wire:click="openModal">Renk Ekle</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Renk Adı</th>
                            <th>Renk Kodu</th>
                            <th>Durum</th>
                            <th>Eylemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($colors as $color)
                            <tr>
                                <td>{{ $color->id }}</td>
                                <td>{{ $color->name }}</td>
                                <td>{{ $color->code }}</td>
                                <td>@if($color->status == 1)
                                        <span class="status-success">Yayında</span>
                                    @else
                                        <span class="status-danger">Yayında Değil</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" data-bs-toggle="modal"
                                       data-bs-target="#updateColorModal" wire:click="editColor({{ $color->id}})" class="btn btn-success">Düzenle</a>
                                    <a data-bs-toggle="modal"
                                       data-bs-target="#deleteColorModal" wire:click="deleteColor({{ $color->id}})" class="btn btn-danger">Sil</a>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


