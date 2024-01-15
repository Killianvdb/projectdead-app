<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact Us') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">


                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf




                    <div class="mt-4">
                        <label for="username" class="block text-sm font-medium text-gray-700">Your Username</label>
                        <input type="text" name="username" id="username" class="form-input mt-1 block w-full"
                            required />
                    </div>

                    <div class="mt-4">
                        <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                        <input type="text" name="subject" id="subject" class="form-input mt-1 block w-full" required />
                    </div>

                    <div class="mt-4">
                        <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                        <textarea name="message" id="message" rows="6"
                            class="form-input rounded-md shadow-sm mt-1 block w-full" required></textarea>
                    </div>

                    <div class="mt-4">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-white hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-800">
                            {{ __('Submit') }}
                        </button>
                    </div>
                    @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-app-layout>