<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method($method)

                    <div class="grid grid-cols-8 gap-6 mb-4">
                        <div class="col-span-full sm:col-span-4">
                            <label for="name" class="block mb-2 text-sm font-bold text-gray-700 dark:text-white">
                                {{ __('Nombre') }}
                            </label>
                            <input
                                type="text" name="name" id="name"
                                value="{{ old('name', $wine->name) }}"
                                class="w-full px-3 py-2 leading-tight text-black border border-gray-200 rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                            @error('name')
                                <p class="text-xs italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-full sm:col-span-4">
                            <label for="category_id" class="block mb-2 text-sm font-bold text-gray-700 dark:text-white">
                                {{ __('Categoría') }}
                            </label>
                            <select
                                name="category_id" id="category_id"
                                class="w-full px-3 py-2 leading-tight text-gray-700 border border-gray-200 rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                                <option value="">-- {{ __('Seleccionar una categoría') }} --</option>
                                @foreach (\App\Models\Category::all() as $category )
                                    <option
                                        value="{{ $category->id }}"
                                        {{ old('category_id', $wine->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-xs italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="grid grid-cols-8 gap-6 mb-4">
                        <div class="col-span-full sm:col-span-2">
                            <label for="year" class="block mb-2 text-sm font-bold text-gray-700 dark:text-white">{{ __('Año cosecha') }}</label>
                            <input type="number" name="year" id="year" value="{{ old('year', $wine->year) }}"
                                class="w-full px-3 py-2 leading-tight text-gray-700 border border-gray-200 rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                            @error('year')
                            <p class="text-xs italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-full sm:col-span-2">
                            <label for="price" class="block mb-2 text-sm font-bold text-gray-700 dark:text-white">{{ __('Precio') }}</label>
                            <input type="number" step=".01" name="price" id="price" value="{{ old('price', $wine->price) }}"
                                class="w-full px-3 py-2 leading-tight text-gray-700 border border-gray-200 rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                            @error('price')
                            <p class="text-xs italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-full sm:col-span-2">
                            <label for="stock" class="block mb-2 text-sm font-bold text-gray-700 dark:text-white">{{ __('Cantidad') }}</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $wine->stock) }}"
                                class="w-full px-3 py-2 leading-tight text-gray-700 border border-gray-200 rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                            @error('stock')
                            <p class="text-xs italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-full sm:col-span-2">
                            <label for="image" class="block mb-2 text-sm font-bold text-gray-700 dark:text-white">
                                {{ __('Imagen') }}
                            </label>
                            <input type="file" name="image" id="image"
                                class="w-full px-3 py-2 leading-tight text-black border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                            @error('image')
                            <p class="text-xs italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block mb-2 text-sm font-bold text-gray-700 dark:text-white">
                            {{ __('Descripción') }}
                        </label>
                        <textarea
                            name="description" id="description"
                            class="w-full px-3 py-2 leading-tight text-black border border-gray-200 rounded shadow appearance-none focus:outline-none focus:shadow-outline">{{ old('description', $wine->description) }}</textarea>
                        @error('description')
                            <p class="text-xs italic text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end mb-4">
                        <a
                            href="{{ route('wines.index') }}"
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
