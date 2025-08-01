<?php

namespace App\Livewire;

use App\Models\Associate;
use App\Models\CategoryAssociate;
use App\Models\TypeAssociate;
use App\Services\MonthlyFeesService;
use Barryvdh\DomPDF\Facade\Pdf;
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
    public $showFilters = false;
    public $filterStatus;
    public $filterCategory;
    public $filterType;
    public ?string $start_date = null;
    public ?string $end_date = null;

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
        $associatesQuery = $this->getFilterAssociates();
        $categories = CategoryAssociate::all();
        $types = TypeAssociate::all();

        return view('livewire.associate-list')->with('associates',$associatesQuery->paginate($this->perPage))->with('categories', $categories)->with('types', $types);
    }

    public function export($format = 'pdf')
    {
        $associatesQuery = $this->getFilterAssociates(); // Aqui pega todos os dados filtrados

        $reportName = "Relatório de Associados";
        $reportName .= ".pdf";

        $pdf = Pdf::loadView('reports.associates', [
            'associates' => $associatesQuery->get(),
            'start_date' => ($this->start_date)?Carbon::parse($this->start_date)->format("d/m/Y"):null,
            'end_date' => ($this->end_date)?Carbon::parse($this->end_date)->format("d/m/Y"):null,
        ]);
        return response()->streamDownload(fn () => print($pdf->stream()), $reportName);
    }
    public function exportarInadimplentes($format = 'pdf')
    {
        $associatesQuery = Associate::whereHas('mounthlyFees', function ($query) {
            $query->where('status', '!=', 'Pago')
                ->where('due_date', '<=', now());
        })
        ->orderBy('name');

        $reportName = "Relatório de Associados Inadimplentes";
        $reportName .= ".pdf";

        $pdf = Pdf::loadView('reports.associates-defaulter', [
            'associates' => $associatesQuery->get(),
        ]);
        return response()->streamDownload(fn () => print($pdf->stream()), $reportName);
    }

    public function exportarAdimplentes($format = 'pdf')
    {
        $associatesQuery = Associate::whereHas('mounthlyFees', function ($query) {
            $query->where('status', '=', 'Pago')
                ->where('due_date', '<=', now());
        })
        ->orderBy('name');

        $reportName = "Relatório de Associados Adimplentes";
        $reportName .= ".pdf";

        $pdf = Pdf::loadView('reports.associates-adimplentes', [
            'associates' => $associatesQuery->get(),
        ]);
        return response()->streamDownload(fn () => print($pdf->stream()), $reportName);
    }

    public function toggleFilters()
    {
        $this->showFilters = !$this->showFilters;
    }

    public function getFilterAssociates()
    {
        return Associate::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('surname', 'like', '%' . $this->search . '%');
        })
        ->when($this->filterStatus == "0" || $this->filterStatus == "1", function ($query) {
            $query->where('active', $this->filterStatus);
        })
        ->when($this->start_date, function($query){
            $query->where('admission_date', '>=', $this->start_date." 00:00:00");
        })
        ->when($this->end_date, function($query){
            $query->where('admission_date', '<=', $this->end_date." 00:00:00");
        })
        ->when($this->filterCategory, function($query){
            $query->where('category_associate_id', $this->filterCategory);
        })
        ->when($this->filterType, function($query){
            $query->where('type_associate_id', $this->filterType);
        })
        ->orderBy('name');
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
