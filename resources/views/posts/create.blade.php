<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<div class="container mx-auto mt-10 p-4 max-w-lg">

    <h2 class="text-xl font-semibold text-gray-800 mb-6">Create New Post</h2>

    <form action="/posts" method="POST" class="space-y-5">
    @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700" for="title">Title</label>
            <input
                name="title"
                id="title"
                type="text"
                placeholder="Post title"
                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm focus:border-gray-400 focus:ring-0 outline-none p-2 border">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700" for="content">Content</label>
            <textarea
                name="content"
                id="content"
                rows="4"
                placeholder="Write your content here..."
                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm focus:border-gray-400 focus:ring-0 outline-none p-2 border resize-none"></textarea>
        </div>

        <div class="flex items-center justify-between gap-4">

            <div class="mt-6">
                <a href="/posts" class="text-blue-600 hover:underline text-sm">← Back to Posts</a>
            </div>
            <button
                type="submit"
                class="inline-block rounded-md border border-gray-800 bg-gray-800 px-8 py-2 text-sm font-medium text-white transition hover:bg-transparent hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-400">
                Add Post
            </button>
        </div>
    </form>
</div>