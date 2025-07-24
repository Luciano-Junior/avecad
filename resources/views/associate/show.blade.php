<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Associate Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1">
                @if ($associate->path_image)
                    <div class="max-w-32">
                        <img src="{{ asset('storage/'.$associate->path_image) }}" alt="Foto perfil" width="150" class="mt-2 object-cover rounded-full border">
                    </div>
                @endif
            </div>
            <div class="grid grid-cols-3 gap-2">
                <div class="col-span-1">
                    <x-input-label for="type_associate_id" :value="__('Tipo')" />
                    <x-text-input disabled="true" id="type_associate_id" name="type_associate_id" type="text" value="{{ $associate->type_associate_id }}" class="mt-1 block w-full" />
                </div>
                <div class="col-span-1">
                    <x-input-label for="category_associate_id" :value="__('Categoria')" />
                    <x-text-input disabled="true" id="category_associate_id" name="category_associate_id" type="text" value="{{ $associate->category_associate_id }}" class="mt-1 block w-full" />
                </div>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <div class="col-span-2">
                    <x-input-label for="associate_name" :value="__('Name')" />
                    <x-text-input disabled="true" id="associate_name" name="associate_name" type="text" value="{{ $associate->name }}" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="associate_name" :value="__('Surname')" />
                    <x-text-input disabled="true" id="associate_surname" name="associate_surname" type="text" value="{{ $associate->surname }}" class="mt-1 block w-full" />
                </div>
            </div>
            <div class="grid grid-cols-4 gap-2">
                <div>
                    <x-input-label for="occupation" :value="__('Profissão')" />
                    <x-text-input disabled="true" id="occupation" name="occupation" type="text" value="{{ $associate->occupation }}" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="vest_number" :value="__('Nº Colete')" />
                    <x-text-input disabled="true" id="vest_number" name="vest_number" type="text" value="{{ $associate->vest_number }}" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="birth_date" :value="__('Data de Nascimento')" />
                    <x-text-input disabled="true" id="birth_date" name="birth_date" type="text" value="{{ $associate->birth_date->format('d/m/Y') }}" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="age" :value="__('Idade')" />
                    <x-text-input disabled="true" id="age" name="age" type="text" value="{{ \Carbon\Carbon::parse($associate->birth_date)->age }}" class="mt-1 block w-full" />
                </div>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <div class="col-span-2">
                    <x-input-label for="associate_name" :value="__('Address')" />
                    <x-text-input disabled="true" id="associate_address" name="associate_address" type="text" value="{{ $associate->address }}" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="associate_name" :value="__('Neighborhood')" />
                    <x-text-input disabled="true" id="associate_neighborhood" name="associate_neighborhood" type="text" value="{{ $associate->neighborhood }}" class="mt-1 block w-full" />
                </div>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <div>
                    <x-input-label for="associate_rg" :value="__('RG')" />
                    <x-text-input disabled="true" id="associate_identity" name="associate_identity" type="text" value="{{ $associate->identity }}" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="associate_cpf" :value="__('CPF')" />
                    <x-text-input disabled="true" id="associate_cpf" name="associate_cpf" type="text" value="{{ $associate->cpf }}" class="mt-1 block w-full" x-model="cpf" x-data="cpfMask('{{ old('associate_cpf',$associate->cpf) }}')" 
                        x-on:input="formatCPF()" 
                        x-init="formatCPF()" />
                </div>
                <div>
                    <x-input-label for="associate_admission_date" :value="__('Data de Admissão')" />
                    <x-text-input disabled="true" id="associate_admission_date" name="associate_admission_date" type="date" class="mt-1 block w-full" value="{{ $associate->admission_date->format('Y-m-d') }}" autocomplete="admission_date" />
                    <x-input-error :messages="$errors->get('associate_admission_date')" class="mt-2" />
                </div>
            </div>
            <div class="grid grid-cols-3 gap-2">
                <div>
                    <x-input-label for="associate_contact" :value="__('Contact')" />
                    <x-text-input disabled="true" id="associate_contact" name="associate_contact" type="text" value="{{ $associate->contact_formatado }}" class="mt-1 block w-full" x-model="phone" 
                        x-data="phoneMask('{{ $associate->contact_formatado }}')"
                        x-on:input="formatPhone()" />
                </div>
                <div>
                    <x-input-label for="associate_family_contact" :value="__('Family Contact')" />
                    <x-text-input disabled="true" id="associate_family_contact" name="associate_family_contact" type="text" value="{{ $associate->family_contact_formatado }}" class="mt-1 block w-full" x-model="phone" 
                        x-data="phoneMask('{{ $associate->family_contact_formatado }}')"
                        x-on:input="formatPhone()" />
                </div>
                <div>
                    <x-input-label for="associate_active" :value="__('Status')" />
                    <x-text-input disabled="true" id="associate_active" name="associate_active" type="text" class="mt-1 block w-full" value="{{ $associate->active ? 'Ativo':'Inativo' }}" autocomplete="admission_date" />
                    <x-input-error :messages="$errors->get('associate_admission_date')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-24">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Mensalidades
                </h2>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{__('Description')}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    {{__('Category')}}
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    Data de Vencimento
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
                        @foreach ($associate->mounthlyFees as $mounthlyFee)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 ">
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $mounthlyFee->description }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $mounthlyFee->category->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{$mounthlyFee->due_date_format}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$mounthlyFee->type_format}}
                                </td>
                                <td class="px-6 py-4" {{$mounthlyFee->status == "Pago" ? "text-green-500": "text-blue-500"}}>
                                    @if ($mounthlyFee->status !== "Pago" && $mounthlyFee->due_date < \Carbon\Carbon::now())
                                        <span class="text-white bg-red-500 p-2 rounded-sm">Atrasado</span>
                                    @else
                                        <span class="{{$mounthlyFee->status == "Pago" ? "text-white bg-blue-400 p-2 rounded-sm": ""}}">{{$mounthlyFee->status}}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right flex gap-2">
                                    @if ($mounthlyFee->type == "R")
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
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

