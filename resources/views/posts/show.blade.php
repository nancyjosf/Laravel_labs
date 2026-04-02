<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<div class="max-w-3xl mx-auto m-10 p-6 bg-white border border-gray-100 rounded-lg shadow-sm">
  
  <div class="flow-root">
    <dl class="-my-3 divide-y divide-gray-200 text-sm">
      
      <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
        <dt class="font-bold text-gray-900">ID</dt>
        <dd class="text-gray-700 sm:col-span-2">{{ $post['id'] }}</dd>
      </div>

      <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
        <dt class="font-bold text-gray-900">Title</dt>
        <dd class="text-gray-700 sm:col-span-2 text-lg font-medium">{{ $post['title'] }}</dd>
      </div>

      <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3 sm:gap-4">
        <dt class="font-bold text-gray-900">Content</dt>
        <dd class="text-gray-700 sm:col-span-2 leading-relaxed">{{ $post['content'] }}</dd>
      </div>

    </dl>
  </div>

  <div class="mt-6">
    <a href="/posts" class="text-blue-600 hover:underline text-sm">← Back to Posts</a>
  </div>

</div>