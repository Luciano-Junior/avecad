<?php

namespace App\Livewire;

use App\Models\Configuration;
use Livewire\Component;
use Livewire\WithPagination;

class ConfigurationList extends Component
{
    use WithPagination;

    public $optionsPerPage = [5,10,15,25,50,100];
    public $perPage;
    public string $search = '';
    public array $selectedConfigurations = [];
    public Configuration $selectedConfiguration;
    public $value;

    protected $updatesQueryString = ['search'];

    public function getFilteredConfigurations()
    {
        return Configuration::where(function ($query) {
            $query->where('key', 'like', '%' . $this->search . '%');
        });
    }

    public function viewEditConfiguration(Configuration $configuration){
        $this->selectedConfiguration = $configuration;
        $this->value = $configuration->value;
        $this->dispatch('open-modal', 'edit-configuration');
    }

    public function updateConfiguration(){
        $this->selectedConfiguration->value = $this->value;
        try {
            $configuration = Configuration::findOrFail($this->selectedConfiguration->id);

            $configuration->key = $this->selectedConfiguration->key;
            $configuration->value = $this->selectedConfiguration->value;
            $configuration->save();

            $this->dispatch('close-modal', 'edit-configuration');

            $this->dispatch('show-message', [
                'type' => "success",
                'message' => "Registro atualizado com sucesso",
            ]);
        } catch (\Exception $e) {
            $this->dispatch('show-message', [
                'type' => "error",
                'message' => "Erro ao atualizar configuração - ".$e->getMessage(),
            ]);
        }
    }

    public function render()
    {
        $configurationsQuery = $this->getFilteredConfigurations();

        return view('livewire.configuration-list')->with('configurations',$configurationsQuery->paginate($this->perPage));
    }
}
