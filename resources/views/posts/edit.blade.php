<x-app-layout>
    <div class="container mx-auto mt-10 p-4 pb-28 max-w-lg">

        <h2 class="text-xl font-semibold text-gray-800 mb-6">Edit Post</h2>

        @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-md">
            <ul class="list-disc list-inside text-red-600 text-sm">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(request('updated'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-md">
            <p class="text-green-600 text-sm">Post updated successfully!</p>
        </div>
        @endif

        <form action="/posts/{{$post->id}}" method="POST" class="space-y-5" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700" for="title">Title</label>
                <input
                    name="title"
                    id="title"
                    type="text"
                    value="{{old('title', $post->title)}}"
                    class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm focus:border-gray-400 focus:ring-0 outline-none p-2 border @error('title') border-red-500 @enderror">
                @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700" for="content">Content</label>
                <textarea
                    name="content"
                    id="content"
                    rows="4"
                    class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm focus:border-gray-400 focus:ring-0 outline-none p-2 border resize-none @error('content') border-red-500 @enderror">{{old('content', $post->content)}}</textarea>
                @error('content')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700" for="user_id">Author</label>
                <select name="user_id" id="user_id" class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm focus:border-gray-400 focus:ring-0 outline-none p-2 border @error('user_id') border-red-500 @enderror">
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $post->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                    @endforeach
                </select>
                @error('user_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700" for="image">Image (Optional)</label>
                @if ($post->image_path)
                <div class="mb-3">
                    <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                    <img src="{{ Storage::url($post->image_path) }}" alt="Current Post Image" class="max-w-xs rounded-md border border-gray-200">
                </div>
                @endif
                <input type="file" name="image" id="image" accept="image/*" class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm focus:border-gray-400 focus:ring-0 outline-none p-2 border @error('image') border-red-500 @enderror">
                @error('image')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between gap-4">
                <div class="mt-6">
                    <a href="/posts" class="text-blue-600 hover:underline text-sm">← Back to Posts</a>
                </div>
                <button
                    type="submit"
                    class="inline-block rounded-md border border-gray-800 bg-gray-800 px-8 py-2 text-sm font-medium text-white transition hover:bg-transparent hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-400">
                    Update Post
                </button>
            </div>
        </form>
    </div>
</x-app-layout>