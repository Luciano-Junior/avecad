<?php

namespace App\Livewire;

use App\Models\Account;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
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
    public $filterCategory;
    public $filterType = '';
    public array $selectedAccounts = [];
    public $categories;

    protected $updatesQueryString = ['search'];

    public function getFilteredAccounts()
    {
        return Account::where(function ($query) {
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
        ->when($this->filterCategory, function ($query) {
            $query->where('category_id', $this->filterCategory);
        })
        ->when($this->start_date, function($query){
            $query->where('due_date', '>=', $this->start_date." 00:00:00");
        })
        ->when($this->end_date, function($query){
            $query->where('due_date', '<=', $this->end_date." 00:00:00");
        })
        ->orderBy('due_date', 'DESC');
    }

    public function toggleFilters()
    {
        $this->showFilters = !$this->showFilters;
    }

    public function updating($name, $value)
    {
        if (in_array($name, ['search', 'filterCategory', 'filterType', 'filterStatus', 'start_date', 'end_date'])) {
            $this->resetPage();
        }
    }

    public function export($format = 'pdf')
    {
        $accountsQuery = $this->getFilteredAccounts(); // Aqui pega todos os dados filtrados

        $clonedQuery = (clone $accountsQuery);

        $totalReceber = (clone $clonedQuery)->where('type', 'R')->sum('amount');
        $totalPagar   = (clone $clonedQuery)->where('type', 'P')->sum('amount');
        $totalPago   = (clone $clonedQuery)->where('status', 'Pago')->sum('amount');
        $saldoTotal   = $totalReceber - $totalPagar;

        $reportName = "Relatório de Contas";
        $reportName .= $this->filterType == "R" ? " a receber":'';
        $reportName .= $this->filterType == "P" ? " a pagar":'';
        $reportName .= ".pdf";

        $pdf = Pdf::loadView('reports.accounts', [
            'accounts' => $accountsQuery->get(),
            'saldoTotal' => $saldoTotal,
            'filterType' => $this->filterType,
            'start_date' => ($this->start_date)?Carbon::parse($this->start_date)->format("d/m/Y"):null,
            'end_date' => ($this->end_date)?Carbon::parse($this->end_date)->format("d/m/Y"):null,
            'totalReceber' => $totalReceber,
            'totalPagar' => $totalPagar,
            'totalRecebido' => $totalPago,
        ]);
        $pdf->setPaper('a4', 'landscape');
        return response()->streamDownload(fn () => print($pdf->stream()), $reportName);
    }

    public function mount()
    {
        $this->perPage = 10;
        $this->categories = Category::all();
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
        $accountsQuery = $this->getFilteredAccounts();

        return view('livewire.account-list')->with('accounts',$accountsQuery->paginate($this->perPage));
    }
}
