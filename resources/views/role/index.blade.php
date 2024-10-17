<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Permission List') }}
                </h2>
            </div>

            <div>
                @can('create role')
                    <a class="bg-gray-900 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        href="{{ route('role.create') }}">Create Role</a>
                @endcan

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
                                    <th class="py-2 px-4 border-b border-gray-300 text-center text-gray-700">Role
                                    </th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center text-gray-700">Permissions
                                    </th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center text-gray-700">Created At
                                    </th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center text-gray-700">Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">
                                            {{ $loop->iteration }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">
                                            {{ $role->name }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">
                                            {{ $role->permissions->pluck('name')->implode(', ') }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">
                                            {{ \Carbon\Carbon::parse($role->created_at)->format('d M y') }}
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">
                                            @can('edit role')
                                                <a class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-3 rounded focus:outline-none focus:shadow-outline"
                                                    href="{{ route('role.edit', $role->id) }}">Edit</a>
                                            @endcan

                                            @can('delete role')
                                                <a class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-3 rounded focus:outline-none focus:shadow-outline"
                                                    href="javascript:void(0);"
                                                    onclick="confirmDelete({{ $role->id }})">Delete</a>
                                            @endcan

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script>
            function confirmDelete(id) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "get",
                            url: "/role/delete/" + id,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                }).then(() => {
                                    // Reload the page after the success message
                                    window.location.reload();
                                });
                            }
                        });

                    }
                });
            }
        </script>
    </x-slot>
</x-app-layout>
