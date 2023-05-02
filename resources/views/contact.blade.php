<x-page name="Contact">
    <x-heading class="mb-10">Contact</x-heading>

    @if($didSubmit)
    <x-intro>Thank you! I have received your message.</x-intro>
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
</x-page>
