<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <script src="//unpkg.com/alpinejs" defer></script>

        <div x-data="{ role: 'apprentice' }">

            <!-- Role -->
            <div class="space-y-1 mb-2">
                <div class="flex gap-2 items-center">
                    <x-radio-input x-model="role" name="role" id="apprentice" value="apprentice"/>
                    <x-input-label for="apprentice" value="Apprentice" />
                </div>
                <div class="flex gap-2 items-center">
                    <x-radio-input x-model="role" name="role" id="manager" value="manager"/>
                    <x-input-label for="manager" value="Manager" />
                </div>
            </div>

            <!-- Candidate Number -->
            <div x-show="role == 'apprentice'" class="mb-2">
                <x-input-label for="candidate_number" :value="__('Candidate Number')" />
                <x-text-input id="candidate_number" class="block mt-1 w-full" type="number" min="000000" max="999999" name="candidate_number" :value="old('candidate_number')" autofocus autocomplete="name" />
                <small class="text-white">6 digits, e.g. 701234</small>
                <x-input-error :messages="$errors->get('candidate_number')" class="mt-2" />
            </div>

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </div>
    </form>

</x-guest-layout>

