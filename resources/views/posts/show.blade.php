<x-app-layout>
  <div class="max-w-3xl mx-auto m-10 p-6 bg-white border border-gray-100 rounded-lg shadow-sm">

    <div class="flow-root">
      <dl class="-my-3 divide-y divide-gray-200 text-sm">

        <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
          <dt class="font-bold text-gray-900">ID</dt>
          <dd class="text-gray-700 sm:col-span-2">{{ $post->id }}</dd>
        </div>

        <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
          <dt class="font-bold text-gray-900">Title</dt>
          <dd class="text-gray-700 sm:col-span-2 text-lg font-medium">{{ $post->title }}</dd>
        </div>

        <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
          <dt class="font-bold text-gray-900">Content</dt>
          <dd class="text-gray-700 sm:col-span-2 leading-relaxed">{{ $post->content }}</dd>
        </div>

        <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
          <dt class="font-bold text-gray-900">Author</dt>
          <dd class="text-gray-700 sm:col-span-2">{{ $post->user?->name ?? 'N/A' }}</dd>
        </div>

        <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
          <dt class="font-bold text-gray-900">Created At</dt>
          <dd class="text-gray-700 sm:col-span-2">
            <p class="text-gray-600">{{ $post->created_at->diffForHumans() }}</p>
            <p class="text-sm text-gray-500">{{ $post->created_at->format('l, jS \of F Y') }} at {{ $post->created_at->format('h:i A') }}</p>
          </dd>
        </div>

        <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
          <dt class="font-bold text-gray-1000">Image</dt>
          <dd class="text-gray-700 sm:col-span-2">
            @if ($post->image_path)
              <img src="{{ Storage::url($post->image_path) }}" alt="Post Image" class="w-full rounded-lg shadow-md object-cover max-h-96">
            @else
              <p class="text-gray-500">No image available.</p>
            @endif
          </dd>
        </div>

      </dl>
    </div>

    <div class="mt-8 border-t border-gray-200 pt-6">
      <h2 class="text-xl font-semibold text-gray-900">Comments ({{ $post->comments->count() }})</h2>

      @forelse ($post->comments as $comment)
      <article class="mt-4 rounded-lg border border-gray-200 p-4">
        <div class="flex items-center justify-between gap-3">
          <p class="text-sm font-semibold text-gray-800">{{ $comment->user?->name ?? 'Unknown User' }}</p>
          <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
        </div>
        <p class="mt-2 whitespace-pre-line text-sm text-gray-700">{{ $comment->content }}</p>
      </article>
      @empty
      <p class="mt-3 text-sm text-gray-500">No comments yet. Be the first one to comment.</p>
      @endforelse
    </div>

    <div class="mt-8 border-t border-gray-200 pt-6">
      <h2 class="text-xl font-semibold text-gray-900">Add Comment</h2>

      <form class="mt-4 space-y-4" method="POST" action="{{ route('posts.comments.store', $post->id) }}">
        @csrf

        <div>
          <label for="user_id" class="mb-1 block text-sm font-medium text-gray-700">User</label>
          <select id="user_id" name="user_id" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
            <option value="">Select user</option>
            @foreach ($users as $user)
            <option value="{{ $user->id }}" @selected(old('user_id')==$user->id)>{{ $user->name }}</option>
            @endforeach
          </select>
          @error('user_id')
          <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="content" class="mb-1 block text-sm font-medium text-gray-700">Comment</label>
          <textarea id="content" name="content" rows="4" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Write your comment...">{{ old('content') }}</textarea>
          @error('content')
          <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <button type="submit" class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
          Submit Comment
        </button>
      </form>
    </div>

    <div class="mt-6">
      <a href="/posts" class="text-blue-600 hover:underline text-sm">← Back to Posts</a>
    </div>

  </div>
</x-app-layout>