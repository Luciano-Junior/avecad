<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Associate Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
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
                                {{__('Name')}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    {{__('Surname')}}
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    Data de Admissão
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    Contato
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    Contato do Familiar
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    Status
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 ">
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Nome
                                </th>
                                <td class="px-6 py-4">
                                    Apelido
                                </td>
                                <td class="px-6 py-4">
                                    Data
                                </td>
                                <td class="px-6 py-4">
                                    COntato
                                </td>
                                <td class="px-6 py-4">
                                    Contato 2
                                </td>
                                <td class="px-6 py-4 {{$associate->active ? "text-green-500": "text-red-500"}}">
                                    PAGO
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

