<div>
    <form class="p-6">

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Alterar Tipo de Categoria
        </h2>
        <div class="grid grid-cols-3 gap-2 pt-4">
            <div>
                <span class="font-bold">Nome: </span>
                {{ $selectedType->name??'' }}
            </div>
        </div>

        <div class="grid grid-cols-2 pt-4 gap-4">
            <div>
                <x-input-label for="name" :value="__('Nome').'*'"/>
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" wire:model.live="name" value="{{ $selectedType->name??'' }}" />
            </div>
        </div>
        

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-success-button class="ms-3" wire:click.prevent="updateType">
                Salvar
            </x-success-button>
        </div>
    </form>
</div>