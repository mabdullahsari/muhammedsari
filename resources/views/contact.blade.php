<x-page name="Contact" class="md:flex">
    <div class="hidden md:items-start md:2-2/5 md:flex">
        <img alt="Floating head jar" src="{{ asset('/img/head-jar.png') }}" width="300" class="animate-headjar" />
    </div>

    <div class="md:w-3/5">
        <x-heading class="mb-10">Contact</x-heading>

        @if($didSubmit)
        <x-intro>Thank you! I have received your message.</x-intro>

        <img alt="Floating head jar" src="{{ asset('/img/head-jar.png') }}" width="200" class="mt-10 mx-auto md:hidden" />
        @else
        <x-intro>Say hi! Get in touch using the form below.</x-intro>

        <x-form class="mt-16 space-y-8 max-w-md">
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
    </div>
</x-page>
