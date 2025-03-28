@props([
    'name',
    'id' => null,
    'selected' => null,
])

<select name="{{ $name }}" id="{{ $id ?? $name }}" 
    {{ $attributes->merge(['class' => 'mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block w-full']) }}>

    {{ $slot }} <!-- Aqui o slot insere as opções passadas pelo usuário -->

</select>