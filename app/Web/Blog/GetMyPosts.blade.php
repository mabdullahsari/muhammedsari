<x-page name="Blog">
    @foreach($posts as $post)
        <article>
            <a href="blog/{{ $post->slug }}">
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->summary }}</p>

                <time datetime="{{ $post->publishedAt->toIso8601String() }}">
                    {{ $post->publishedAt->toDateString() }}
                </time>
            </a>
        </article>
    @endforeach
</x-page>
