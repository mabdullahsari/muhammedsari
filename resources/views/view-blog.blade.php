<x-page name="Blog" class="max-w-3xl">
    <x-heading class="sr-only">Blog</x-heading>

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
