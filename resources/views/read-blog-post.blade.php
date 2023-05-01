<x-page :name="$post->title">
    <h1>{{ $post->title }}</h1>

    @foreach($post->tags as $tag)
    <a href="/tags/{{ $tag->slug }}">{{ $tag->name }}</a>
    @endforeach

    <x-markdown theme="github-dark">{{ $post->body }}</x-markdown>
</x-page>
