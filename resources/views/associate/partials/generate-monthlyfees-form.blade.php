<div>
    <form class="p-6">

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Gerar mensalidades | {{ $selectedAssociate->name??'' }}
        </h2>
        <div class="grid grid-cols-3 gap-2 pt-4">
            <div>
                <span class="font-bold">Associado: </span>
                {{ $selectedAssociate->name??'' }}
            </div>
            <div>
                <span class="font-bold">Apelido: </span>
                {{ $selectedAssociate->surname??'' }}
            </div>

        </div>

        <div class="grid grid-cols-3 gap-2 pt-4">
            <div>
                <x-input-label for="quantity" value="Quantidade"  />
                <x-select wire:model.live="quantity" name="quantity" id="quantity">
                    <option value="1">1 Mensalidade</option>
                    <option value="6">6 Mensalidades</option>
                    <option value="12">12 Mensalidades</option>
                </x-select>
            </div>
            <div>
                <x-input-label for="start_date" :value="__('Mês de Início').'*'" title="O vencimento seguirá o dia padrão configurado"/>
                <x-text-input id="start_date" name="start_date" type="month" class="mt-1 block w-full" wire:model.live="start_month" value="{{ $start_month }}" />
            </div>
        </div>
        

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-success-button class="ms-3" wire:click.prevent="generateMonthlyFees">
                Gerar
            </x-success-button>
        </div>
    </form>
</div>