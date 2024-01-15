<section >
    <header>
        <h2 class="text-lg font-medium text-gray-900">
           {{_('Admin Panel')}}
        </h2>
    </header>
    <div class="mt-5 md:mt-0 md:col-span-2">

<!-- this is a panel here the admin can promote or demote another user from being an admin -->
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                   <a href="{{ route('welcome') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition duration-150 ease-in-out">Welcome</a>
                </div>

        <form action="{{ route('profile.admin') }}" method="POST">
            @csrf
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">

                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
                            <select id="user_id" name="user_id" autocomplete="user_id" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('user_id') border-red-500 @enderror">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="is_admin" class="block text-sm font-medium text-gray-700">Role</label>
                            <select id="is_admin" name="is_admin" autocomplete="is_admin" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('is_admin') border-red-500 @enderror">
                                <option value="1">Admin</option>
                                <option value="0">User</option>
                            </select>
                            @error('is_admin')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </div>
            </div>
        </form>
    </div>
    <x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>

            @if(auth()->check() && auth()->user()->isAdmin)
            <a href="{{ route('posts.create') }}" class="text-blue-500">Create a post</a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Users') }}
                    </h2>

                    @foreach ($users as $user)
                    <div class="bg-gray-100 p-4 mb-4">
                        <h3 class="text-xl font-bold">{{ $user->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        <p class="text-sm text-gray-500">{{ $user->is_admin ? 'Admin' : 'User' }}</p>

                        <!-- Admin-only buttons for promoting and demoting -->
                        @if(auth()->check() && auth()->user()->isAdmin)
                        <div class="mt-2">
                            @if($user->is_admin)
                            <a href="{{ route('users.demote', ['id' => $user->id]) }}" class="text-blue-500">Demote</a>
                            @else
                            <a href="{{ route('users.promote', ['id' => $user->id]) }}" class="text-blue-500">Promote</a>
                            @endif
                        </div>
                        @endif
                    </div>
                    @endforeach

                <div class="max-w-xl mt-8">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Posts') }}
                    </h2>

                    @foreach ($posts as $post)
                    <div class="bg-gray-100 p-4 mb-4">
                        <h3 class="text-xl font-bold">{{ $post->title }}</h3>
                        <p class="text-sm text-gray-500">{{ $post->publishing_date }}</p>
                        <img src="{{ asset($post->cover_image) }}" alt="{{ $post->title }}"
                            class="post-cover-image mt-2">
                        <div class="mt-2">{{ $post->content }}</div>

                        <!-- Admin-only buttons for editing and deleting -->
                        @if(auth()->check() && auth()->user()->isAdmin)
                        <div class="mt-2">
                            <a href="{{ route('posts.edit',['post' => $post->postId]) }}" class="text-blue-500">Edit</a>
                            <form action="{{ route('posts.delete', ['post' => $post->postId]) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

</section>
