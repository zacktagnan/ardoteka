<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ $sectionTitle }}
        </h2>
    </x-slot>

    @include('wines.form')
</x-app-layout>
