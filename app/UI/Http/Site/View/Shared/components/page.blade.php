<!DOCTYPE html>
@include('partials.greeting')
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
    @include('partials.open-graph')
    <!-- Twitter -->
    @include('partials.twitter')
    <!-- Schema.org -->
    @include('partials.person')
    @stack('seo')
    <!-- Stylesheets -->
    @stack('styles')
</head>
<body>
    <header>
        Header
    </header>
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
