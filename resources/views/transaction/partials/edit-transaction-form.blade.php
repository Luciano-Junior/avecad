<section>
    <header>
        <h2 class="ml-2 text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Alterar Movimentação') }}
        </h2>

    </header>

    <form method="post" action="{{ route('transaction.update', $transaction->id) }}" class="mt-6 space-y-6 px-3">
        @csrf
        @method('put')
        <div class="grid grid-cols-3 gap-2">
            <div class="col-span-2">
                <x-input-label for="description" :value="__('Description').'*'" />
                <x-text-input id="description" name="description" type="text" :value="old('description',$transaction->description)" class="mt-1 block w-full" autocomplete="name" placeholder="Mensalidade do Jõao" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="category" :value="__('Category').'*'" />
                <x-select name="category_id" id="category">
                    <option value="">Selecione uma categoria</option>

                    @foreach ($categories as $typeName => $groupedCategories)
                        <optgroup label="{{ $typeName }}">
                            @foreach ($groupedCategories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $transaction->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </x-select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>
        </div>

        <div class="grid grid-cols-3 gap-2">
            <div>
                <x-input-label for="type" :value="__('Type').'*'" />
                <x-select name="type" id="type">
                    <option value="E" {{ $transaction->type == 'E' ? 'selected':'' }}>Entrada</option>
                    <option value="S" {{ $transaction->type == 'S' ? 'selected':'' }}>Saída</option>
                </x-select>
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
            </div>
            <div x-data="currencyMask('')">
                <x-input-label for="amount" :value="__('Amount').'*'" />
                <x-text-input id="amount" name="amount" type="text" class="mt-1 block w-full" x-model="amount" :value="old('amount', $transaction->amount)"
                x-data="currencyMask('{{ old('amount', $transaction->amount) }}')" 
                x-on:input="formatCurrency()"
                placeholder="100,00"/>
                <x-input-error :messages="$errors->get('amount')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="transaction_date" :value="__('Data da Movimentação').'*'" />
                <x-text-input id="transaction_date" name="transaction_date" type="date" class="mt-1 block w-full" :value="old('transaction_date', $transaction->transaction_date->format('Y-m-d'))" autocomplete="admission_date" />
                <x-input-error :messages="$errors->get('transaction_date')" class="mt-2" />
            </div>
        </div>    

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'transaction-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>