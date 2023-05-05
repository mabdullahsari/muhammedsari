<x-page :name="$title">
    <div class="flex flex-col mb-8 sm:flex-row sm:items-center">
        <div class="flex-1 pr-5 text-sm">
            {{ $publishedAt->format('F jS, Y') }}
        </div>

        <div class="mt-5 flex-wrap inline-flex items-center">
            @foreach($tags as $tag)
            <x-tags.pill :name="$tag->name" :slug="$tag->slug" />
            @endforeach
        </div>
    </div>

    <x-heading as="2" class="mb-10">{{ $title }}</x-heading>

    <div class="prose prose-invert prose-headings:font-medium">
        <x-markdown theme="github-dark" class="prose-invert">{!! $body !!}</x-markdown>
    </div>
</x-page>
