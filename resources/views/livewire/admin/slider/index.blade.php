<div>
    <!-- Delete Brand Modal -->
    <div wire:ignore.self class="modal fade" id="deleteSliderModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Slider Sil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div wire:loading class="align-self-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Yükleniyor...</span>
                    </div>
                    <span class="p-2">Yükleniyor...</span>
                </div>
                <div wire:loading.remove>
                    <form wire:submit.prevent="destroySlider">
                        <div class="modal-body">
                            <h5>Slider'ı silmek istediğinize emin misiniz?</h5>
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
    @include('layouts.partials.livewire_alert')
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
                            <th>Url</th>
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
                                <td>{!! Str::limit($slider->description,50) !!}</td>
                                <td>{{  $slider->link }}</td>
                                <td>@if($slider->status == 1)
                                        <span class="status-success">Yayında</span>
                                    @else
                                        <span class="status-danger">Yayında Değil</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.sliders.edit',$slider->id) }}" class="btn btn-success">Düzenle</a>
                                    <a data-bs-toggle="modal" data-bs-target="#deleteSliderModal" wire:click="deleteSlider({{ $slider->id }})" class="btn btn-danger">Sil</a>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                    {{ $sliders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


