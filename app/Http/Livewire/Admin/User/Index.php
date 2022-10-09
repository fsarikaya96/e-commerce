<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use App\Services\Interfaces\IUserService;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $name, $email, $password, $passwordAgain, $role_as, $userID;
    private FlasherInterface $flasher;
    private IUserService $userService;
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    /**
     * User construct
     *
     * @param IUserService $IUserService
     * @param FlasherInterface $IFlasherInterface
     */
    public function boot(IUserService $IUserService,FlasherInterface $IFlasherInterface)
    {
        $this->userService = $IUserService;
        $this->flasher = $IFlasherInterface;
    }

    public function rules()
    {
        return User::rules($this->userID);
    }

    public function closeModal()
    {
        $this->resetValidation();
        $this->resetForm();
    }

    public function openModal()
    {
        $this->resetValidation();
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->name          = null;
        $this->email         = null;
        $this->password      = null;
        $this->passwordAgain = null;
        $this->role_as       = null;
        $this->userID        = null;
    }

    public function storeUser(User $user)
    {
        $validatedData = $this->validate();
        $userData = $user->fill($validatedData);
        $this->userService->create($userData);
        $this->flasher->addSuccess('Kullanıcı Başarıyla Eklendi!');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetForm();
    }

    public function editUser($id)
    {
        $this->resetValidation();
        $user                = $this->userService->getUsersByCondition(['id' => $id])->firstOrFail();
        $this->name          = $user->name;
        $this->email         = $user->email;
        $this->password      = $user->password;
        $this->passwordAgain = $user->password;
        $this->role_as       = $user->role_as;
        $this->userID        = $user->id;
    }

    public function updateUser()
    {
        $validatedData = $this->validate();
        $user = $this->userService->getUsersByCondition(['id' => $this->userID])->firstOrFail();
        $userData = $user->fill($validatedData);
        $this->userService->update($userData);
        $this->flasher->addSuccess('Kullanıcı Başarıyla Güncellendi!');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetForm();
    }

    public function deleteUser($id)
    {
        $this->userID = $id;
    }

    public function destroyUser()
    {
        $this->userService->delete($this->userID);
        $this->flasher->addSuccess('Kullanıcı Başarıyla Silindi!');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetForm();
    }

    public function render()
    {
        $users = $this->userService->getUsersWithPaginate();

        return view('livewire.admin.user.index', ['users' => $users]);
    }
}
