<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\TypeCategory;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;
use Ramsey\Uuid\Type\Integer;

class CategoryList extends Component
{
    use WithPagination;

    public $optionsPerPage = [5,10,15,25,50,100];
    public $perPage;
    public string $search = '';
    public array $selectedCategories = [];
    public Category $selectedCategory;
    public $typeCategories = [];

    #[Validate('required|max:255|string|unique:categories,name')]
    public string $name = '';
    #[Validate('required|max:255|string')]
    public string $description = '';
    #[Validate('required|exists:type_categories,id')]
    public string $type_category_id = '';

    protected $updatesQueryString = ['search'];

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres.',
            'name.unique' => 'Já existe uma categoria com este nome.',
            'description.required' => 'O campo descrição é obrigatório.',
            'description.max' => 'O campo descrição deve ter no máximo 255 caracteres.',
            'type_category_id.required' => 'O campo tipo de categoria é obrigatório.',
            'type_category_id.exists' => 'O tipo de categoria selecionado é inválido.',
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
        $this->type_category_id = $category->type_category_id;
        $this->selectedCategory = $category;
        $this->typeCategories = TypeCategory::all();
        $this->dispatch('open-modal', 'edit-category');
    }

    public function updateCategory(){
        $this->selectedCategory->name = $this->name;
        $this->selectedCategory->description = $this->description;
        $this->selectedCategory->type_category_id = $this->type_category_id;
        try {
            $category = Category::findOrFail($this->selectedCategory->id);

            $category->name = $this->selectedCategory->name;
            $category->description = $this->selectedCategory->description;
            $category->type_category_id = (Integer) $this->selectedCategory->type_category_id;
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
        $this->reset(['name', 'description','type_category_id']);
        $this->typeCategories = TypeCategory::all();
        $this->dispatch('open-modal', 'store-category');
    }

    public function storeCategory()
    {
        $this->validate();

        try {
            Category::create([
                'name' => $this->name,
                'description' => $this->description,
                'type_category_id' => (Integer) $this->type_category_id,
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
