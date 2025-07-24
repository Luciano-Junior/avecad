<section>
    <header>
        <h2 class="ml-2 text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Atualizar informações do associado') }}
        </h2>

    </header>

    <form method="post" action="{{ route('associate.update', $associate->id) }}" enctype="multipart/form-data" class="mt-6 space-y-6 px-3" x-data="{ previewUpload: null }">
        @csrf
        @method('put')

        <div class="grid grid-cols-1">

            <!-- Upload convencional -->
            <div class="mb-4">
                <label class="block text-md">Escolher uma imagem de perfil</label>
                <input type="file" name="path_image" accept="image/*" class="mt-2 block w-full"
                    @change="previewUpload = URL.createObjectURL($event.target.files[0])">
                <template x-if="previewUpload">
                    <img :src="previewUpload" width="150" class="w-32 h-32 mt-2 object-cover rounded-full border" />
                </template>
            </div>
            @if ($associate->path_image)
                <div class="max-w-32">
                    <img src="{{ asset('storage/'.$associate->path_image) }}" alt="Foto perfil" width="150" class="mt-2 object-cover rounded-full border">
                </div>
            @endif

        </div>
        <div class="grid grid-cols-4 gap-2">
            <div>
                <x-input-label for="type_associate_id" :value="__('Tipo').'*'" />
                <x-select name="type_associate_id" id="type_associate_id">
                    <option value="">Selecione um tipo</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $associate->type_associate_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </x-select>
                <x-input-error :messages="$errors->get('type_associate_id')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="category_associate_id" :value="__('Categoria').'*'" />
                <x-select name="category_associate_id" id="category_associate_id">
                    <option value="">Selecione uma categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $associate->category_associate_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </x-select>
                <x-input-error :messages="$errors->get('category_associate_id')" class="mt-2" />
            </div>

            <div class="col-span-2">
                <x-input-label for="associate_name" :value="__('Name').'*'" />
                <x-text-input id="associate_name" name="associate_name" type="text" :value="old('associate_name', $associate->name)" class="mt-1 block w-full" autocomplete="name" />
                <x-input-error :messages="$errors->get('associate_name')" class="mt-2" />
            </div>
        </div>

        <div class="grid grid-cols-4 gap-2">
            <div>
                <x-input-label for="associate_surname" :value="__('Surname').'*'" />
                <x-text-input id="associate_surname" name="associate_surname" type="text" :value="old('associate_surname', $associate->surname)" class="mt-1 block w-full" autocomplete="surname" />
                <x-input-error :messages="$errors->get('associate_surname')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="occupation" :value="__('Profissão').'*'" />
                <x-text-input id="occupation" name="occupation" type="text" :value="old('occupation',$associate->occupation)" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('occupation')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="vest_number" :value="__('Nº Colete').'*'" />
                <x-text-input id="vest_number" name="vest_number" type="text" :value="old('vest_number', $associate->vest_number)" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('vest_number')" class="mt-2" />
            </div>
            <div x-data="{
                birth_date: '{{ old('birth_date', $associate->birth_date->format('Y-m-d')) }}',
                get age() {
                    if (!this.birth_date) return ''
                    const birthDate = new Date(this.birth_date)
                    const today = new Date()
                    let age = today.getFullYear() - birthDate.getFullYear()
                    const m = today.getMonth() - birthDate.getMonth()
                    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                        age--
                    }
                    return age
                }
            }">

                <div>
                    <x-input-label for="birth_date" :value="__('Data de Nascimento').'*'" />
                    <div class="flex gap-2 items-center">
                        <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full" :value="old('birth_date',$associate->birth_date->format('Y-m-d'))" x-model="birth_date" autocomplete="admission_date" />
                        <x-input-label for="age" :value="__('Idade').':'" />
                        <span x-show="age !== ''"><span x-text="age"></span></span>
                    </div>
                    <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                </div>
                
            </div>
        </div>

        <div class="grid grid-cols-3 gap-2">
            <div class="col-span-2">
                <x-input-label for="associate_address" :value="__('Address').'*'" />
                <x-text-input id="associate_address" name="associate_address" type="text" :value="old('associate_address', $associate->address)" class="mt-1 block w-full" autocomplete="address" />
                <x-input-error :messages="$errors->get('associate_address')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="associate_neighborhood" :value="__('Neighborhood').'*'" />
                <x-text-input id="associate_neighborhood" name="associate_neighborhood" type="text" :value="old('associate_neighborhood', $associate->neighborhood)" class="mt-1 block w-full" autocomplete="neighborhood" />
                <x-input-error :messages="$errors->get('associate_neighborhood')" class="mt-2" />
            </div>
        </div>
        <div class="grid grid-cols-3 gap-2">
            <div>
                <x-input-label for="associate_identity" :value="__('RG').'*'" />
                <x-text-input id="associate_identity" name="associate_identity" type="text" :value="old('associate_identity', $associate->identity)" class="mt-1 block w-full" autocomplete="identity" maxlength="15"/>
                <x-input-error :messages="$errors->get('associate_identity')" class="mt-2" />
            </div>

            <div x-data="cpfMask">
                <x-input-label for="associate_cpf" :value="__('CPF').'*'" />
                <x-text-input id="associate_cpf" name="associate_cpf" type="text" class="mt-1 block w-full" autocomplete="cpf" x-model="cpf" :value="old('associate_cpf',$associate->cpf)"
                x-data="cpfMask('{{ old('associate_cpf',$associate->cpf) }}')" 
                x-on:input="formatCPF()" 
                x-init="formatCPF()" 
                maxlength="14"
                placeholder="000.000.000-00"/>
                <x-input-error :messages="$errors->get('associate_cpf')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="associate_admission_date" :value="__('Data de Admissão').'*'" />
                <x-text-input id="associate_admission_date" name="associate_admission_date" type="date" class="mt-1 block w-full" :value="old('associate_admission_date', $associate->admission_date->format('Y-m-d'))" autocomplete="admission_date" />
                <x-input-error :messages="$errors->get('associate_admission_date')" class="mt-2" />
            </div>
        </div>

        <div class="grid grid-cols-3 gap-2">
            <div x-data="phoneMask">
                <x-input-label for="associate_contact" :value="__('Contact').'*'" />
                <x-text-input id="associate_contact" name="associate_contact" :value="old('associate_contact', $associate->contact_formatado)" type="text" class="mt-1 block w-full" autocomplete="contact" x-model="phone" 
                x-data="phoneMask('{{ old('associate_contact', $associate->contact_formatado) }}')"
                x-on:input="formatPhone()" 
                maxlength="15"
                placeholder="(00) 00000-0000"/>
                <x-input-error :messages="$errors->get('associate_contact')" class="mt-2" />
            </div>

            <div x-data="phoneMask">
                <x-input-label for="associate_family_contact" :value="__('Family Contact').'*'" />
                <x-text-input id="associate_family_contact" name="associate_family_contact" type="text" :value="old('associate_family_contact', $associate->family_contact_formatado)" class="mt-1 block w-full" autocomplete="phone" x-model="phone"
                x-data="phoneMask('{{ old('associate_family_contact', $associate->family_contact_formatado) }}')"
                x-on:input="formatPhone()" 
                maxlength="15"
                placeholder="(00) 00000-0000"/>
                <x-input-error :messages="$errors->get('associate_family_contact')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="associate_active" :value="__('Status').'*'" />
                <x-select name="associate_active" id="associate_active" :selected="$associate->active">
                    <option value="1" {{ $associate->active == '1' ? 'selected' : '' }}>Ativo</option>
                    <option value="0" {{ $associate->active == '0' ? 'selected' : '' }}>Inativo</option>
                </x-select>
                <x-input-error :messages="$errors->get('associate_active')" class="mt-2" />
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