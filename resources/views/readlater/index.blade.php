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
                @foreach($readingList as $post)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    @if($post) <!-- Kiểm tra nếu bài viết tồn tại -->
                        <div class="d-flex justify-center align-items-center">
                               
                        <img class="img-thumbnail" style="width:100px;height:70px;object-fit: cover" src="{{asset($post->photos->first()->path)}}" alt="{{$post->title}}" srcset="">
                        <div class="ms-3">
                            <style>
                                .hover-danger:hover{
                                    color: red !important;
                                    transition: all 0.5s ease;
                                }
                            </style>
                            <a class="hover-danger fs-5" style="" href="{{ route('post_detail', $post->slug) }}">{{ $post->title }}</a>
                            </div>       
                        </div>
                    @else
                        <span>Bài viết không tồn tại</span> <!-- Thông báo nếu bài viết không tồn tại -->
                    @endif
                    <form action="{{ route('remove_later', $post->id) }}" method="POST">
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
