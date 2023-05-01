<footer class="py-8 text-sm text-zinc-500">
    <div class="flex items-center mx-auto max-w-6xl px-5">
        <div class="flex-1 pr-5">
            © {{ $year }} {{ $name }}
        </div>

        <div class="inline-flex items-center">
            @foreach($links as $link)
            <x-footer.link :icon="$link->icon" :label="$link->label" :url="$link->url" />
            @endforeach
        </div>
    </div>
</footer>
