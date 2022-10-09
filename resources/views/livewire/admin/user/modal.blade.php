<!-- Store User Modal -->
<div wire:ignore.self class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kullanıcı Ekle</h5>
                <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="storeUser">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name">İsim Soyisim</label>
                        <input type="text" id="name" wire:model.defer="name" class="form-control">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email">E-Mail</label>
                        <input type="text" id="email" wire:model.defer="email" class="form-control">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password">Parola</label>
                        <input type="text" id="password" wire:model.defer="password" class="form-control">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="passwordAgain">Parola (Tekrarı)</label>
                        <input type="text" id="passwordAgain" wire:model.defer="passwordAgain" class="form-control">
                        @error('passwordAgain') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="role_as">Rol Seçiniz</label>
                        <select wire:model.defer="role_as" id="role_as" class="form-control">
                            <option value="">--Rol Seçiniz--</option>
                            <option value="0">Misafir</option>
                            <option value="1">Admin</option>
                        </select>
                        @error('role_as') <small class="text-danger">{{ $message }}</small> @enderror
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

<!-- Update User Modal -->
<div wire:ignore.self class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kullanıcı Ekle</h5>
                <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="updateUser">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name">İsim Soyisim</label>
                        <input type="text" id="name" wire:model.defer="name" class="form-control">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email">E-Mail</label>
                        <input type="text" id="email" wire:model.defer="email" class="form-control">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password">Parola</label>
                        <input type="text" id="password" wire:model.defer="password" class="form-control">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="passwordAgain">Parola (Tekrarı)</label>
                        <input type="text" id="passwordAgain" wire:model.defer="passwordAgain" class="form-control">
                        @error('passwordAgain') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="role_as">Rol Seçiniz</label>
                        <select wire:model.defer="role_as" id="role_as" class="form-control">
                            <option value="">--Rol Seçiniz--</option>
                            <option value="0">Misafir</option>
                            <option value="1">Admin</option>
                        </select>
                        @error('role_as') <small class="text-danger">{{ $message }}</small> @enderror
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

<!-- Delete User Modal -->
<div wire:ignore.self class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kullanıcı Sil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div wire:loading class="align-self-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Yükleniyor...</span>
                </div>
                <span class="p-2">Yükleniyor...</span>
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="destroyUser">
                    <div class="modal-body">
                        <h5>Kullanıcıyı silmek istediğinize emin misiniz?</h5>
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
