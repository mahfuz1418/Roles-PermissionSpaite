<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Permission List') }}
                </h2>
            </div>

            <div>
                <a class="bg-gray-900 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    href="{{ route('permission.create') }}">Create Permission</a>
            </div>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            </span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center text-gray-700">Serial</th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center text-gray-700">Permission
                                    </th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center text-gray-700">Created At
                                    </th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center text-gray-700">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $loop->iteration }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">{{ $permission->name }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">{{ \Carbon\Carbon::parse($permission->created_at)->format('d M y') }}
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">
                                            <a class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-3 rounded focus:outline-none focus:shadow-outline" href="{{ route('permission.edit', $permission->id) }}">Edit</a>
                                            <a class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-3 rounded focus:outline-none focus:shadow-outline" href="{{ route('permission.delete', $permission->id) }}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $permissions->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
