<section class="overflow-y-auto">
    <header>
        <h2 class="p-4 text-lg font-medium text-gray-900 dark:text-gray-100 text-center">
            {{ __('Aniversariantes do Mês') }}
        </h2>
        <div>
            <p class="text-sm text-gray-600 dark:text-gray-400 text-center">
                {{ __('Lista de associados que fazem aniversário neste mês.') }}
            </p>
        </div>

    </header>
    <div class="mt-6 space-y-6 px-4 py-2">
        <ul>
            @foreach($birthdayPeoples as $associate)
                <li class="border-b border-gray-200 py-2">{{ $associate->name }} {{ $associate->surname }} - {{ $associate->birth_date->format('d/m') }}</li>
            @endforeach
        </ul>
        <div class="flex justify-end">
            <button class="bg-blue-500 text-white px-4 py-2 rounded" wire:click.prevent="exportarAniversariantes">
                {{ __('Salvar') }}
            </button>
        </div>
    </div>
</section>