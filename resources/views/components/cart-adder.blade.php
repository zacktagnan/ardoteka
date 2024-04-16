@props(['wine', 'action'])

<form action="{{ $action }}" method="POST">
    @csrf
    {{-- <input type="hidden" name="wine_id" value="{{ $wine->id }}" /> --}}
    <input type="hidden" name="wine_id" value="{{ data_get($wine, 'id') }}" />

    <button
        title="Añadir"
        type="submit"
        class="p-2 mt-2 text-base font-bold text-center text-white bg-green-500 rounded hover:bg-green-700 md:mb-0">
        {{ __('Añadir al carrito') }}
    </button>
</form>
