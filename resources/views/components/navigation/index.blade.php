<header class="fixed top-0 left-0 w-full border-b border-zinc-800 bg-zinc-900/90 backdrop-blur-[6px]">
    <nav class="flex items-center mx-auto max-w-6xl px-6 py-8">
        <div class="flex-1">
            <a href="{{ $home }}" class="block outline-none hover:text-zinc-200 focus:text-zinc-200">{{ $name }}</a>
        </div>

        <div class="pl-5 relative sm:hidden">
            <button id="hamburger" aria-label="menu" class="block cursor-pointer p-2 bg-zinc-800 rounded-lg">
                <x-icon name="o-bars-3" />
            </button>

            <div class="hidden absolute top-10 right-0 shadow-lg bg-zinc-700 rounded-lg p-1 max-w-[280px] min-w-[120px] sm:static sm:block">
                <ul>
                    @foreach($items as $item)
                    <x-navigation.mobile :label="$item->label" :path="$item->path" />
                    @endforeach
                </ul>
            </div>
        </div>

        <ul class="hidden space-x-5 sm:inline-flex sm:items-center">
            @foreach($items as $item)
            <x-navigation.item :active="$item->active" :label="$item->label" :path="$item->path" />
            @endforeach
        </ul>
    </nav>
</header>
