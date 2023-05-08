<x-page name="Tags" :og="asset('open-graph/tags.png')" class="max-w-xl">
    <x-heading class="text-center mb-10">Tags</x-heading>

    <ul class="flex flex-wrap text-xl lg:text-2xl justify-center">
        @foreach($tags as $tag)
        <li class="mx-4 my-4">
            <x-tags.hashtag :name="$tag->name" :slug="$tag->slug" />
        </li>
        @endforeach
    </ul>
</x-page>
