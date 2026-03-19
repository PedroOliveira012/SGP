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
                <x-label for="name" :value="__('Nome')" />

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

                <p style="color: #7f8387; margin-left: 12px; margin-top: 8px;">LEGENDA:</p>
                <p style="color: #7f8387; margin-left: 12px;">1-Montador</p>
                <p style="color: #7f8387; margin-left: 12px;">2-Analista e projetista</p>
                <p style="color: #7f8387; margin-left: 12px;">3-Coordenador e líderes da produção</p>
                <p style="color: #7f8387; margin-left: 12px;">4-Coordenador de engenharia e diretor</p>
            </div>


            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Username')" />

                <x-input id="email" class="block mt-1 w-full" type="text" name="email" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Senha')" />
                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirmar senha')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Já registrado?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Registrar') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
