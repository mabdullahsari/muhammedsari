<!DOCTYPE html>
@include('social.greeting')
<html dir="ltr" lang="{{ $app->getLocale() }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <!-- SEO -->
    @include('feed::links')
    <link rel="canonical" href="{{ $app['url']->current() }}" />
    <title>{{ $title }}</title>
    <meta name="author" content="{{ $app['config']['app.name'] }}" />
    <meta name="description" content="{{ $description }}" />
    <!-- Open Graph -->
    @include('social.open-graph')
    <!-- Twitter -->
    @include('social.twitter')
    <!-- Schema.org -->
    @include('social.person')
    @stack('seo')
    <!-- Stylesheets -->
    @vite('resources/css/site.css')
    @stack('styles')
</head>
<body class="bg-zinc-900 font-sans leading-normal text-zinc-300/80">
    <x-navigation />

    <main{{ $attributes }}>
        {{ $slot }}
    </main>
    <footer>
        Footer
    </footer>
    <!-- Scripts -->
    @stack('scripts')
</body>
</html>
