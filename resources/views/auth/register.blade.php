<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

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

        <!-- Birthday -->
        <div class="mt-4">
            <x-input-label for="birthday" :value="__('Birthday')" />
            <x-text-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" :value="old('birthday')" required autofocus autocomplete="birthday" />
            <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
        </div>

        <!-- Avatar -->
        <div class="mt-4">
            <label for="avatar">Avatar:</label>
            <input type="file" name="avatar" accept="image/*">
            <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
        </div>

    
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- About Me -->
        <div class="mt-4">
            <x-input-label for="about_me" :value="__('About Me')" />
            <x-text-input id="about_me" class="block mt-1 w-full" type="text" name="about_me" :value="old('about_me')" required autofocus autocomplete="about_me" />
            <x-input-error :messages="$errors->get('about_me')" class="mt-2" />
        </div>
        

        <!-- Register Button -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
            <a href="{{ route('welcome') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition duration-150 ease-in-out">Welcome</a>
        </div>
    </form>
</x-guest-layout>
