<div>
    <div class="grid lg:grid-cols-3 lg:gap-4 sm:grid-cols-2 md:gap-6">
        <!-- Metric Item Start -->
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6 mb-2">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-8" width="800" height="800" viewBox="0 0 24 24" fill="none"><path d="M3.172 20.828C4.343 22 6.229 22 10 22h4c3.771 0 5.657 0 6.828-1.172S22 17.771 22 14c0-1.17 0-2.158-.035-3m-1.137-3.828C19.657 6 17.771 6 14 6h-4C6.229 6 4.343 6 3.172 7.172S2 10.229 2 14c0 1.17 0 2.158.035 3M12 2c1.886 0 2.828 0 3.414.586S16 4.114 16 6M8.586 2.586C8 3.172 8 4.114 8 6" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/><path d="M12 17.333c1.105 0 2-.746 2-1.666S13.105 14 12 14s-2-.746-2-1.667c0-.92.895-1.666 2-1.666m0 6.666c-1.105 0-2-.746-2-1.666m2 1.666V18m0-8v.667m0 0c1.105 0 2 .746 2 1.666" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/></svg>
            </div>

            <div class="mt-5 flex items-end justify-between">
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $cashboxAmount->name }}</span>
                    <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90 {{ $cashboxAmount->balance < 0 ? 'text-red-800':'text-gray-800' }}">
                    R$ {{ str_replace(".",",",$cashboxAmount->balance) }}
                    </h4>
                </div>
            </div>
        </div>
        <!-- Metric Item End -->
        <!-- Metric Item Start -->
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6 mb-2">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-8" width="800" height="800" viewBox="0 0 24 24" fill="none"><path d="M3.172 20.828C4.343 22 6.229 22 10 22h4c3.771 0 5.657 0 6.828-1.172S22 17.771 22 14c0-1.17 0-2.158-.035-3m-1.137-3.828C19.657 6 17.771 6 14 6h-4C6.229 6 4.343 6 3.172 7.172S2 10.229 2 14c0 1.17 0 2.158.035 3M12 2c1.886 0 2.828 0 3.414.586S16 4.114 16 6M8.586 2.586C8 3.172 8 4.114 8 6" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/><path d="M12 17.333c1.105 0 2-.746 2-1.666S13.105 14 12 14s-2-.746-2-1.667c0-.92.895-1.666 2-1.666m0 6.666c-1.105 0-2-.746-2-1.666m2 1.666V18m0-8v.667m0 0c1.105 0 2 .746 2 1.666" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/></svg>
            </div>

            <div class="mt-5 flex items-end justify-between">
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        Total do período filtrado
                        <br>{{$start_date ? \Carbon\Carbon::parse($start_date)->format('d/m/Y'):''}} - {{ $end_date ? \Carbon\Carbon::parse($end_date)->format('d/m/Y'):'' }}
                    </span>
                    <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90 {{ $totalAmount < 0 ? 'text-red-800':'text-gray-800' }}">
                    R$ {{ str_replace(".",",",$totalAmount) }}
                    </h4>
                </div>
            </div>
        </div>
        <!-- Metric Item End -->
    </div>
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center justify-between">
        <div>
            <button
                wire:click="toggleFilters"
                type="button"
                class="bg-blue-500 text-sm text-white px-4 py-2 rounded-lg flex items-center gap-2"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 13.414V19a1 1 0 01-1.447.894l-4-2A1 1 0 019 17v-3.586L3.293 6.707A1 1 0 013 6V4z" />
                </svg>
            </button>
        </div>
        <div class="relative">
            <span class="absolute -translate-y-1/2 pointer-events-none top-1/2 left-4">
                <svg class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.04199 9.37381C3.04199 5.87712 5.87735 3.04218 9.37533 3.04218C12.8733 3.04218 15.7087 5.87712 15.7087 9.37381C15.7087 12.8705 12.8733 15.7055 9.37533 15.7055C5.87735 15.7055 3.04199 12.8705 3.04199 9.37381ZM9.37533 1.54218C5.04926 1.54218 1.54199 5.04835 1.54199 9.37381C1.54199 13.6993 5.04926 17.2055 9.37533 17.2055C11.2676 17.2055 13.0032 16.5346 14.3572 15.4178L17.1773 18.2381C17.4702 18.531 17.945 18.5311 18.2379 18.2382C18.5308 17.9453 18.5309 17.4704 18.238 17.1775L15.4182 14.3575C16.5367 13.0035 17.2087 11.2671 17.2087 9.37381C17.2087 5.04835 13.7014 1.54218 9.37533 1.54218Z" fill=""></path>
                </svg>
            </span>
            <input type="text" placeholder="Buscar..." wire:model.live.debounce.300ms="search" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-10 w-full rounded-lg border border-gray-300 py-2.5 pr-4 pl-[42px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[300px] dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
        </div>
        <div class="flex lg:flex-col gap-3 sm:flex-row sm:items-center lg:justify-between">
            <a href="{{route('transaction.register')}}">
                <button class="text-sm items-center p-2 flex sm:rounded-lg uppercase bg-green-500 text-white dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-gray-300 gap-2">
                    {{__('Novo')}}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
                    </svg>
                </button>
            </a>
            <button class="text-sm items-center p-2 flex sm:rounded-lg uppercase bg-blue-500 text-white dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-gray-300 gap-2" wire:click.prevent="export()">
                {{__('Exportar')}}
                <svg class="size-6" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" stroke="#000"><g stroke-width="0"/><g stroke-linecap="round" stroke-linejoin="round"/><path d="M161.28 328.32a61 61 0 0 0-40.32-8.32H85.333v128h28.373v-48.853h12.16a55.04 55.04 0 0 0 35.84-8.747 38.61 38.61 0 0 0 13.44-30.933 37.33 37.33 0 0 0-13.866-31.147m-22.827 46.72a32.85 32.85 0 0 1-17.067 2.56h-8.32v-36.266h8.32a30.3 30.3 0 0 1 17.494 3.413 17.49 17.49 0 0 1 7.466 15.36 15.15 15.15 0 0 1-7.893 14.933M236.16 320h-35.414v128h33.92a90.24 90.24 0 0 0 50.134-9.6 60.16 60.16 0 0 0 23.893-54.4 64 64 0 0 0-17.707-48.853A73.4 73.4 0 0 0 236.16 320m28.16 98.987a51.2 51.2 0 0 1-29.227 6.4h-5.547v-82.773h5.12c17.92 0 24.96 1.706 32 8.106a43.95 43.95 0 0 1 12.16 33.28 41.39 41.39 0 0 1-14.506 34.987M339.84 448h28.8v-53.546h58.026V371.84H368.64v-29.226h58.026V320H339.84zM320 42.667H85.333v234.667H128v-192h174.293L384 167.04v110.294h42.666v-128z" fill="#fff" fill-rule="evenodd" stroke="none"/></svg>
            </button>
        </div>
    </div>

    @if ($showFilters)
        <div class="mt-4 mb-4 grid grid-cols-4 sm:grid-cols-2 md:grid-cols-4 gap-4 transition ease-out duration-300">
            <div>
                <label class="block text-sm text-gray-700 dark:text-gray-300" for="start_date">Data Início</label>
                <input type="date" id="start_date" wire:model.live="start_date" class="mt-1 block w-full rounded border-gray-300 shadow-sm dark:bg-gray-800 dark:border-gray-600 focus:outline-none focus:ring">
            </div>
            <!-- Filtro: Data Final -->
            <div>
                <label class="block text-sm text-gray-700 dark:text-gray-300" for="end_date">Data Fim</label>
                <input type="date" id="end_date" wire:model.live="end_date" class="mt-1 block w-full rounded border-gray-300 shadow-sm dark:bg-gray-800 dark:border-gray-600 focus:outline-none focus:ring">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tipo</label>
                <select wire:model.live="filterType" class="mt-1 block w-full rounded border-gray-300 shadow-sm dark:bg-gray-800 dark:border-gray-600">
                    <option value="">Todos</option>
                    <option value="E">Entrada</option>
                    <option value="S">Saída</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Categoria</label>
                <select wire:model.live="filterCategory" class="mt-1 block w-full rounded border-gray-300 shadow-sm dark:bg-gray-800 dark:border-gray-600">
                    <option value="">Todos</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category ->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Adicione mais filtros aqui -->
        </div>
    @endif

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-full">
        <table class="w-full table-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    {{-- Coluna checkbox --}}
                    <th scope="col" class="px-4 py-3">
                        <input type="checkbox" 
                            x-data 
                            x-on:click="$dispatch('toggle-all')" 
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                        />
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{__('Descrição')}}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{__('Categoria')}}
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Data
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Valor
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Tipo
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Ações</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr wire:key="transaction-{{ $transaction->id }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 "
                        x-data
                        x-on:toggle-all.window="
                            $el.querySelector('input[type=checkbox]').click()
                        "
                        >
                        {{-- Checkbox individual --}}
                        <td class="px-4 py-4">
                            <input type="checkbox" 
                                wire:model.live="selectedTransactions" 
                                value="{{ $transaction->id }}" 
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            />
                        </td>
                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$transaction->description}}
                        </th>
                        <td class="px-6 py-4">
                            {{$transaction->category->name}}
                        </td>
                        <td class="px-6 py-4">
                            {{$transaction->transaction_date_format}}
                        </td>
                        <td class="px-6 py-4">
                            R$ {{$transaction->amount_format}}
                        </td>
                        <td class="px-6 py-4">
                            {{$transaction->type_format}}
                        </td>
                        <td class="px-6 py-4 text-right flex gap-2">
                            <button class="hover:underline" title="Visualizar"
                                wire:click.prevent="viewTransaction({{ $transaction }})"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                    </svg>                                          
                            </button>
                            @if (!$transaction->account_id)
                                <x-nav-link-table :active="true" :href="route('transaction.edit', $transaction->id)" class="hover:underline" title="Editar">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                        <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                    </svg>
                                </x-nav-link-table>
                            @endif
                            <x-nav-link-table href="#" :active="true" class="hover:underline hidden" title="Estornar">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                    <path d="M10.464 8.746c.227-.18.497-.311.786-.394v2.795a2.252 2.252 0 0 1-.786-.393c-.394-.313-.546-.681-.546-1.004 0-.323.152-.691.546-1.004ZM12.75 15.662v-2.824c.347.085.664.228.921.421.427.32.579.686.579.991 0 .305-.152.671-.579.991a2.534 2.534 0 0 1-.921.42Z" />
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v.816a3.836 3.836 0 0 0-1.72.756c-.712.566-1.112 1.35-1.112 2.178 0 .829.4 1.612 1.113 2.178.502.4 1.102.647 1.719.756v2.978a2.536 2.536 0 0 1-.921-.421l-.879-.66a.75.75 0 0 0-.9 1.2l.879.66c.533.4 1.169.645 1.821.75V18a.75.75 0 0 0 1.5 0v-.81a4.124 4.124 0 0 0 1.821-.749c.745-.559 1.179-1.344 1.179-2.191 0-.847-.434-1.632-1.179-2.191a4.122 4.122 0 0 0-1.821-.75V8.354c.29.082.559.213.786.393l.415.33a.75.75 0 0 0 .933-1.175l-.415-.33a3.836 3.836 0 0 0-1.719-.755V6Z" clip-rule="evenodd" />
                                </svg>                                          
                            </x-nav-link-table>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="8">
                        {{ $transactions->links() }}
                    </th>
                </tr>
            </tfoot>
        </table>
        <div class="flex flex-row items-center gap-1 pl-2 py-2">
            Por página:
            <select wire:model.live="perPage" class="h-9 shadow-theme-xs text-sm rounded-lg">
                @foreach ($optionsPerPage as $option)
                    <option value="{{ $option }}">{{$option}}</option>
                @endforeach
            </select>
        </div>
    </div>
    {{-- MODAL VISUALIZAR TRANSAÇÃo --}}
    <x-modal name="view-transaction">
        <div class="p-6">
            <div class="flex items-center justify-between space-x-4">
                <h1 class="text-xl font-medium text-gray-800 ">Movimentação Financeira</h1>

                <button @click="$dispatch('close-modal','view-transaction')" class="text-gray-600 focus:outline-none hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-3 gap-2 mt-4">
                <div class="col-span-2">
                    <label for="user name" class="block text-md text-gray-700 capitalize dark:text-gray-200">Descrição:</label>
                    <input disabled value="{{ $selectedTransaction->description??'' }}" type="text" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                </div>
                <div>
                    <label for="user name" class="block text-md text-gray-700 capitalize dark:text-gray-200">Categoria:</label>
                    <input disabled value="{{ $selectedTransaction->category->name??'' }}" type="text" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                </div>
                <div>
                    <label for="user name" class="block text-md text-gray-700 dark:text-gray-200">Data da Transação:</label>
                    <input disabled value="{{ $selectedTransaction->transaction_date_format??'' }}" type="text" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                </div>
                <div>
                    <label for="user name" class="block text-md text-gray-700 capitalize dark:text-gray-200">Valor:</label>
                    <input disabled value="{{ $selectedTransaction->amount_format??'' }}" type="text" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                </div>
                <div>
                    <label for="user name" class="block text-md text-gray-700 capitalize dark:text-gray-200">Tipo:</label>
                    <input disabled value="{{ $selectedTransaction->type_format??'' }}" type="text" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                </div>
            </div>

        </div>
    </x-modal>
</div>
