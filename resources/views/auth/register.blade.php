<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

             <!-- Cargo -->
             <div class="mt-4">
                <x-label for="cargo" :value="__('Cargo')" />

                <x-input id="cargo" class="block mt-1 w-full" type="text" name="cargo" :value="old('cargo')" required autofocus />{{--cria o input para pegar o valor do cargo do usuario para cadastrar no banco--}}
            </div>

            <!-- Nível de acesso -->
            <div class="mt-4">
                <x-label for="nivel_acesso" :value="__('Nível de acesso')" />

                <x-input id="nivel_acesso" class="block mt-1 w-full" type="text" name="nivel_acesso" :value="old('nivel_acesso')" required autofocus />{{--cria o input para pegar o valor do nivel de acesso do usuario para cadastrar no banco--}}
            </div>


            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Username')" />

                <x-input id="email" class="block mt-1 w-full" type="text" name="email" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
