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
    @vite(['resources/css/site.css', 'resources/js/site.js'])
    @stack('styles')
</head>
<body class="bg-zinc-900 font-sans leading-normal text-zinc-300/80">
    <x-navigation />
    <div class="flex flex-col min-h-screen">
        <main {{ $attributes->class('flex-1 w-full mx-auto max-w-3xl px-6 pb-10 pt-40') }}>{{ $slot }}</main>

        <x-footer />
    </div>
    <!-- Scripts -->
    @stack('scripts')
</body>
</html>
