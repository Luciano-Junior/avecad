<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contas a Pagar e Contas a Receber') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid justify-items-end">
                <a href="{{route('account.register')}}">
                    <button class="text-sm items-center p-2 flex sm:rounded-lg uppercase bg-green-500 text-white dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-gray-300 gap-2">
                        {{__('Nova Conta')}}
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </a>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-full">
                <table class="w-full table-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
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
                                    Data Vencimento
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
                                <div class="flex items-center">
                                    Status
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Ações</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accounts as $account)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 ">
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$account->description}}
                                </th>
                                <td class="px-6 py-4">
                                    {{$account->category->name}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$account->due_date_format}}
                                </td>
                                <td class="px-6 py-4">
                                    R$ {{$account->amount_format}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$account->type_format}}
                                </td>
                                <td class="px-6 py-4 {{$account->status == "Pago" ? "text-green-500": "text-red-500"}}">
                                    {{$account->status}}
                                </td>
                                <td class="px-6 py-4 text-right flex gap-2">
                                    <x-nav-link-table :active="true" href="#" class="hover:underline" title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                            <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                          </svg>                                          
                                    </x-nav-link-table>
                                    <x-nav-link-table :active="true" :href="route('account.edit', $account->id)" class="hover:underline" title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                            <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                            <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                        </svg>
                                    </x-nav-link-table>
                                    @if ($account->type == "R")
                                        <x-nav-link-table href="#" :active="true" class="hover:underline" title="Receber">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                                <path d="M10.464 8.746c.227-.18.497-.311.786-.394v2.795a2.252 2.252 0 0 1-.786-.393c-.394-.313-.546-.681-.546-1.004 0-.323.152-.691.546-1.004ZM12.75 15.662v-2.824c.347.085.664.228.921.421.427.32.579.686.579.991 0 .305-.152.671-.579.991a2.534 2.534 0 0 1-.921.42Z" />
                                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v.816a3.836 3.836 0 0 0-1.72.756c-.712.566-1.112 1.35-1.112 2.178 0 .829.4 1.612 1.113 2.178.502.4 1.102.647 1.719.756v2.978a2.536 2.536 0 0 1-.921-.421l-.879-.66a.75.75 0 0 0-.9 1.2l.879.66c.533.4 1.169.645 1.821.75V18a.75.75 0 0 0 1.5 0v-.81a4.124 4.124 0 0 0 1.821-.749c.745-.559 1.179-1.344 1.179-2.191 0-.847-.434-1.632-1.179-2.191a4.122 4.122 0 0 0-1.821-.75V8.354c.29.082.559.213.786.393l.415.33a.75.75 0 0 0 .933-1.175l-.415-.33a3.836 3.836 0 0 0-1.719-.755V6Z" clip-rule="evenodd" />
                                            </svg>                                          
                                        </x-nav-link-table>
                                    @else
                                        <x-nav-link-table href="#" :active="true" class="hover:underline" title="Pagar">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" class="size-4">
                                                <path d="M461.72 53.8h-79.06L285.19 22a41.43 41.43 0 0 0-35.31 4.54l-58.73 37.73a5.73 5.73 0 0 0 6.19 9.65l58.73-37.68A29.94 29.94 0 0 1 281.63 33L380 65a5.6 5.6 0 0 0 1.77.28H456v96.31h-42.65a5.74 5.74 0 0 0-5.09 3.1 57.68 57.68 0 0 1-27.93 24.08V163c9.19-3.92 19-10.74 25.26-22.63a5.73 5.73 0 1 0-10.16-5.37c-10.9 20.84-38 21.77-38.15 21.77-36.3 0-46.78-25.34-47.2-26.39a5.74 5.74 0 0 0-5.35-3.68h-53.87a15.31 15.31 0 1 1 0-30.61h64.3a5.74 5.74 0 1 0 0-11.47h-64.3a26.78 26.78 0 1 0 0 53.55h50.28c4.79 8.79 20.13 30.07 56.26 30.07a62 62 0 0 0 11.46-1.59v85a8.47 8.47 0 0 1-8.46 8.46H64.47a8.48 8.48 0 0 1-8.47-8.44V104.55a8.47 8.47 0 0 1 8.46-8.46h146.23a5.74 5.74 0 1 0 0-11.47H64.47a20 20 0 0 0-19.93 19.93v147.12a20 20 0 0 0 19.93 19.93H360.4a20 20 0 0 0 19.93-19.93v-50.75c20.56-6.55 32.07-21.38 36.27-27.87h45.12a5.74 5.74 0 0 0 5.74-5.73V59.54a5.74 5.74 0 0 0-5.74-5.74"/>
                                                <path d="M83.43 208.33v-60.45a30.72 30.72 0 0 0 24.37-24.37h97.93a5.74 5.74 0 0 0 0-11.47H102.61a5.74 5.74 0 0 0-5.74 5.74A19.19 19.19 0 0 1 77.7 137a5.74 5.74 0 0 0-5.7 5.69v70.84a5.73 5.73 0 0 0 5.74 5.73 19.2 19.2 0 0 1 19.17 19.18 5.73 5.73 0 0 0 5.74 5.73h219.61a5.73 5.73 0 0 0 5.74-5.73 19.2 19.2 0 0 1 19.17-19.18 5.73 5.73 0 0 0 5.74-5.73v-25.92a5.74 5.74 0 1 0-11.47 0v20.72a30.74 30.74 0 0 0-24.37 24.37H107.8a30.74 30.74 0 0 0-24.37-24.37"/>
                                                <path d="M204.9 159.24h13.8a5.74 5.74 0 0 0 0-11.47h-4.51v-3.69a5.74 5.74 0 1 0-11.47 0v3.83a18 18 0 0 0 2.18 35.93h7.1a6.57 6.57 0 1 1 0 13.16h-13.78a5.74 5.74 0 1 0 0 11.47h4.5v3.69a5.74 5.74 0 0 0 11.47 0v-3.86a18 18 0 0 0-2.19-35.93h-7.1a6.57 6.57 0 1 1 0-13.13m-59.67 14.82a5.76 5.76 0 0 0-1.68 4 5.3 5.3 0 0 0 .12 1.13 5 5 0 0 0 .33 1.06 5 5 0 0 0 .53 1 5.3 5.3 0 0 0 .7.86 6 6 0 0 0 .87.72 6 6 0 0 0 1 .52 6.5 6.5 0 0 0 1.08.34 6 6 0 0 0 1.12.1 5.77 5.77 0 0 0 4.05-1.68 6 6 0 0 0 .72-.86 8 8 0 0 0 .53-1 8 8 0 0 0 .32-1.06 5.3 5.3 0 0 0 .11-1.13 5.73 5.73 0 0 0-9.79-4Zm125.58 7.24a6.6 6.6 0 0 0 .72.86 5.71 5.71 0 0 0 8.81-.86 5 5 0 0 0 .53-1 5 5 0 0 0 .33-1.06 5.2 5.2 0 0 0 .12-1.11 5.74 5.74 0 1 0-11.47 0 6 6 0 0 0 .11 1.11 6.5 6.5 0 0 0 .33 1.06 7 7 0 0 0 .52 1m144.7 136.34a27.18 27.18 0 0 0-36.66 2.82l-36.27 39.21a5.74 5.74 0 1 0 8.42 7.79l36.27-39.21a15.64 15.64 0 0 1 21.11-1.62 15.57 15.57 0 0 1 2.37 22.05l-63.14 77.22a28.92 28.92 0 0 1-18.3 10.35l-122.22 17.69a40.9 40.9 0 0 0-29.77 20.58l-3.34 6H61.55l58.24-86.07a81.93 81.93 0 0 1 76.89-35.77 130.2 130.2 0 0 1 28.93 6.39 59.6 59.6 0 0 0 19.83 3.48h58.45a16.92 16.92 0 0 1 16.9 16.9 18.26 18.26 0 0 1-18.24 18.24H249a37.57 37.57 0 0 0-24 8.66l-12.58 10.44a5.74 5.74 0 0 0 7.33 8.83l12.57-10.44a26.08 26.08 0 0 1 16.62-6h53.59a29.75 29.75 0 0 0 29.71-29.71 28.41 28.41 0 0 0-28.37-28.37h-58.43a48.1 48.1 0 0 1-16-2.83 141.5 141.5 0 0 0-31.49-7A93.38 93.38 0 0 0 110.29 388l-64.3 95a5.74 5.74 0 0 0 4.75 9h126.62a5.73 5.73 0 0 0 5-3l5-9a29.4 29.4 0 0 1 21.39-14.78L331 447.6a40.38 40.38 0 0 0 25.54-14.44l63.14-77.22a27 27 0 0 0-4.12-38.3Z"/></svg>
                                        </x-nav-link-table>
                                    @endif
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="8">
                                {{ $accounts->links() }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>

