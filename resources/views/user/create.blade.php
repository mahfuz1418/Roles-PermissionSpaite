<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('User / Create') }}
                </h2>
            </div>

            <div>
                <a class="bg-gray-900 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    href="{{ route('article.index') }}">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full">
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
                    action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            Name
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Name"
                            id="role" type="text"  name="name">
                        <div>
                            @error('name')
                                <span class="text-red-700">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                            Email
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Email"
                            id="email" type="text"  name="email">
                        <div>
                            @error('email')
                                <span class="text-red-700">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            Password
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Password"
                            id="password" type="password"  name="password">
                        <div>
                            @error('password')
                                <span class="text-red-700">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="confirm_password">
                            Confirm Password
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Re-Enter Password"
                            id="confirm_password" type="password"  name="confirm_password">
                        <div>
                            @error('confirm_password')
                                <span class="text-red-700">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($roles as $role)
                            <div class="flex items-center">
                                <input name="roles[]" type="checkbox"
                                    id="{{ $role->id }}" value="{{ $role->name }}">
                                <label for="{{ $role->id }}"
                                    class="block text-gray-700 px-2">{{ $role->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex items-center justify-between mt-3">
                        <button
                            class="bg-gray-900 hover:bg-slate-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
