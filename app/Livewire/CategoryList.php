<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryList extends Component
{
    use WithPagination;

    public $optionsPerPage = [5,10,15,25,50,100];
    public $perPage;
    public string $search = '';
    public array $selectedCategories = [];
    public Category $selectedCategory;

    #[Validate('required|max:255|string|unique:categories,name')]
    public string $name = '';
    #[Validate('required|max:255|string')]
    public string $description = '';

    protected $updatesQueryString = ['search'];

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres.',
            'name.unique' => 'Já existe uma categoria com este nome.',
            'description.required' => 'O campo descrição é obrigatório.',
            'description.max' => 'O campo descrição deve ter no máximo 255 caracteres.',
        ];
    }

    public function getFilteredCategories()
    {
        return Category::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        });
    }

    public function viewEditCategory(Category $category){
        $this->name = $category->name;
        $this->description = $category->description;
        $this->selectedCategory = $category;
        $this->dispatch('open-modal', 'edit-category');
    }

    public function updateCategory(){
        $this->selectedCategory->name = $this->name;
        $this->selectedCategory->description = $this->description;
        try {
            $category = Category::findOrFail($this->selectedCategory->id);

            $category->name = $this->selectedCategory->name;
            $category->description = $this->selectedCategory->description;
            $category->save();

            $this->dispatch('close-modal', 'edit-category');

            $this->dispatch('show-message', [
                'type' => "success",
                'message' => "Registro atualizado com sucesso",
            ]);
            $this->reset(['name', 'description']);
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
        $this->reset(['name', 'description']);
        $this->dispatch('open-modal', 'store-category');
    }

    public function storeCategory()
    {
        $this->validate();

        try {
            Category::create([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            $this->dispatch('close-modal', 'store-category');
            $this->dispatch('show-message', [
                'type' => "success",
                'message' => "Categoria criada com sucesso",
            ]);
            $this->reset(['name', 'description']);
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
        return view('livewire.category-list', [
            'categories' => $categoriesQuery->paginate($this->perPage),
        ]);
    }
}
