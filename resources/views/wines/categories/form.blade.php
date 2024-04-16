<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method($method)

                    <div class="mb-4">
                        <label for="name" class="block mb-2 text-sm font-bold text-gray-700 dark:text-white">
                            {{ __('Nombre') }}
                        </label>
                        <input
                            type="text" name="name" id="name"
                            value="{{ old('name', $category->name) }}"
                            class="w-full px-3 py-2 leading-tight text-black border border-gray-200 rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                        @error('name')
                            <p class="text-xs italic text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="image" class="block mb-2 text-sm font-bold text-gray-700 dark:text-white">
                            {{ __('Imagen') }}
                        </label>
                        <input
                            type="file" name="image" id="image"
                            class="w-full px-3 py-2 leading-tight text-black border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                        @error('image')
                            <p class="text-xs italic text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block mb-2 text-sm font-bold text-gray-700 dark:text-white">
                            {{ __('Descripción') }}
                        </label>
                        <textarea
                            name="description" id="description"
                            class="w-full px-3 py-2 leading-tight text-black border border-gray-200 rounded shadow appearance-none focus:outline-none focus:shadow-outline">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <p class="text-xs italic text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end mb-4">
                        <a
                            href="{{ route('categories.index') }}"
                            class="px-4 py-2 font-bold text-white bg-gray-500 rounded hover:bg-gray-700">
                            {{ __('Cancelar') }}
                        </a>
                        <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 ms-2">
                            {{ $submit }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
