<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

@if(request('updated'))
<script>
    alert("Post updated successfully!");
</script>
@endif

@if(request()->has('success'))
<script>
    alert("Post Deleted Successfully!");
</script>
@endif

@if(request('created'))
<script>
    alert("Post created successfully!");
</script>
@endif

<div class="overflow-x-auto p-5">
    <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
        <thead class="ltr:text-left rtl:text-right">
            <tr>
                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">ID</th>
                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Title</th>
                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Content</th>
                <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
            @foreach ($posts as $post)
            <tr>
                <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">{{ $post['id'] }}</td>
                <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $post['title'] }}</td>
                <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $post['content'] }}</td>
                <td class="px-4 py-2 whitespace-nowrap">
                    <div class="inline-flex rounded-md shadow-sm">
                        <button class="border border-gray-200 px-3 py-1 text-xs font-medium text-gray-700 hover:bg-gray-50 hover:text-blue-600 focus:relative">
                            <a href="/posts/{{ $post['id'] }}">View</a>
                        </button>
                        <button class="-ms-px border border-gray-200 px-3 py-1 text-xs font-medium text-gray-700 hover:bg-gray-50 hover:text-green-600 focus:relative">
                            <a href="/posts/{{ $post['id'] }}/edit">Edit</a>
                        </button>
                        <form action="/posts/{{ $post['id'] }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="-ms-px border border-gray-200 px-3 py-1 text-xs font-medium text-gray-700 hover:bg-gray-50 hover:text-red-600 focus:relative">
                                Delete
                            </button>
                        </form>
                       
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
    <div class="text-center my-10">
        <a href="/posts/create" class="inline-block rounded-md border border-gray-800 bg-gray-800 px-8 py-2 text-sm font-medium text-white transition hover:bg-transparent hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-400">
            Add Post
        </a>
    </div>

