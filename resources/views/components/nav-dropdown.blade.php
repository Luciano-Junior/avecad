@props(['active' => false])

@php
$baseClasses = 'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out';

$activeClasses = 'border-indigo-400 dark:border-indigo-600 text-gray-900 dark:text-gray-100 focus:border-indigo-700';
$inactiveClasses = 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700';

$linkClasses = $active ? "$baseClasses $activeClasses" : "$baseClasses $inactiveClasses";
@endphp

{{-- Esta DIV garante a borda inferior no alinhamento correto --}}
<div class="{{ $linkClasses }}">
    {{-- Esta DIV controla o dropdown --}}
    <div class="relative inline-flex items-center" x-data="{ open: false }" @click.away="open = false" @keydown.escape="open = false">
        <button type="button" @click="open = !open" class="inline-flex items-center">
            {{ $slot }}
            <svg class="ml-1 h-4 w-4 fill-current" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
        </button>

        {{-- Dropdown --}}
        <div
            x-show="open"
            x-transition
            class="absolute left-0 top-full mt-4 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 z-50"
            style="display: none;"
        >
            <div class="py-1">
                {{ $dropdown ?? '' }}
            </div>
        </div>
    </div>
</div>