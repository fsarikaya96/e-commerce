<div>
    @include('layouts.partials.livewire_alert')
    @include('livewire.admin.color.modal')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Slider Listesi
                        <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary float-end text-white">Slider
                            Ekle</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Başlık</th>
                            <th>Açıklama</th>
                            <th>Durum</th>
                            <th>Eylemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($sliders as $slider)
                            <tr>
                                <td>
                                    <img class="slider-img" src="{{ asset($slider->image) }}" alt="Fotoğraf Bulunumadı.">
                                </td>
                                <td>{{ $slider->title }}</td>
                                <td>{{ $slider->description }}</td>
                                <td>@if($slider->status == 1)
                                        <span class="status-success">Yayında</span>
                                    @else
                                        <span class="status-danger">Yayında Değil</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.sliders.edit',$slider->id) }}" class="btn btn-success">Düzenle</a>
                                    <a data-bs-toggle="modal" data-bs-target="#deleteBrandModal" wire:click="deleteBrand({{ $slider->id }})" class="btn btn-danger">Sil</a>
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


