<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Role / Create') }}
                </h2>
            </div>

            <div>
                <a class="bg-gray-900 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    href="{{ route('permission.index') }}">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full">
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="{{ route('role.store') }}"
                    method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            Role
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="Role" type="text" placeholder="Role" name="name">
                        <div>
                            @error('name')
                                <span class="text-red-700">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($permissions as $permission)
                            <div class="flex items-center">
                                <input name="permission[]" type="checkbox" value="{{ $permission->name }}" id="permission-{{ $permission->id }}">
                                <label for="permission-{{ $permission->id }}" class="block text-gray-700 px-2">{{ $permission->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex items-center justify-between py-2">
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
