<x-guest-layout>
    <x-auth.auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-32" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth.auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- First Name -->
            <div>
                <x-label for="first_name" :value="__('Jméno')"/>

                <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')"
                         required autofocus/>
            </div>

            <!-- Last Name -->
            <div class="mt-4">
                <x-label for="last_name" :value="__('Příjmení')"/>

                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required/>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')"/>

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Heslo')"/>

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password"/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Potvzení hesla')"/>

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Již registován?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Registrovat') }}
                </x-button>
            </div>
        </form>
    </x-auth.auth-card>
</x-guest-layout>
