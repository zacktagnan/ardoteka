@props(['wine'])

<img
    class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
    src="{{ $wine->image_url }}"
    alt="{{ $wine->name }}"
/>
