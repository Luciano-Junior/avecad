<?php

namespace App\Livewire;

use App\Models\Associate;
use App\Services\MonthlyFeesService;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AssociateList extends Component
{
    use WithPagination;

    public $optionsPerPage = [5,10,15,25,50,100];
    public $perPage;
    public Associate $selectedAssociate;
    public string $search = '';
    public int $quantity = 1;
    public String $start_month = '';
    public array $selectedAssociates = [];

    protected $updatesQueryString = ['search']; // mantém o valor ao trocar de página

    public function SelectedAssociates()
    {
        // Exemplo: log($this->selectedAssociates);
    }

    public function mount()
    {
        $this->start_month = now()->format('Y-m');
        $this->perPage = 10;
    }

    public function updatingSearch()
    {
        $this->resetPage(); // reseta a paginação ao buscar
    }

    public function generateMonthlyFees(){
        $service = new MonthlyFeesService();
        $response = $service->generate($this->quantity, $this->start_month, $this->selectedAssociate);

        $this->dispatch('close-modal', 'generate-monthlyfees');

        $this->dispatch('show-message', [
            'type' => $response['status'],
            'message' => $response['message'],
        ]);

    }


    public function viewGenerateMonthlyFees(Associate $associate){
        $this->selectedAssociate = $associate;
        $this->dispatch('open-modal', 'generate-monthlyfees');
    }

    public function render()
    {
        $associates = Associate::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('cpf', 'like', '%' . $this->search . '%')
            ->orderBy('name')
            ->paginate($this->perPage);
        return view('livewire.associate-list')->with('associates',$associates);
    }

    public function exportarSelecionados()
    {
        if (empty($this->selectedAssociates)) {
            $this->dispatchBrowserEvent('notify', ['message' => 'Nenhum associado selecionado.', 'type' => 'error']);
            return;
        }

        $associates = Associate::whereIn('id', $this->selectedAssociates)->get();

        $response = new StreamedResponse(function() use ($associates) {
            $handle = fopen('php://output', 'w');

            // Cabeçalho CSV
            fputcsv($handle, ['ID', 'Nome', 'Sobrenome', 'Data de Admissão', 'Contato', 'Contato Familiar', 'Status']);

            foreach ($associates as $associate) {
                fputcsv($handle, [
                    $associate->id,
                    $associate->name,
                    $associate->surname,
                    $associate->data_formatada,
                    $associate->contact_formatado,
                    $associate->family_contact_formatado,
                    $associate->active ? 'Ativo' : 'Inativo',
                ]);
            }

            fclose($handle);
        });

        $filename = 'associados_export_' . now()->format('Ymd_His') . '.csv';

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');

        return $response;
    }
}
