<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    public $optionsPerPage = [5,10,15,25,50,100];
    public $perPage;
    public User $selectedUser;
    public string $search = '';
    public array $selectedUsers = [];

    protected $updatesQueryString = ['search']; // mantém o valor ao trocar de página

    public function mount()
    {
        $this->perPage = 10;
    }

    public function toggleStatus(User $user)
    {
        $user->active = !$user->active;
        $user->save();

        $this->dispatch('show-message', [
            'type' => 'success',
            'message' => 'Status do usuário atualizado com sucesso.',
        ]);
    }

    public function render()
    {
        $users = User::where('name', '!=', 'suporte')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->paginate($this->perPage);
        return view('livewire.user-list')->with('users', $users);
    }
}
