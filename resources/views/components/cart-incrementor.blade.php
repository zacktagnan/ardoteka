@props(['item', 'action', 'hidden_key'])

<form action="{{ $action }}" method="POST" class="flex items-end mt-2">
    @csrf
    <input type="hidden" name="wine_id" value="{{ data_get($item, $hidden_key) }}" />
    {{-- <input type="hidden" name="wine_id" value="{{ data_get($item, 'id') }}" /> --}}
    {{-- <input type="hidden" name="wine_id" value="{{ $item->id }}" /> --}}

    <button
        title="Incrementar"
        type="submit"
        class="px-3 py-2 mb-2 text-xs font-bold text-center text-white bg-green-500 rounded hover:bg-green-700 md:mb-0">
        +
    </button>
</form>
