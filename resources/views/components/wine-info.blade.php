@props(['wine'])

<p class="mb-2 font-normal text-gray-700 dark:text-gray-400">
    <strong>{{ __('Precio/unidad') }}:</strong> {{ $wine->formatted_price }}
</p>

<p class="mb-2 font-normal text-gray-700 dark:text-gray-400">
    <strong>{{ __('Año cosecha') }}:</strong> {{ $wine->year }}
</p>

<p class="mb-2 font-normal text-gray-700 dark:text-gray-400">
    <strong>Stock:</strong> {{ __(':count unidad(es)', ['count' => $wine->stock]) }}
</p>

<p class="pb-5 mb-3 font-normal text-justify text-gray-700 dark:text-gray-400 hover:cursor-pointer" title="{{ $wine->description }}">
    {{-- {{ $wine->description }} --}}
    {{-- {{ Str::limit($wine->description, 200) }} --}}
    {{ Str::words($wine->description, 20) }}
</p>
