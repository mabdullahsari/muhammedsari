<header class="fixed top-0 left-0 w-full border-b border-zinc-800 bg-zinc-900/90 backdrop-blur-[6px]">
    <nav class="flex items-center mx-auto max-w-6xl px-6 py-8">
        <div class="flex-1">
            <a href="{{ $home }}" class="block">{{ $name }}</a>
        </div>

        <ul class="inline-flex items-center space-x-5">
            @foreach($items as $item)
            <x-navigation.item :label="$item->label" :path="$item->path" />
            @endforeach
        </ul>
    </nav>
</header>
