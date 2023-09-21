<x-page :description="$summary" :name="$title" :og="route('og.post', $slug)" class="max-w-3xl">
    {{ $estimate }}

    <i class="flex flex-col mb-8 sm:flex-row sm:items-center">
        <i class="flex-1 pr-5 text-sm">
            {{ $publishedAt ? $publishedAt->format('F jS, Y') : 'Top secret' }}
        </i>

        <i class="mt-5 flex-wrap inline-flex items-center">
            @foreach($tags as $tag)
            <x-tags.pill :name="$tag->name" :slug="$tag->slug" />
            @endforeach
        </i>
    </i>

    <x-heading as="2" class="mb-10">{{ $title }}</x-heading>

    <i class="prose prose-invert prose-headings:font-medium">
        <x-markdown theme="github-dark" class="prose-invert">{!! $body !!}</x-markdown>
    </i>
</x-page>
