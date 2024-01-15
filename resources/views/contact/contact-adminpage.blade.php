<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact Messages') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8">
        @foreach ($contactForms as $contact)
        <div class="bg-white shadow-md p-6 mb-6 rounded-md">
            <h2 class="text-xl font-semibold mb-4">{{$contact ->username }}</h2>
            <p><strong>Subject:</strong> {{ $contact->subject }}</p>
            <p><strong>Message:</strong> {{ $contact->message }}</p>
        </div>
        @endforeach
    </div>
</x-app-layout>