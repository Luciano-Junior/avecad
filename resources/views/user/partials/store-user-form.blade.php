<section>
    <header>
        <h2 class="ml-2 text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Novo Usuário') }}
        </h2>

    </header>

    <form method="post" action="{{ route('user.store') }}" class="mt-6 space-y-6 px-3">
        @csrf
        @method('post')
        <div class="grid grid-cols-3 gap-2">
            <div class="col-span-2">
                <x-input-label for="name" :value="__('Name').'*'" />
                <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" class="mt-1 block w-full" autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
    
            <div>
                <x-input-label for="email" :value="__('Email').'*'" />
                <x-text-input id="email" name="email" type="text" :value="old('email', $user->email)" class="mt-1 block w-full" autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <div class="grid grid-cols-3 gap-2">
            <div class="col-span-2">
                <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="status" :value="__('Status')" />
                <x-select name="user_active" id="user_active" :selected="$user->active" class="mt-1 block w-full">
                    <option value="1" {{ $user->active == '1' ? 'selected' : '' }}>Ativo</option>
                    <option value="0" {{ $user->active == '0' ? 'selected' : '' }}>Inativo</option>
                </x-select>
                <x-input-error :messages="$errors->get('status')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>