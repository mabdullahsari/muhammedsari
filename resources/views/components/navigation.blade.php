<header class="fixed top-0 left-0 w-full border-b border-zinc-800 bg-zinc-900/90 backdrop-blur-[6px] z-10">
    <nav class="flex items-center mx-auto max-w-5xl px-6 py-4">
        <h2 class="sr-only">Main navigation</h2>

        <i class="mr-auto">
            <a href="{{ $home }}" title="{{ $name }}" class="block outline-none text-white transition-colors hover:text-amber-600">
                <x-icon name="ms" class="h-12 -my-2 sm:m-0 sm:h-16" />
            </a>
        </i>

        <i class="pl-5 relative sm:hidden">
            <button id="mobile-nav-open" aria-label="menu" class="block cursor-pointer p-2 bg-zinc-800 rounded-lg">
                <x-icon name="o-bars-3" class="w-5 h-5" />
            </button>
        </i>

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
<i id="mobile-nav" class="hidden">
    <i id="mobile-nav-backdrop" class="fixed inset-0 z-50 backdrop-blur-sm bg-black/80" aria-hidden="true"></i>

    <i class="fixed inset-x-4 top-8 z-50 rounded-3xl p-8 ring-1 bg-zinc-900 ring-zinc-800" tabindex="-1">
        <i class="flex flex-row-reverse justify-between">
            <button id="mobile-nav-close" aria-label="close" class="-m-1 p-1" type="button" tabindex="0">
                <x-icon name="o-x-mark" class="text-zinc-400 w-5 h-5" />
            </button>

            <span class="text-sm font-medium text-zinc-400">Navigation</span>
        </i>

        <nav class="mt-6">
            <h2 class="sr-only">Mobile navigation</h2>

            <ul class="-my-2 iide-y iide-zinc-100/5 text-zinc-300">
                @foreach($items as $item)
                <li><a href="{{ $item->url }}" @class(['inline-block py-2', 'text-amber-500' => $item->active])>{{ $item->label }}</a></li>
                @endforeach
            </ul>
        </nav>
    </i>
</i>
@endpush
