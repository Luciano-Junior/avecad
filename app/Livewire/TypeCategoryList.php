<?php

namespace App\Livewire;

use App\Models\TypeCategory;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class TypeCategoryList extends Component
{
    use WithPagination;

    public $optionsPerPage = [5,10,15,25,50,100];
    public $perPage;
    public string $search = '';
    public array $selectedTypes = [];
    public TypeCategory $selectedType;

    #[Validate('required|max:255|string|unique:type_categories,name')]
    public string $name = '';

    protected $updatesQueryString = ['search'];

    public function getFilteredTypes()
    {
        return TypeCategory::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        });
    }

    public function viewEditType(TypeCategory $type){
        $this->name = $type->name;
        $this->selectedType = $type;
        $this->dispatch('open-modal', 'edit-type');
    }

    public function updateType(){
        $this->selectedType->name = $this->name;
        try {
            $type = TypeCategory::findOrFail($this->selectedType->id);

            $type->name = $this->selectedType->name;
            $type->save();

            $this->dispatch('close-modal', 'edit-type');

            $this->dispatch('show-message', [
                'type' => "success",
                'message' => "Registro atualizado com sucesso",
            ]);
            $this->reset(['name']);
        } catch (\Exception $e) {
            $this->dispatch('show-message', [
                'type' => "error",
                'message' => "Erro ao atualizar tipo - ".$e->getMessage(),
            ]);
        }
    }

    public function modalStoreType()
    {
        $this->resetErrorBag();
        $this->reset(['name']);
        $this->dispatch('open-modal', 'store-type');
    }

    public function storeType()
    {
        $this->validate();

        try {
            TypeCategory::create([
                'name' => $this->name,
            ]);

            $this->dispatch('close-modal', 'store-type');
            $this->dispatch('show-message', [
                'type' => "success",
                'message' => "Tipo criado com sucesso",
            ]);
            $this->reset(['name']);
        } catch (\Exception $e) {
            $this->dispatch('show-message', [
                'type' => "error",
                'message' => "Erro ao criar tipo - ".$e->getMessage(),
            ]);
        }
    }

    public function mount()
    {
        $this->perPage = 10; // Default items per page
    }

    public function deleteType(TypeCategory $type)
    {
        try {
            $type->delete();
            $this->dispatch('show-message', [
                'type' => "success",
                'message' => "Tipo excluído com sucesso",
            ]);
        } catch (\Exception $e) {
            $this->dispatch('show-message', [
                'type' => "error",
                'message' => "Erro ao excluir tipo - ".$e->getMessage(),
            ]);
        }
    }

    public function render()
    {
        $typesQuery = $this->getFilteredTypes();
        return view('livewire.type-category-list', [
            'typeCategories' => $typesQuery->paginate($this->perPage),
        ]);
    }
}
