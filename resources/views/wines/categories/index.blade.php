<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Categorías de Vinos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-end">
                        <a href="{{ route('categories.create') }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                            {{ __('Crear Categoría') }}
                        </a>
                    </div>

                    @if ($categories->isNotEmpty())
                        <div class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-2">
                            @foreach ($categories as $category)
                                <div class="relative flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                                    <img
                                        class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                                        src="{{ $category->image_url }}"
                                        alt="{{ $category->name }}"
                                    />

                                    <div class="flex flex-col p-4 leading-normal">
                                        <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                            {{ $category->name }}
                                        </h5>
                                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                            {{ __('Vinos (:count)', ['count' => $category->wines_count]) }}
                                        </span>
                                        <hr class="my-3">

                                        <p class="pb-5 mb-3 font-normal text-justify text-gray-700 dark:text-gray-400 hover:cursor-pointer" title="{{ $category->description }}">
                                            {{-- {{ $category->description }} --}}
                                            {{ Str::words($category->description, 35) }}
                                        </p>

                                        <div class="absolute bottom-0 right-0 flex justify-between p-4">
                                            <a
                                                href="{{ route('categories.edit', $category) }}"
                                                class="p-1 mb-2 font-bold text-center text-white bg-purple-500 rounded hover:bg-purple-700 md:mb-0">
                                                {{ __('Editar') }}
                                            </a>
                                            <form action="{{ route('categories.destroy', $category) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="w-full p-1 font-bold text-white bg-red-500 rounded hover:bg-red-700 md:w-auto ms-2" onclick="return confirm('{{ __('¿En verdad se desea ELIMINAR este registro?') }}')">
                                                    {{ __('Eliminar') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="relative px-4 py-3 mt-4 text-center text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                            <strong class="font-bold">¡Lo sentimos!</strong>
                            <span class="block sm:inline">No hay categorías de vinos disponibles</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
