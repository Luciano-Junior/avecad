<div>
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center justify-between">
        <div class="relative">
            <span class="absolute -translate-y-1/2 pointer-events-none top-1/2 left-4">
                <svg class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.04199 9.37381C3.04199 5.87712 5.87735 3.04218 9.37533 3.04218C12.8733 3.04218 15.7087 5.87712 15.7087 9.37381C15.7087 12.8705 12.8733 15.7055 9.37533 15.7055C5.87735 15.7055 3.04199 12.8705 3.04199 9.37381ZM9.37533 1.54218C5.04926 1.54218 1.54199 5.04835 1.54199 9.37381C1.54199 13.6993 5.04926 17.2055 9.37533 17.2055C11.2676 17.2055 13.0032 16.5346 14.3572 15.4178L17.1773 18.2381C17.4702 18.531 17.945 18.5311 18.2379 18.2382C18.5308 17.9453 18.5309 17.4704 18.238 17.1775L15.4182 14.3575C16.5367 13.0035 17.2087 11.2671 17.2087 9.37381C17.2087 5.04835 13.7014 1.54218 9.37533 1.54218Z" fill=""></path>
                </svg>
            </span>
            <input type="text" placeholder="Buscar..." wire:model.live.debounce.300ms="search" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-10 w-full rounded-lg border border-gray-300 py-2.5 pr-4 pl-[42px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[300px] dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-full pt-2">
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
                        {{__('Chave')}}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            {{__('Valor')}}
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Ações</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($configurations as $configuration)
                    <tr wire:key="configuration-{{ $configuration->id }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 "
                        x-data
                        x-on:toggle-all.window="
                            $el.querySelector('input[type=checkbox]').click()
                        "
                        >
                        {{-- Checkbox individual --}}
                        <td class="px-4 py-4">
                            <input type="checkbox" 
                                wire:model.live="selectedConfigurations" 
                                value="{{ $configuration->id }}" 
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            />
                        </td>
                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$configuration->key}}
                        </th>
                        <td class="px-6 py-4">
                            {{$configuration->value}}
                        </td>
                        <td class="px-6 py-4 text-right flex gap-2">
                            
                            <button 
                                class="hover:underline" 
                                title="Editar"
                                wire:click.prevent="viewEditConfiguration({{ $configuration }})"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                    <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                    <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                </svg>                                          
                            </button>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="8">
                        {{ $configurations->links() }}
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
    </div>
    <x-modal name="edit-configuration">
        @include('configuration.partials.update-configuration')
    </x-modal>
</div>
