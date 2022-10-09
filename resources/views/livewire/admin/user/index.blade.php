<div>
   @include('livewire.admin.user.modal')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Kullanıcılar
                        <a class="btn btn-primary float-end text-white" data-bs-toggle="modal"
                           data-bs-target="#addUserModal" wire:click="openModal">Kullanıcı Ekle</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>İsim Soyisim</th>
                            <th>E-Mail</th>
                            <th>Role</th>
                            <th>Eylemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->role_as == 1)
                                        <span class="badge btn-success text-white">Admin</span>
                                    @else
                                        <span class="badge btn-primary text-white">Misafir</span>
                                    @endif
                                </td>
                                <td>
                                    <a data-bs-toggle="modal"
                                       data-bs-target="#updateUserModal" wire:click="editUser({{ $user->id }})" class="btn btn-success">Düzenle</a>
                                    <a data-bs-toggle="modal"
                                       data-bs-target="#deleteUserModal" wire:click="deleteUser({{ $user->id }})" class="btn btn-danger">Sil</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Kullanıcı Bulunamadı.</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


