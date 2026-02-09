<div>
    <form class="p-6">

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ $selectedAccount && $selectedAccount->type == 'R' ? 'Receber': 'Pagar' }} 
            Conta | {{ $selectedAccount->description??'' }}
        </h2>
        <div class="grid grid-cols-3 gap-2 pt-4">
            <div>
                <span class="font-bold">Associado: </span>
                {{ $selectedAccount->associate->name??'' }}
            </div>

        </div>

        <div class="grid grid-cols-3 gap-2 pt-4">
            <div>
                <x-input-label for="transaction_date" :value="__('Data do Pagamento').'*'" title="Data de recebimento do pagamento"/>
                <x-text-input id="transaction_date" name="transaction_date" type="date" class="mt-1 block w-full" wire:model.live="transaction_date" aria-required="true" value="{{ $transaction_date }}" />
            </div>
        </div>
        

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            @if ($transaction_date)
                <x-success-button class="ms-3" x-bind:disabled="!$wire.transaction_date" wire:click.prevent="payAccount">
                    {{ $selectedAccount && $selectedAccount->type == 'R' ? 'Receber': 'Pagar' }}
                </x-success-button>
            @endif
        </div>
    </form>
</div>