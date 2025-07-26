<section>
    <header>
        <h2 class="ml-2 text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Alterar conta') }}
        </h2>

    </header>

    <form method="post" action="{{ route('account.update', $account->id) }}" class="mt-6 space-y-6 px-3">
        @csrf
        @method('put')
        <div class="grid grid-cols-3 gap-2">
            <div class="col-span-2">
                <x-input-label for="description" :value="__('Description').'*'" />
                <x-text-input id="description" name="description" type="text" :value="old('description',$account->description)" class="mt-1 block w-full" autocomplete="name" placeholder="Mensalidade do Jõao" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="category" :value="__('Category').'*'" />
                <x-select name="category_id" id="category">
                    <option value=""></option>

                    @foreach ($categories as $typeName => $groupedCategories)
                        <optgroup label="{{ $typeName }}">
                            @foreach ($groupedCategories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $account->category_id == $category->id ? 'selected' : '' }}>
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
                    <option value="R" {{ $account->type == 'R' ? 'selected':'' }}>A receber</option>
                    <option value="P" {{ $account->type == 'P' ? 'selected':'' }}>A pagar</option>
                </x-select>
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
            </div>
            <div x-data="currencyMask('')">
                <x-input-label for="amount" :value="__('Amount').'*'" />
                <x-text-input id="amount" name="amount" type="text" class="mt-1 block w-full" x-model="amount" :value="old('amount', $account->amount)"
                x-data="currencyMask('{{ old('amount', $account->amount) }}')" 
                x-on:input="formatCurrency()"
                placeholder="100,00"/>
                <x-input-error :messages="$errors->get('amount')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="due_date" :value="__('Data de Admissão').'*'" />
                <x-text-input id="due_date" name="due_date" type="date" class="mt-1 block w-full" :value="old('due_date', $account->due_date->format('Y-m-d'))" autocomplete="admission_date" />
                <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
            </div>
        </div>
        <div class="grid grid-cols-3 gap-2">
            <div style="display: none">
                <x-input-label for="status" :value="__('Status').'*'" />
                <x-text-input id="status" name="status" type="text" class="mt-1 block w-full" :value="$account->status" />
                {{-- <x-select name="status" id="status">
                    <option value="Pendente" {{ $account->status == 'Pendente' ? 'selected':'' }}>Pendente</option>
                    <option value="Pago" {{ $account->status == 'Pago' ? 'selected':'' }}>Pago</option>
                </x-select>
                <x-input-error :messages="$errors->get('status')" class="mt-2" /> --}}
            </div>
            <div>
                <x-input-label for="associate" :value="__('Associado')" />
                <x-select name="associate_id" id="associate">
                    <option value=""></option>
                    @foreach ($associates as $associate)
                        <option value="{{ $associate->id }}"{{ $account->associate_id == $associate->id ? 'selected':'' }}>{{$associate->name}}</option>
                    @endforeach
                </x-select>
                <x-input-error :messages="$errors->get('associate_id')" class="mt-2" />
            </div>
        </div>     

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'account-updated')
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