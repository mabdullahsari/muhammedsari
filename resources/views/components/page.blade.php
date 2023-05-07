<!DOCTYPE html>
<!--
Hi! 👋 Thanks for checking out my blog. 🙏
----
I hope you'll be able to learn a thing or two!
----
The codebase is fully open source, so don't forget to check it out if you're interested!
🔗 https://github.com/mabdullahsari/muhammedsari
-->
<html dir="ltr" lang="{{ $app->getLocale() }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    @stack('prefetch')
    <!-- SEO -->
    @include('feed::links')
    <link rel="canonical" href="{{ $url = url()->current() }}" />
    <title>{{ $title }}</title>
    <meta name="author" content="{{ $suffix }}" />
    <meta name="description" content="{{ $description }}" />
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}" />
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('safari-pinned-tab.svg') }}" color="#333333" />
    <meta name="msapplication-TileColor" content="#333333" />
    <meta name="theme-color" content="#333333" />
    <!-- Open Graph -->
    <meta property="og:description" content="{{ $description }}" />
    <meta property="og:image" content="{{ asset('img/mabdullahsari.jpg') }}" />
    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $url }}" />
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:creator" content="@mabdullahsari"/>
    <meta name="twitter:site" content="@mabdullahsari"/>
    <!-- Schema.org -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Person",
        "name": "{{ $suffix }}",
        "givenName": "Muhammed",
        "familyName": "Sarı",
        "url": "{{ config('app.url') }}",
        "image": "{{ asset('img/mabdullahsari.jpg') }}",
        "sameAs": [
            "https://www.github.com/mabdullahsari",
            "https://www.twitter.com/mabdullahsari",
            "https://www.youtube.com/@mabdullahsari",
            "https://www.linkedin.com/in/mabdullahsari/",
            "https://www.facebook.com/mabdullahsari"
        ]
    }
    </script>
    <!-- Stylesheets -->
    @vite('resources/css/site.css')
</head>
<body class="bg-zinc-900 font-sans leading-normal text-zinc-300/80">
    <x-navigation />
    <i class="flex flex-col min-h-screen">
        <main {{ $attributes->class('flex-1 w-full mx-auto px-6 pb-10 pt-24 sm:pt-40') }}>{{ $slot }}</main>

        <x-footer />
    </i>
    @stack('modals')
    <!-- Scripts -->
    @vite('resources/js/site.js')
    @stack('scripts')
</body>
</html>
