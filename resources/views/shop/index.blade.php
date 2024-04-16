<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Tienda de Vinos') }}
        </h2>
    </x-slot>

    @inject('cart', 'App\Services\Cart')

    <div class="py-6">
        <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($wines as $wine)
                        <div class="relative flex flex-col items-start bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-500 dark:hover:bg-gray-700">
                            <x-wine-image :wine="$wine" />

                            <div class="flex flex-col p-4 leading-normal">
                                @if ($cart->hasProduct($wine))
                                    <div class="px-5 py-2 mb-2 text-xs font-bold text-white uppercase bg-green-500 rounded-full">
                                        <p class="mb-2 font-normal">
                                            {{ __('En el carrito') }}: {{ $cart->getTotalQuantityForWine($wine) }} {{ __('unidades') }}
                                        </p>
                                        <p class="font-normal">
                                            {{ __('Coste total') }}: {{ $cart->getTotalCostForWine($wine, true) }}
                                        </p>
                                    </div>

                                    <div class="mb-3 border-b border-gray-300 dark:border-gray-600"></div>
                                @endif

                                <x-wine-name-and-category :wine="$wine" />

                                <div class="mb-1"></div>

                                <x-wine-info :wine="$wine" />
                            </div>

                            <div class="absolute bottom-0 right-0 flex justify-between p-4">
                                @if (! $cart->hasProduct($wine))
                                    <x-cart-adder
                                        :wine="$wine"
                                        :action="route('shop.addToCart')"
                                    />
                                @else
                                    <div class="flex">
                                        <x-cart-incrementor
                                            :item="$wine"
                                            :action="route('shop.increment')"
                                            hidden_key="id"
                                        />
                                        <x-cart-decrementor
                                            :item="$wine"
                                            :action="route('shop.decrement')"
                                            hidden_key="id"
                                        />
                                        <x-cart-remover
                                            :item="$wine"
                                            :action="route('shop.remove')"
                                            hidden_key="id"
                                        />
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
