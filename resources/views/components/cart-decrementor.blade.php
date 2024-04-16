@props(['item', 'action', 'hidden_key'])

<form action="{{ $action }}" method="POST" class="flex items-end mt-2 ml-1">
    @csrf
    <input type="hidden" name="wine_id" value="{{ data_get($item, $hidden_key) }}">

    <button
        title="Decrementar"
        type="submit"
        class="px-3 py-2 mb-2 text-xs font-bold text-center text-white bg-yellow-500 rounded hover:bg-yellow-700 md:mb-0">
        -
    </button>
</form>
