@props(['item', 'action', 'hidden_key'])

<form action="{{ $action }}" method="POST" class="flex items-end mt-2 ml-1">
    @csrf
    <input type="hidden" name="wine_id" value="{{ data_get($item, $hidden_key) }}">

    <button
        title="Eliminar"
        type="submit"
        class="px-3 py-2 mb-2 text-xs font-bold text-center text-white bg-red-500 rounded hover:bg-red-700 md:mb-0">
        x
    </button>
</form>
