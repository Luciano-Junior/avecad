<div>
    <form class="p-6">

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Alterar Categoria
        </h2>
        <div class="grid grid-cols-3 gap-2 pt-4">
            <div>
                <span class="font-bold">Nome: </span>
                {{ $selectedCategory->name??'' }}
            </div>
            <div>
                <span class="font-bold">Descrição: </span>
                {{ $selectedCategory->description??'' }}
            </div>
        </div>

        <div class="grid grid-cols-2 pt-4 gap-4">
            <div>
                <x-input-label for="name" :value="__('Nome').'*'"/>
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" wire:model.live="name" value="{{ $selectedCategory->name??'' }}" />
            </div>
            <div>
                <x-input-label for="description" :value="__('Descrição').'*'"/>
                <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" wire:model.live="description" value="{{ $selectedCategory->description??'' }}" />
            </div>
        </div>
        <div>
            <x-input-label for="type_category_id" :value="__('Tipo de Categoria').'*'" />
                <x-select name="type_category_id" id="type_category_id" wire:model.live="type_category_id">
                    <option value="">Selecione um tipo de categoria</option>
                    @foreach ($typeCategories as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </x-select>
                @error('type_category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-success-button class="ms-3" wire:click.prevent="updateCategory">
                Salvar
            </x-success-button>
        </div>
    </form>
</div>