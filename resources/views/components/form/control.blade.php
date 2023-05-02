@props(['as' => null, 'label' => null])

<label class="block w-full relative">
    <span class="inline-block text-sm font-semibold leading-6 mb-1.5">
        {{ $label }}

        <sup class="font-medium text-red-400">*</sup>
    </span>

    <{{ $as }} {{ $attributes->merge([
        'required' => true,
    ])->class('w-full py-2 px-3.5 transition duration-75 rounded-lg outline-none focus:ring-2 focus:ring-inset bg-zinc-700 text-white focus:ring-amber-500') }}>{{ $slot }}</{{ $as }}>
</label>
