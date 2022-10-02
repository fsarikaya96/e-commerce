<!-- Store Brand Modal -->
<div wire:ignore.self class="modal fade" id="addColorModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Renk Ekle</h5>
                <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="storeColor">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name">Renk Adı</label>
                        <input type="text" id="name" wire:model.defer="name" class="form-control">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="code">Renk Kodu</label>
                        <input type="text" wire:model.defer="colorInput" class="form-control code" disabled>
                        @error('code') <small class="text-danger">{{ $message }}</small> @enderror
                        <div class="mt-2">
                        <input type="color" wire:model.defer="code" class="form-control form-control-color" id="colorPicker" value="#000002">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="status">Durum</label><br>
                        <input type="checkbox" class="status-checkbox" id="status" wire:model.defer="status">
                        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary text-white" data-bs-dismiss="modal">
                        Kapat
                    </button>
                    <button type="submit" class="btn btn-primary text-white">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Brand Modal -->
<div wire:ignore.self class="modal fade" id="updateColorModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                        aria-label="Close"></button>
            </div>
            <div wire:loading class="align-self-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Yükleniyor...</span>
                </div>
                <span class="p-2">Yükleniyor...</span>
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="updateColor">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name">İsim</label>
                            <input type="text" id="name" wire:model.defer="name" class="form-control">
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="code">Renk Kodu</label>
                            <input type="text" wire:model.defer="colorInput" class="form-control code" disabled>
                            @error('code') <small class="text-danger">{{ $message }}</small> @enderror
                            <div class="mt-2">
                                <input type="color" wire:model.defer="code" class="form-control form-control-color" id="colorPicker" value="#000002">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="status">Durum</label><br>
                            <input type="checkbox" class="status-checkbox" id="status" wire:model.defer="status">
                            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-white" wire:click="closeModal" data-bs-dismiss="modal">
                            Kapat
                        </button>
                        <button type="submit" class="btn btn-primary text-white">Güncelle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Brand Modal -->
<div wire:ignore.self class="modal fade" id="deleteColorModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Marka Sil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div wire:loading class="align-self-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Yükleniyor...</span>
                </div>
                <span class="p-2">Yükleniyor...</span>
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="destroyColor">
                    <div class="modal-body">
                        <h5>Markayı silmek istediğinize emin misiniz?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary text-white">Evet, Sil</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
