<x-app-layout>
    <div class="container mt-5">
        <h2 class="mb-4">📚 Danh sách đọc sau</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if($readingList->isEmpty())
            <p class="text-muted">Chưa có bài viết nào trong danh sách đọc sau.</p>
        @else
            <ul class="list-group">
                @foreach($readingList as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    @if($item) <!-- Kiểm tra nếu bài viết tồn tại -->
                        <a href="{{ route('post_detail', $item->slug) }}">{{ $item->title }}</a>
                    @else
                        <span>Bài viết không tồn tại</span> <!-- Thông báo nếu bài viết không tồn tại -->
                    @endif
                    <form action="{{ route('remove_later', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </li>
            @endforeach
            
            </ul>
        @endif
    </div>
</x-app-layout>
