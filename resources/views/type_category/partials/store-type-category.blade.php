<div>
    <form class="p-6">

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Cadastrar Tipo de Categoria
        </h2>

        <div class="grid grid-cols-2 pt-4 gap-4">
            <div>
                <x-input-label for="name" :value="__('Nome').'*'"/>
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" wire:model="name" />
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-success-button class="ms-3" wire:click.prevent="storeType">
                Salvar
            </x-success-button>
        </div>
    </form>
</div>