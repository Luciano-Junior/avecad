<div>
    <form class="p-6">

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Alterar Configuração
        </h2>
        <div class="grid grid-cols-3 gap-2 pt-4">
            <div>
                <span class="font-bold">Chave: </span>
                {{ $selectedConfiguration->key??'' }}
            </div>
            {{ $selectedConfiguration->value??'' }}
        </div>

        <div class="grid grid-cols-1 pt-4">
            <div>
                <x-input-label for="valor" :value="__('Valor').'*'"/>
                <x-text-input id="valor" name="valor" type="text" class="mt-1 block w-50" wire:model.live="value" value="{{ $selectedConfiguration->value??'' }}" />
            </div>
        </div>
        

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-success-button class="ms-3" wire:click.prevent="updateConfiguration">
                Salvar
            </x-success-button>
        </div>
    </form>
</div>