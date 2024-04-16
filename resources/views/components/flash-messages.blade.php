@props(['sessionType', 'color', 'title'])

                    <div class="mx-auto mt-2 mb-0 max-w-7xl sm:px-6 lg:px-8">
                        <div class="relative px-4 py-3 text-{{ $color }}-700 bg-{{ $color }}-100 border border-{{ $color }}-400 rounded" role="alert">
                            <strong class="font-bold">{{ $title }}</strong>
                            <span class="block sm:inline">{{ session($sessionType) }}</span>
                        </div>
                    </div>
