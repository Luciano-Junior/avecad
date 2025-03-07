<section>
    <header>
        <h2 class="ml-2 text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Cadastrar novo associado') }}
        </h2>

    </header>

    <form method="post" action="{{ route('associate.create') }}" class="mt-6 space-y-6 px-3">
        @csrf

        <div class="grid grid-cols-3 gap-2">
            <div class="col-span-2">
                <x-input-label for="associate_name" :value="__('Name').'*'" />
                <x-text-input id="associate_name" name="associate_name" type="text" :value="old('associate_name')" class="mt-1 block w-full" autocomplete="name" />
                <x-input-error :messages="$errors->get('associate_name')" class="mt-2" />
            </div>
    
            <div>
                <x-input-label for="associate_surname" :value="__('Surname').'*'" />
                <x-text-input id="associate_surname" name="associate_surname" type="text" :value="old('associate_surname')" class="mt-1 block w-full" autocomplete="surname" />
                <x-input-error :messages="$errors->get('associate_surname')" class="mt-2" />
            </div>
        </div>

        <div class="grid grid-cols-3 gap-2">
            <div class="col-span-2">
                <x-input-label for="associate_address" :value="__('Address').'*'" />
                <x-text-input id="associate_address" name="associate_address" type="text" :value="old('associate_address')" class="mt-1 block w-full" autocomplete="address" />
                <x-input-error :messages="$errors->get('associate_address')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="associate_neighborhood" :value="__('Neighborhood').'*'" />
                <x-text-input id="associate_neighborhood" name="associate_neighborhood" type="text" :value="old('associate_neighborhood')" class="mt-1 block w-full" autocomplete="neighborhood" />
                <x-input-error :messages="$errors->get('associate_neighborhood')" class="mt-2" />
            </div>
        </div>
        <div class="grid grid-cols-3 gap-2">
            <div>
                <x-input-label for="associate_identity" :value="__('RG').'*'" />
                <x-text-input id="associate_identity" name="associate_identity" type="text" :value="old('associate_identity')" class="mt-1 block w-full" autocomplete="identity" maxlength="15"/>
                <x-input-error :messages="$errors->get('associate_identity')" class="mt-2" />
            </div>

            <div x-data="cpfMask">
                <x-input-label for="associate_cpf" :value="__('CPF').'*'" />
                <x-text-input id="associate_cpf" name="associate_cpf" type="text" class="mt-1 block w-full" autocomplete="cpf" x-model="cpf" :value="old('associate_cpf')"
                x-data="cpfMask('{{ old('associate_cpf') }}')" 
                x-on:input="formatCPF()" 
                maxlength="14"
                placeholder="000.000.000-00"/>
                <x-input-error :messages="$errors->get('associate_cpf')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="associate_admission_date" :value="__('Data de Admissão').'*'" />
                <x-text-input id="associate_admission_date" name="associate_admission_date" type="date" class="mt-1 block w-full" :value="old('associate_admission_date')" autocomplete="admission_date" />
                <x-input-error :messages="$errors->get('associate_admission_date')" class="mt-2" />
            </div>
        </div>

        <div class="grid grid-cols-3 gap-2">
            <div x-data="phoneMask">
                <x-input-label for="associate_contact" :value="__('Contact').'*'" />
                <x-text-input id="associate_contact" name="associate_contact" :value="old('associate_contact')" type="text" class="mt-1 block w-full" autocomplete="contact" x-model="phone" 
                x-data="phoneMask('{{ old('associate_contact') }}')"
                x-on:input="formatPhone()" 
                maxlength="15"
                placeholder="(00) 00000-0000"/>
                <x-input-error :messages="$errors->get('associate_contact')" class="mt-2" />
            </div>

            <div x-data="phoneMask">
                <x-input-label for="associate_family_contact" :value="__('Family Contact').'*'" />
                <x-text-input id="associate_family_contact" name="associate_family_contact" type="text" :value="old('associate_family_contact')" class="mt-1 block w-full" autocomplete="phone" x-model="phone"
                x-data="phoneMask('{{ old('associate_family_contact') }}')"
                x-on:input="formatPhone()" 
                maxlength="15"
                placeholder="(00) 00000-0000"/>
                <x-input-error :messages="$errors->get('associate_family_contact')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'associate-created')
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