<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Article / Create') }}
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
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="{{ route('article.store') }}"
                    method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            Title
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="permission" type="text" placeholder="Title" name="title">
                        <div>
                            @error('title')
                                <span class="text-red-700">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            Content
                        </label>
                        <textarea
                            class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="" cols="30" rows="10" placeholder="Content" name="content"></textarea>
                        <div>
                            @error('content')
                                <span class="text-red-700">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            Author
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="permission" type="text" placeholder="Author" name="author">
                        <div>
                            @error('author')
                                <span class="text-red-700">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <button
                            class="bg-gray-900 hover:bg-slate-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
