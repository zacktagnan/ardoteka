<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Carrito') }}
        </h2>
    </x-slot>

    @inject('cart', 'App\Services\Cart')

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        @if ($cart->isEmpty())
                            <p class="relative px-4 py-3 text-center text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                                {{ __('No hay productos en el carrito') }}
                            </p>
                        @else
                            <table class="w-full whitespace-nowrap">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-gray-700">
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                            {{ __('Nombre') }}
                                        </th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-300">
                                            {{ __('Precio') }}
                                        </th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-300">
                                            {{ __('Cantidad') }}
                                        </th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-300">
                                            {{ __('Total') }}
                                        </th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase w-36 dark:text-gray-300">
                                            {{ __('Acciones') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart->getCart() as $item)
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                {{-- con h-10 para darle una altura acorde a la w y redondear mejor --}}
                                                <div class="flex-shrink-0 w-10">
                                                    {{-- h-10 --}}
                                                    <img class="w-10 border-2 border-green-400 rounded-full" src="{{ data_get($item, 'product.image_url') }}"
                                                        alt="{{ data_get($item, 'product.name') }}">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                        {{ data_get($item, 'product.name') }}
                                                    </div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                                        {{ data_get($item, 'product.category.name') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 text-right whitespace-nowrap">
                                            <div class="mr-20 text-sm text-gray-900 dark:text-gray-100">
                                                {{ data_get($item, 'product.formatted_price') }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-gray-100">
                                                {{ data_get($item, 'quantity') }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 text-right whitespace-nowrap">
                                            <div class="mr-20 text-sm text-gray-900 dark:text-gray-100">
                                                {{ $cart->getTotalCostForWine(data_get($item, 'product'), true) }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex justify-center text-sm text-gray-900 dark:text-gray-100">
                                                <x-cart-incrementor :item="$item" :action="route('cart.increment')" hidden_key="product.id" />

                                                <x-cart-decrementor :item="$item" :action="route('cart.decrement')" hidden_key="product.id" />

                                                <x-cart-remover :item="$item" :action="route('cart.remove')" hidden_key="product.id" />
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="bg-gray-100 dark:bg-gray-700">
                                        <td class="px-6 py-4 whitespace-nowrap"></td>
                                        <td class="px-6 py-4 whitespace-nowrap"></td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $cart->getTotalQuantity() }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right whitespace-nowrap">
                                            <div class="mr-20 text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $cart->getTotalCost(formatted: true) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                <form action="{{ route('cart.clear') }}" method="POST" class="inline ms-2">
                                                    @csrf
                                                    <button type="submit"
                                                        class="p-1 px-3 py-3 mr-1 text-xs font-bold text-center text-white bg-red-500 rounded hover:bg-red-700 md:mb-0">
                                                        {{ __('Vaciar carrito') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
