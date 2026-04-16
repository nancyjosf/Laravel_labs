<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<div class="container mx-auto mt-10 p-4 pb-40 max-w-lg min-h-screen">

    <h2 class="text-xl font-semibold text-gray-800 mb-6">Create New Post</h2>

    @if ($errors->any())
    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-md">
        <ul class="list-disc list-inside text-red-600 text-sm">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="/posts" method="POST" class="space-y-5">
        @csrf
        
        <div>
            <label class="block text-sm font-medium text-gray-700" for="title">Title</label>
            <input
                name="title"
                id="title"
                type="text"
                placeholder="Post title"
                value="{{ old('title') }}"
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
                placeholder="Write your content here..."
                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm focus:border-gray-400 focus:ring-0 outline-none p-2 border resize-none @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
            @error('content')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

       <div class="relative">
    <label class="block text-sm font-medium text-gray-700" for="user_id">Author</label>
    
    <select 
        name="user_id" 
        id="user_id" 
        onfocus='this.size=5;' 
        onblur='this.size=1;' 
        onchange='this.size=1; this.blur();'
        class="absolute z-50 mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-lg focus:border-gray-400 focus:ring-0 outline-none p-2 border @error('user_id') border-red-500 @enderror cursor-pointer">
        
        <option value="" disabled {{ old('user_id') ? '' : 'selected' }}>Select an author</option>
        @foreach ($users as $user)
        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
            {{ $user->name }}
        </option>
        @endforeach
    </select>
    
    <div class="h-10"></div> 

    @error('user_id')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

        <div class="flex items-center justify-between gap-4 pt-4">
            <div>
                <a href="/posts" class="text-blue-600 hover:underline text-sm">← Back to Posts</a>
            </div>
            <button
                type="submit"
                class="inline-block rounded-md border border-gray-800 bg-gray-800 px-8 py-2 text-sm font-medium text-white transition hover:bg-transparent hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-400 cursor-pointer">
                Add Post
            </button>
        </div>
    </form>
</div>