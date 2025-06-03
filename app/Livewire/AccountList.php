<?php

namespace App\Livewire;

use App\Models\Account;
use Livewire\Component;
use Livewire\WithPagination;

class AccountList extends Component
{
    use WithPagination;
    
    public $optionsPerPage = [5,10,15,25,50,100];
    public $perPage;
    public $status;
    public string $search = '';
    public ?string $start_date = null;
    public ?string $end_date = null;
    public $showFilters = false;
    public $filterStatus;
    public $filterType = '';
    public array $selectedAccounts = [];

    protected $updatesQueryString = ['search'];

    public function toggleFilters()
    {
        $this->showFilters = !$this->showFilters;
    }

    public function updatingSearch()
    {
        $this->resetPage(); // reseta a paginação ao buscar
    }

    public function mount()
    {
        $this->perPage = 10;
    }

    public function payAccount(Account $account){
        $response = Account::payAccount($account);
        $this->dispatch('show-message', [
            'type' => $response['status'],
            'message' => $response['message'],
        ]);
    }

    public function reversePayment(Account $account){
        $response = Account::reversePayment($account);
        $this->dispatch('show-message', [
            'type' => $response['status'],
            'message' => $response['message'],
        ]);
    }

    public function render()
    {
        $accounts = Account::where(function ($query) {
        $query->where('description', 'like', '%' . $this->search . '%')
            ->orWhere('status', 'like', '%' . $this->search . '%')
            ->orWhereHas('associate', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
        })
        ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
        })
        ->when($this->filterType, function ($query) {
            $query->where('type', $this->filterType);
        })
        ->when($this->start_date, function($query){
            $query->where('due_date', '>=', $this->start_date." 00:00:00");
        })
        ->when($this->end_date, function($query){
            $query->where('due_date', '<=', $this->end_date." 00:00:00");
        })
        ->orderBy('due_date', 'DESC')
        ->paginate($this->perPage);

        return view('livewire.account-list')->with('accounts',$accounts);
    }
}
