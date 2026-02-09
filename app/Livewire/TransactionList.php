<?php

namespace App\Livewire;

use App\Models\CashBox;
use App\Models\Category;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionList extends Component
{
    use WithPagination;
    
    public $optionsPerPage = [5,10,15,25,50,100];
    public $perPage;
    public $status;
    public string $search = '';
    public ?string $start_date = null;
    public ?string $end_date = null;
    public $showFilters = false;
    public $filterType = '';
    public $filterCategory = '';
    public array $selectedTransactions = [];
    public CashBox $cashboxAmount;
    public Transaction $selectedTransaction;
    public $categories;

    protected $updatesQueryString = ['search'];

    public function viewTransaction(Transaction $transaction){
        $this->selectedTransaction = $transaction;
        $this->dispatch('open-modal', 'view-transaction');
    }

    public function toggleFilters()
    {
        $this->showFilters = !$this->showFilters;
    }

    public function updating($name, $value)
    {
        if (in_array($name, ['search', 'filterCategory', 'filterType', 'start_date', 'end_date'])) {
            $this->resetPage();
        }
    }

    public function getFilteredTransactions()
    {
        return Transaction::where(function ($query) {
        $query->where('description', 'like', '%' . $this->search . '%')
            ->orWhereHas('category', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
        })
        ->when($this->filterCategory, function ($query) {
            $query->where('category_id', $this->filterCategory);
        })
        ->when($this->filterType, function ($query) {
            $query->where('type', $this->filterType);
        })
        ->when($this->start_date, function($query){
            $query->where('transaction_date', '>=', $this->start_date." 00:00:00");
        })
        ->when($this->end_date, function($query){
            $query->where('transaction_date', '<=', $this->end_date." 00:00:00");
        })
        ->orderBy('created_at', 'DESC');
    }

    public function export($format = 'pdf')
    {
        $transactionsQuery = $this->getFilteredTransactions(); // Aqui pega todos os dados filtrados

        $clonedQuery = (clone $transactionsQuery);

        $totalEntrada = (clone $clonedQuery)->where('type', 'E')->sum('amount');
        $totalSaida   = (clone $clonedQuery)->where('type', 'S')->sum('amount');
        $saldoTotal   = $totalEntrada - $totalSaida;

        $pdf = Pdf::loadView('reports.transactions', [
            'transactions' => $transactionsQuery->get(),
            'cashboxAmount' => $this->cashboxAmount, 
            'totalFiltered'=>$saldoTotal,
            'filterType' => $this->filterType,
            'filterCategory' => $this->filterCategory,
            'start_date' => $this->start_date ? Carbon::parse($this->start_date)->format("d/m/Y") : null,
            'end_date' => $this->end_date ? Carbon::parse($this->end_date)->format("d/m/Y") : null,
        ]);
        $pdf->setPaper('a4', 'landscape');
        return response()->streamDownload(fn () => print($pdf->stream()), 'Movimentações Financeiras - AVECAD.pdf');
    }

    public function mount(){
        $amount = CashBox::find(1);
        $this->cashboxAmount = $amount;
        $this->perPage = 10;
        $this->categories = Category::all();
    }

    public function render()
    {
        $transactionsQuery = $this->getFilteredTransactions();

        $clonedQuery = (clone $transactionsQuery);

        $totalEntrada = (clone $clonedQuery)->where('type', 'E')->sum('amount');
        $totalSaida   = (clone $clonedQuery)->where('type', 'S')->sum('amount');
        $saldoTotal   = $totalEntrada - $totalSaida;

        return view('livewire.transaction-list')->with([
            'transactions' => $transactionsQuery->paginate($this->perPage),
            'totalAmount' => $saldoTotal,
        ]);
    }
}
