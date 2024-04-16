@props(['wine'])

<h5 class="text-[1.28rem] font-bold tracking-tight text-gray-900 dark:text-white">
    {{ $wine->name }}
</h5>
<span class="text-sm font-normal text-gray-500 dark:text-gray-400">
    {{ __('Categoría') }}: {{ $wine->category->name }}
</span>
<hr class="my-3">
