@props(['active'])

@php
$buttonClasses = 'w-full flex items-center justify-between ps-3 pe-4 py-2 text-start text-base font-medium transition duration-150 ease-in-out focus:outline-none';
$activeClasses = 'border-l-4 border-indigo-400 dark:border-indigo-600 text-indigo-700 dark:text-indigo-300 bg-indigo-50 dark:bg-indigo-900/50';
$inactiveClasses = 'border-l-4 border-transparent text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600';

$buttonStyle = ($active ?? false)
    ? "$buttonClasses $activeClasses"
    : "$buttonClasses $inactiveClasses";
@endphp

<div x-data="{ open: false }" class="w-full">
    <button @click="open = !open" class="{{ $buttonStyle }}">
        <span>{{ $slot }}</span>
        <svg class="ms-2 h-5 w-5 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
    </button>

    <div x-show="open" x-transition class="mt-1 space-y-1 ps-6" style="display: none;">
        {{ $dropdown ?? '' }}
    </div>
</div>