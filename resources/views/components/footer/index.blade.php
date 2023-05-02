<footer class="py-8 text-sm text-zinc-500">
    <div class="flex items-center mx-auto max-w-6xl px-5">
        <div class="flex-1 pr-5">
            © {{ $year }} {{ $name }}
        </div>

        <div class="inline-flex items-center">
            <x-footer.link label="Twitter" url="https://twitter.com/mabdullahsari" class="hover:text-cyan-500" />
            <x-footer.link label="GitHub" url="https://www.github.com/mabdullahsari" class="hover:text-white" />
            <x-footer.link label="LinkedIn" url="https://www.linkedin.com/in/mabdullahsari/" class="hover:text-blue-500" />
            <x-footer.link label="RSS" url="/feed.atom" class="hover:text-orange-500" />
        </div>
    </div>
</footer>
