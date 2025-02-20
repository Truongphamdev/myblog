<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 dark:text-gray-200 mb-6">
            🔍 Kết Quả Tìm Kiếm
        </h1>

        @if($result->isEmpty())
            <p class="text-center text-gray-500 dark:text-gray-400 text-lg">
                Không tìm thấy bài viết nào. Hãy thử tìm kiếm với từ khóa khác!
            </p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($result as $post)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 transition-transform hover:scale-105">
                        @include('post.post')
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
