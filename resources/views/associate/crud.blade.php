<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Associate') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @switch(Route::currentRouteName())
                @case("associate.register")
                    @include('associate.partials.store-associate-form')
                    @break
                @case("associate.edit")
                    @include('associate.partials.edit-associate-form')
                    @break
            
                @default
                    
            @endswitch
        </div>
    </div>
</x-app-layout>