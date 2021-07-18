<x-guest-layout>
    <x-auth.auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-32" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Zapomněli jste heslo? Zadejte svůj přihlašovací email a my vám zašleme odkaz pro reset hesla.') }}
        </div>

        <!-- Session Status -->
        <x-auth.auth-session-status class="mb-4" :status="session('status')"/>

        <!-- Validation Errors -->
        <x-auth.auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')"/>

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Zaslat email pro reset hesla') }}
                </x-button>
            </div>
        </form>
    </x-auth.auth-card>
</x-guest-layout>
