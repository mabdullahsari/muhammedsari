@props(['level' => 1])

<h{{ $level }} {{ $attributes->class(['text-white font-bold', match ((int) $level) {
    2 => 'text-3xl',
    default => 'text-5xl md:text-7xl'
}]) }}>{{ $slot }}</h{{ $level }}>
