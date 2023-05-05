@props(['as' => null, 'level' => 1])

<h{{ $level }} {{ $attributes->class(['text-white font-bold', match ((int) ($as ?? $level)) {
    2 => 'text-3xl',
    default => 'text-3xl md:text-7xl'
}]) }}>{{ $slot }}</h{{ $level }}>
