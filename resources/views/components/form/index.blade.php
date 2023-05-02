<form {{ $attributes->merge(['method' => 'POST']) }}>
    {{ $slot }}
</form>
