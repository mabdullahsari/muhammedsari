<x-page name="Contact" :og="asset('open-graph/contact.png')" class="max-w-5xl">
    <x-heading class="mb-5 sm:mb-10">Contact</x-heading>

    @if($didSubmit)
    <img alt="Floating head jar" src="{{ asset('/img/head-jar.png') }}" class="mb-5 w-48 mx-auto sm:w-80 sm:mx-0 sm:-ml-16 sm:mb-10" />

    <x-intro class="text-center md:text-left">Thank you! I have received your message.</x-intro>
    @else
    <x-intro>Say hi! Get in touch using the form below.</x-intro>

    <x-form class="mt-8 space-y-8 max-w-md sm:mt-16">
        <x-form.input
            autocomplete="given-name"
            label="Name"
            name="name"
            minlength="2"
            maxlength="255"
        />

        <x-form.input
            autocomplete="email"
            label="Email address"
            name="email"
            type="email"
            minlength="2"
            maxlength="255"
        />

        <x-form.text
            label="Message"
            name="message"
            minlength="10"
            maxlength="1000"
        />

        <x-honeypot />

        <x-form.submit class="ml-auto" />
    </x-form>
    @endif

    @push('prefetch')
    <link rel="prefetch" href="{{ asset('/img/head-jar.png') }}" />
    @endpush
</x-page>
