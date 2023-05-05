<header class="fixed top-0 left-0 w-full border-b border-zinc-800 bg-zinc-900/90 backdrop-blur-[6px]">
    <nav class="flex items-center mx-auto max-w-6xl px-6 py-8">
        <h2 class="sr-only">Navigation</h2>

        <div class="flex-1">
            <a href="{{ $home }}" class="block outline-none hover:text-zinc-200 focus:text-zinc-200">{{ $name }}</a>
        </div>

        <div class="pl-5 relative sm:hidden">
            <button id="mobile-nav-open" aria-label="menu" class="block cursor-pointer p-2 bg-zinc-800 rounded-lg">
                <x-icon name="o-bars-3" />
            </button>
        </div>

        <ul class="hidden space-x-5 sm:inline-flex sm:items-center">
            @foreach($items as $item)
            <li><a href="{{ $item->url }}" @class([
                'rounded-lg transition-colors outline-offset-8 outline-2 focus:outline',
                'outline-amber-500 text-amber-500' => $item->active,
                'outline-white focus:text-zinc-200 hover:text-zinc-200' => ! $item->active,
            ])>{{ $item->label }}</a></li>
            @endforeach
        </ul>
    </nav>
</header>

@push('modals')
<nav id="mobile-nav" class="hidden">
    <div id="mobile-nav-backdrop" class="fixed inset-0 z-50 backdrop-blur-sm bg-black/80" aria-hidden="true"></div>

    <div class="fixed inset-x-4 top-8 z-50 rounded-3xl p-8 ring-1 bg-zinc-900 ring-zinc-800" tabindex="-1">
        <div class="flex flex-row-reverse justify-between">
            <button id="mobile-nav-close" aria-label="close" class="-m-1 p-1" type="button" tabindex="0">
                <x-icon name="o-x-mark" class="text-zinc-400" />
            </button>

            <h2 class="text-sm font-medium text-zinc-400">Navigation</h2>
        </div>

        <nav class="mt-6">
            <ul class="-my-2 divide-y divide-zinc-100/5 text-zinc-300">
                @foreach($items as $item)
                <li><a href="{{ $item->url }}" @class(['inline-block py-2', 'text-amber-500' => $item->active])>{{ $item->label }}</a></li>
                @endforeach
            </ul>
        </nav>
    </div>
</nav>
@endpush
