<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="bg-white px-6 pb-6 pt-2 rounded">
        @csrf

        <div class="text-center font-bold text-xl mb-1 mt-4">Login to your account</div>

        <span class="block text-center mb-6 text-xs">Don't have an account?
            <button id="registerButton" onclick="showForm('registerForm', 'loginForm')" class="underline font-medium text-green-600 hover:text-green-700">
                Register</button>
        </span>
        

        <!-- Email Address -->
        <div>
            {{-- <x-input-label for="email" :value="__('Email')" /> --}}
            <x-text-input id="email" placeholder="Email" class="block w-full text-base" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            {{-- <x-input-label for="password" :value="__('Password')" /> --}}

            <x-text-input id="password" placeholder="Password" class="block mt-1 w-full text-base"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        {{-- <div class="block mt-2">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-base text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div> --}}
        

        <div class="flex items-center justify-between mt-4">
            <x-primary-button>
                {{ __('Login') }}
            </x-primary-button>
            
            @if (Route::has('password.request'))
                <a class="underline text-base text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
