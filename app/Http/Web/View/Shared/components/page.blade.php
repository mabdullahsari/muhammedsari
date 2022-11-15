<!DOCTYPE html>
@include('partials.greeting')
<html dir="ltr" lang="{{ $app->getLocale() }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <link rel="canonical" href="{{ $app['url']->current() }}" />
    @include('feed::links')

    <title>{{ $title }}</title>
    <meta name="author" content="{{ $app['config']['app.name'] }}" />
    <meta name="description" content="{{ $description }}" />

    @include('partials.open-graph')

    @include('partials.twitter')

    @include('partials.person')

    @stack('seo')

    @stack('styles')
</head>
<body>
    <header>
        Header
    </header>

    <main {{ $attributes }}>
        {{ $slot }}
    </main>

    <footer>
        Footer
    </footer>

    @stack('scripts')
</body>
</html>
