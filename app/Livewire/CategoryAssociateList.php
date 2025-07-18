<?php

namespace App\Livewire;

use App\Models\CategoryAssociate;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryAssociateList extends Component
{
    use WithPagination;

    public $optionsPerPage = [5,10,15,25,50,100];
    public $perPage;
    public string $search = '';
    public array $selectedCategories = [];
    public CategoryAssociate $selectedCategory;

    #[Validate('required|max:255|string|unique:category_associate,name')]
    public string $name = '';

    protected $updatesQueryString = ['search'];

    public function getFilteredCategories()
    {
        return CategoryAssociate::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        });
    }

    public function viewEditCategory(CategoryAssociate $category){
        $this->name = $category->name;
        $this->selectedCategory = $category;
        $this->dispatch('open-modal', 'edit-category');
    }

    public function updateCategory(){
        $this->selectedCategory->name = $this->name;
        try {
            $category = CategoryAssociate::findOrFail($this->selectedCategory->id);

            $category->name = $this->selectedCategory->name;
            $category->save();

            $this->dispatch('close-modal', 'edit-category');

            $this->dispatch('show-message', [
                'type' => "success",
                'message' => "Registro atualizado com sucesso",
            ]);
            $this->reset(['name']);
        } catch (\Exception $e) {
            $this->dispatch('show-message', [
                'type' => "error",
                'message' => "Erro ao atualizar categoria - ".$e->getMessage(),
            ]);
        }
    }

    public function modalStoreCategory()
    {
        $this->resetErrorBag();
        $this->reset(['name']);
        $this->dispatch('open-modal', 'store-category');
    }

    public function storeCategory()
    {
        $this->validate();

        try {
            CategoryAssociate::create([
                'name' => $this->name,
            ]);

            $this->dispatch('close-modal', 'store-category');
            $this->dispatch('show-message', [
                'type' => "success",
                'message' => "Categoria criada com sucesso",
            ]);
            $this->reset(['name']);
        } catch (\Exception $e) {
            $this->dispatch('show-message', [
                'type' => "error",
                'message' => "Erro ao criar categoria - ".$e->getMessage(),
            ]);
        }
    }

    public function mount()
    {
        $this->perPage = 10; // Default items per page
    }


    public function render()
    {
        $categoriesQuery = $this->getFilteredCategories();
        return view('livewire.category-associate-list', [
            'categories' => $categoriesQuery->paginate($this->perPage),
        ]);
    }
}
