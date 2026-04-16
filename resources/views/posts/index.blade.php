<x-app-layout>

@if(request('updated'))
<div class="m-5 p-4 bg-green-50 border border-green-200 rounded-md">
    <p class="text-green-600 text-sm">Post updated successfully!</p>
</div>
@endif

@if(request()->has('deleted'))
<div class="m-5 p-4 bg-green-50 border border-green-200 rounded-md">
    <p class="text-green-600 text-sm">Post deleted successfully!</p>
</div>
@endif

@if(request('created'))
<div class="m-5 p-4 bg-green-50 border border-green-200 rounded-md">
    <p class="text-green-600 text-sm">Post created successfully!</p>
</div>
@endif

@if(request('restored'))
<div class="m-5 p-4 bg-green-50 border border-green-200 rounded-md">
    <p class="text-green-600 text-sm">Post restored successfully!</p>
</div>
@endif

@if(request('force_deleted'))
<div class="m-5 p-4 bg-green-50 border border-green-200 rounded-md">
    <p class="text-green-600 text-sm">Post permanently deleted successfully!</p>
</div>
@endif

<div class="overflow-x-auto p-5">
    <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
        <thead class="ltr:text-left rtl:text-right">
            <tr>
                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Title</th>
                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Content</th>
                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Author</th>
                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Created At</th>
                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
            @foreach ($posts as $post)
            <tr>
                <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $post->title }}</td>
                <td class="px-4 py-2 text-gray-700">{{ Str::limit($post->content, 50) }}</td>
                <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $post->user?->name ?? 'N/A' }}</td>
                <td class="px-4 py-2 text-gray-700 whitespace-nowrap">
                    <span title="{{ $post->created_at->format('d M Y, h:i A') }}">
                        {{ $post->created_at->format('d/m/Y') }}
                    </span>
                </td>
                <td class="px-4 py-2 whitespace-nowrap">
                    @if(!$post->trashed())
                    <div class="inline-flex rounded-md shadow-sm gap-1">
                        <a href="/posts/{{ $post->id }}" class="border border-gray-200 px-3 py-1 text-xs font-medium text-gray-700 hover:bg-gray-50 hover:text-blue-600">
                            View
                        </a>
                        <a href="/posts/{{ $post->id }}/edit" class="border border-gray-200 px-3 py-1 text-xs font-medium text-gray-700 hover:bg-gray-50 hover:text-green-600">
                            Edit
                        </a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="border border-gray-200 px-3 py-1 text-xs font-medium text-gray-700 hover:bg-gray-50 hover:text-red-600">
                                Delete
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="inline-flex items-center gap-2">
                        <form action="{{ route('posts.restore', $post->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="border border-green-500 bg-green-50 px-3 py-1 text-xs font-medium text-green-700 hover:bg-green-100">
                                Restore
                            </button>
                        </form>
                        <form action="{{ route('posts.forceDelete', $post->id) }}" method="POST" class="inline" onsubmit="return confirm('This will permanently delete the post. Continue?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="border border-red-500 bg-red-50 px-3 py-1 text-xs font-medium text-red-700 hover:bg-red-100">
                                Delete Permanently
                            </button>
                        </form>
                    </div>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-6 flex justify-between items-center">
        <div>
            <p class="text-sm text-gray-600">
                Showing <span class="font-semibold">{{ ($posts->currentPage() - 1) * $posts->perPage() + 1 }}</span>
                to <span class="font-semibold">{{ min($posts->currentPage() * $posts->perPage(), $posts->total()) }}</span>
                of <span class="font-semibold">{{ $posts->total() }}</span> posts
            </p>
        </div>
        <div class="text-center my-10">
            <a href="{{ route('posts.create') }}" class="inline-block rounded-md border border-gray-800 bg-gray-800 px-8 py-2 text-sm font-medium text-white transition hover:bg-transparent hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-400">
                Add Post
            </a>
        </div>
    </div>

    <!-- Pagination Links -->
    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
</x-app-layout>
