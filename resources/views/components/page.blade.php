@props([
    'description' => $app['config']['feed.feeds.main.description'],
    'name' => null,
])

<!DOCTYPE html>
<html dir="ltr" lang="{{ $app->getLocale() }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />

    @if($name)
    <title>{{ $name }} - {{ $app['config']['app.name'] }}</title>
    @else
    <title>{{ $app['config']['app.name'] }}</title>
    @endif

    <meta name="author" content="{{ $me->name }}" />
    <meta name="description" content="{{ $description }}" />

    <x-person :model="$me" />

    @include('feed::links')

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
