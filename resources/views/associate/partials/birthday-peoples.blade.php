<section class="overflow-y-auto">
    <header class="relative flex items-center">
        <h2 class="p-4 text-lg font-medium text-gray-900 dark:text-gray-100 text-center flex-1">
            {{ __('Aniversariantes do Mês') }}
        </h2>
        <button 
            type="button" 
            class="ml-auto mr-4 mt-0 text-gray-500 hover:text-gray-700 text-xl font-bold"
            wire:click="toggleModalAniversariantes"
            aria-label="Fechar"
        >
            &times;
        </button>
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