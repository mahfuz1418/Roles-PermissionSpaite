<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Article List') }}
                </h2>
            </div>

            <div>
                @can('create article')
                    <a class="bg-gray-900 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        href="{{ route('article.create') }}">Create Article</a>
                @endcan
            </div>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-3 rounded relative"
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
                                    <th class="py-2 px-4 border-b border-gray-300 text-center text-gray-700">Title
                                    </th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center text-gray-700">Content
                                    </th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center text-gray-700">Author
                                    </th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center text-gray-700">Created At
                                    </th>
                                    <th class="py-2 px-4 border-b border-gray-300 text-center text-gray-700">Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($articles as $article)
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">
                                            {{ $loop->iteration }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">
                                            {{ $article->title }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">
                                            {{ $article->content }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">
                                            {{ $article->author }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">
                                            {{ \Carbon\Carbon::parse($article->created_at)->format('d M y') }}
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-300 text-center">
                                            @can('edit article')
                                                <a class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-3 rounded focus:outline-none focus:shadow-outline"
                                                    href="{{ route('article.edit', $article->id) }}">Edit</a>
                                            @endcan

                                            @can('delete article')
                                                <a class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-3 rounded focus:outline-none focus:shadow-outline"
                                                    href="javascript:void(0);"
                                                    onclick="confirmDelete({{ $article->id }})">Delete</a>
                                            @endcan

                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="4" class="py-2 px-4 border-b border-gray-300 text-center">No
                                            Data Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $articles->links() }}
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
                            url: "/article/delete/" + id,
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
