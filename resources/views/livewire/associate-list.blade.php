<div>
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center justify-between">
        <div>
            <button
                wire:click="toggleFilters"
                type="button"
                class="bg-blue-500 text-sm text-white px-4 py-2 rounded-lg flex items-center gap-2"
                title="Filtros"
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
        <div class="flex lg:flex-row gap-3 sm:flex-row sm:items-center lg:justify-between">
            <a href="{{route('associate.register')}}">
                <button class="p-2 flex text-sm items-center sm:rounded-lg uppercase bg-green-500 text-white dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-gray-300 gap-2">
                    {{__('New')}}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
                    </svg>
                </button>
            </a>
            {{-- <button class="text-sm items-center p-2 flex sm:rounded-lg uppercase bg-blue-500 text-white dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-gray-300 gap-2" wire:click.prevent="export()">
                {{__('Exportar')}}
                <svg class="size-6" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" stroke="#000"><g stroke-width="0"/><g stroke-linecap="round" stroke-linejoin="round"/><path d="M161.28 328.32a61 61 0 0 0-40.32-8.32H85.333v128h28.373v-48.853h12.16a55.04 55.04 0 0 0 35.84-8.747 38.61 38.61 0 0 0 13.44-30.933 37.33 37.33 0 0 0-13.866-31.147m-22.827 46.72a32.85 32.85 0 0 1-17.067 2.56h-8.32v-36.266h8.32a30.3 30.3 0 0 1 17.494 3.413 17.49 17.49 0 0 1 7.466 15.36 15.15 15.15 0 0 1-7.893 14.933M236.16 320h-35.414v128h33.92a90.24 90.24 0 0 0 50.134-9.6 60.16 60.16 0 0 0 23.893-54.4 64 64 0 0 0-17.707-48.853A73.4 73.4 0 0 0 236.16 320m28.16 98.987a51.2 51.2 0 0 1-29.227 6.4h-5.547v-82.773h5.12c17.92 0 24.96 1.706 32 8.106a43.95 43.95 0 0 1 12.16 33.28 41.39 41.39 0 0 1-14.506 34.987M339.84 448h28.8v-53.546h58.026V371.84H368.64v-29.226h58.026V320H339.84zM320 42.667H85.333v234.667H128v-192h174.293L384 167.04v110.294h42.666v-128z" fill="#fff" fill-rule="evenodd" stroke="none"/></svg>
            </button> --}}
            <!-- Grupo de botões Exportar com Dropdown -->
            <div x-data="{ open: false }" class="relative flex items-center">
                <!-- Botão Exportar principal -->
                <button
                    class="text-sm items-center p-2 flex rounded-lg rounded-r-none uppercase bg-blue-500 text-white dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-gray-300 gap-2 w-auto"
                    wire:click.prevent="export()"
                >
                    {{ __('Exportar') }}
                    <svg class="size-6" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" stroke="#000"><g stroke-width="0"/><g stroke-linecap="round" stroke-linejoin="round"/><path d="M161.28 328.32a61 61 0 0 0-40.32-8.32H85.333v128h28.373v-48.853h12.16a55.04 55.04 0 0 0 35.84-8.747 38.61 38.61 0 0 0 13.44-30.933 37.33 37.33 0 0 0-13.866-31.147m-22.827 46.72a32.85 32.85 0 0 1-17.067 2.56h-8.32v-36.266h8.32a30.3 30.3 0 0 1 17.494 3.413 17.49 17.49 0 0 1 7.466 15.36 15.15 15.15 0 0 1-7.893 14.933M236.16 320h-35.414v128h33.92a90.24 90.24 0 0 0 50.134-9.6 60.16 60.16 0 0 0 23.893-54.4 64 64 0 0 0-17.707-48.853A73.4 73.4 0 0 0 236.16 320m28.16 98.987a51.2 51.2 0 0 1-29.227 6.4h-5.547v-82.773h5.12c17.92 0 24.96 1.706 32 8.106a43.95 43.95 0 0 1 12.16 33.28 41.39 41.39 0 0 1-14.506 34.987M339.84 448h28.8v-53.546h58.026V371.84H368.64v-29.226h58.026V320H339.84zM320 42.667H85.333v234.667H128v-192h174.293L384 167.04v110.294h42.666v-128z" fill="#fff" fill-rule="evenodd" stroke="none"/></svg>
                </button>
                <!-- Botão seta para abrir dropdown -->
                <button
                    @click="open = !open"
                    class="p-2 bg-blue-500 text-white sm:rounded-r-lg flex items-center hover:bg-blue-600 focus:outline-none"
                    aria-haspopup="true"
                    :aria-expanded="open"
                    title="Mais opções de exportação"
                >
                    <svg class="size-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <!-- Dropdown -->
                <div
                    x-show="open"
                    @click.away="open = false"
                    x-transition
                    class="absolute right-0 mt-15 w-44 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
                >
                    <div class="py-1">
                        <button
                            wire:click.prevent="exportarInadimplentes"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        >
                            Exportar Inadimplentes
                        </button>
                        <button
                            wire:click.prevent="exportarAdimplentes"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        >
                            Exportar Adimplentes
                        </button>
                        <!-- Adicione mais opções aqui se necessário -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($showFilters)
        <div class="mt-4 mb-4 grid grid-cols-4 sm:grid-cols-2 md:grid-cols-4 gap-4 transition ease-out duration-300">
            <div>
                <label class="block text-sm text-gray-700 dark:text-gray-300" for="start_date">Data Início Admissão</label>
                <input type="date" id="start_date" wire:model.live="start_date" class="mt-1 block w-full rounded border-gray-300 shadow-sm dark:bg-gray-800 dark:border-gray-600 focus:outline-none focus:ring">
            </div>
            <!-- Filtro: Data Final -->
            <div>
                <label class="block text-sm text-gray-700 dark:text-gray-300" for="end_date">Data Fim Admissão</label>
                <input type="date" id="end_date" wire:model.live="end_date" class="mt-1 block w-full rounded border-gray-300 shadow-sm dark:bg-gray-800 dark:border-gray-600 focus:outline-none focus:ring">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
                <select wire:model.live="filterStatus" class="mt-1 block w-full rounded border-gray-300 shadow-sm dark:bg-gray-800 dark:border-gray-600">
                    <option value="">Todos</option>
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Categoria</label>
                <select wire:model.live="filterCategory" class="mt-1 block w-full rounded border-gray-300 shadow-sm dark:bg-gray-800 dark:border-gray-600">
                    <option value="">Todos</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Categoria</label>
                <select wire:model.live="filterType" class="mt-1 block w-full rounded border-gray-300 shadow-sm dark:bg-gray-800 dark:border-gray-600">
                    <option value="">Todos</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Adicione mais filtros aqui -->
        </div>
    @endif
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg pt-2">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
                        {{__('Name')}}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{__('Surname')}}
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Data de Nascimento
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Categoria
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Tipo
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Contato
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Status
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($associates as $associate)
                    <tr wire:key="associate-{{ $associate->id }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 "
                        x-data
                        x-on:toggle-all.window="
                            $el.querySelector('input[type=checkbox]').click()
                        "
                        >
                        {{-- Checkbox individual --}}
                        <td class="px-4 py-4">
                            <input type="checkbox" 
                                wire:model.live="selectedAssociates" 
                                value="{{ $associate->id }}" 
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            />
                        </td>
                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$associate->name}}
                        </th>
                        <td class="px-6 py-4">
                            {{$associate->surname}}
                        </td>
                        <td class="px-6 py-4">
                            {{$associate->data_nascimento}}
                        </td>
                        <td class="px-6 py-4">
                            {{$associate->category->name??''}}
                        </td>
                        <td class="px-6 py-4">
                            {{$associate->typeAssociate->name??''}}
                        </td>
                        <td class="px-6 py-4">
                            {{$associate->contact_formatado}}
                        </td>
                        <td class="px-6 py-4 {{$associate->active ? "text-green-500": "text-red-500"}}">
                            {{$associate->active ? "Ativo": "Inativo"}}
                        </td>
                        <td class="px-6 py-4 text-right flex gap-2">
                            <x-nav-link-table :active="true" :href="route('associate.show', $associate)" class="hover:underline" title="Visualizar">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                    </svg>                                          
                            </x-nav-link-table>
                            <x-nav-link-table :active="true" :href="route('associate.edit', $associate->id)" class="hover:underline" title="Editar">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                    <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                    <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                </svg>
                            </x-nav-link-table>
                            @if ($associate->active)
                                <button 
                                    class="hover:underline" 
                                    title="Gerar mensalidades"
                                    wire:click.prevent="viewGenerateMonthlyFees({{ $associate }})"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                        <path d="M10.464 8.746c.227-.18.497-.311.786-.394v2.795a2.252 2.252 0 0 1-.786-.393c-.394-.313-.546-.681-.546-1.004 0-.323.152-.691.546-1.004ZM12.75 15.662v-2.824c.347.085.664.228.921.421.427.32.579.686.579.991 0 .305-.152.671-.579.991a2.534 2.534 0 0 1-.921.42Z" />
                                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v.816a3.836 3.836 0 0 0-1.72.756c-.712.566-1.112 1.35-1.112 2.178 0 .829.4 1.612 1.113 2.178.502.4 1.102.647 1.719.756v2.978a2.536 2.536 0 0 1-.921-.421l-.879-.66a.75.75 0 0 0-.9 1.2l.879.66c.533.4 1.169.645 1.821.75V18a.75.75 0 0 0 1.5 0v-.81a4.124 4.124 0 0 0 1.821-.749c.745-.559 1.179-1.344 1.179-2.191 0-.847-.434-1.632-1.179-2.191a4.122 4.122 0 0 0-1.821-.75V8.354c.29.082.559.213.786.393l.415.33a.75.75 0 0 0 .933-1.175l-.415-.33a3.836 3.836 0 0 0-1.719-.755V6Z" clip-rule="evenodd" />
                                    </svg>                                          
                                </button>
                            @endif
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="8" class="justify-center">
                        {{ $associates->links() }}
                    </th>
                </tr>
            </tfoot>
        </table>
        <div class="flex flex-row items-center gap-1 pl-2 pt-2">
            Por página:
            <select wire:model.live="perPage" class="h-9 shadow-theme-xs text-sm rounded-lg">
                @foreach ($optionsPerPage as $option)
                    <option value="{{ $option }}">{{$option}}</option>
                @endforeach
            </select>
        </div>
        {{-- Recurso adicional: quantidade selecionada + botões --}}
        <div class="m-4 px-6">
            @if(count($selectedAssociates) > 0)
                <span class="text-sm text-gray-600">
                    {{ count($selectedAssociates) }} associado(s) selecionado(s)
                </span>
                <button wire:click="exportarSelecionados" class="ml-4 px-3 py-1 bg-blue-600 text-white rounded" title="exportar">
                    Exportar Selecionados
                </button>
            @endif
        </div>
    </div>
    {{-- MODAL GERAR MENSALIDADES --}}
    <x-modal name="generate-monthlyfees">
        @include('associate.partials.generate-monthlyfees-form')
    </x-modal>
    <x-modal name="aniversariantes-mes" :show="$showModalAniversariantes">
        @include('associate.partials.birthday-peoples')
    </x-modal>
    
</div>
