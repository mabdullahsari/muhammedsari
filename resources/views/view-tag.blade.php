<x-page :name="$tag->name">
    <x-heading class="mb-20 text-center">
        <span class="text-zinc-500">#</span>{{ $tag->name }}
    </x-heading>

    @foreach($posts as $post)
    <x-blog.post
        :published-at="$post->publishedAt"
        :slug="$post->slug"
        :summary="$post->summary"
        :tags="$post->tags"
        :title="$post->title"
        :class="$loop->first ? null : 'mt-16'"
    />
    @endforeach
</x-page>
