@props(['publishedAt', 'slug', 'summary', 'tags', 'title'])

<article {{ $attributes }}>
    <x-heading level="2" class="mb-4">
        <a href="{{ $url = route('blog.post', $slug) }}" class="tracking-tight transition-colors outline-none hover:text-amber-500 focus:text-amber-500 focus:underline">
            {{ $title }}
        </a>
    </x-heading>

    <p>
        <span class="text-zinc-500 text-sm uppercase font-medium">{{ $publishedAt->format('F jS, Y') }}</span> —

        <a href="{{ $url }}" class="hover:text-zinc-200 transition-colors" tabindex="-1">{{ $summary }}</a>
    </p>

    <i class="mt-5 inline-flex flex-wrap items-center">
        @foreach($tags as $tag)
        <x-tags.pill :name="$tag->name" :slug="$tag->slug" />
        @endforeach
    </i>
</article>
