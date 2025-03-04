<x-app-layout>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg rounded-4 border-0">
                    @if ($post->photos->isNotEmpty())
                    @foreach($post->photos as $photo)
                        <img src="{{ asset($photo->path) }}" class="card-img-top rounded-top-4 mb-4" alt="{{ $post->title }}" style="object-fit: cover; height: 500px;">
                    @endforeach
                        @endif

                    <div class="card-body p-4">
                        <h2 class="card-title fs-2 fw-bold text-dark">{{ $post->title }}</h2>

                        <p class="text-muted mb-4">
                            <div class="d-flex align-items-center mb-3">
                                Đăng bởi 
                                <img src="{{ $post->user->avatar ? asset($post->user->avatar->path) : asset('avatar/avatar.png') }}" 
                                alt="{{ $post->user->name }}'s Avatar" 
                                class="rounded-circle ms-1" style="width:40px;height:35px">
                                <a href="{{Route('profile_detail',$post->user->id)}}" class="fw-semibold text-decoration-none text-danger me-1">{{ $post->user->name }} </a> 
                                vào <span class="ms-1 fw-medium " style="color: blueviolet">{{ $post->created_at->format('d/m/Y') }}</span>
                            </div>
                        </p>

                        <p class=" card-text fs-5 text-muted">{{ $post->content }}</p>

                        <div class="mt-3">
                            <strong class="text-dark">Tags: </strong>
                            @foreach ($post->tags as $tag)
                                <span class="badge bg-gradient bg-primary px-3 py-2 me-1">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>

                    {{-- Kiểm tra quyền sửa/xóa --}}
                    @if (Auth::check() && (Auth::user()->id === $post->user_id || Auth::user()->role === 'admin'))
                        <div class="card-footer bg-white border-0 p-3 d-flex justify-content-between">
                            <a href="{{Route('edit_post',$post->slug)}}" class="btn btn-warning px-4 py-2 fw-semibold">✏️ Sửa</a>
                            <form action="{{Route('destroy_post',$post->slug)}}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger px-4 py-2 fw-semibold">🗑️ Xóa</button>
                            </form>
                        </div>
                    @endif
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="ps-3 ">
                                <form action="{{ route('like', $post->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn {{ $post->isLikedByUser() ? 'btn-danger' : 'btn-outline-primary' }}">
                                        {{ $post->isLikedByUser() ? '❤️ Bỏ Thích' : '👍 Thích' }} ({{ $post->likes->count() }})
                                    </button>
                                </form>
                            </div>

                                <div class="card-footer text-end bg-white border-0 p-3 ">
                                    @if (Auth::user()->readingListPosts()->where('post_id',$post->id)->exists())
                                        <button class="btn btn-outline-danger px-4 py-2 fw-semibold transition-all" disabled>🕰️ Đã Thêm Vào Đọc Sau</button>
                                    @else
                                        <form action="{{ Route('add_later', $post->id) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-outline-primary px-4 py-2 fw-semibold transition-all">📖 Thêm vào Đọc Sau</button>
                                        </form>
                                    @endif
                                </div>
                                             <div>
                                                 <a href="{{ route('dashboard') }}" class="btn btn-outline-primary  px-4 py-2 fw-semibold transition-all">Quay lại</a>
                                            </div>                           
                                        
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h2 class="mb-4 fs-1">Bình luận</h2>
        
        {{-- Hiển thị danh sách comment --}}
        @if($comments->isEmpty())
            <p class="text-muted fs-6 mb-3">Chưa có bình luận nào.</p>
        @else
            <ul class="list-group mb-4">
                @foreach($comments as $comment)
                    <li class="list-group-item">
                        <div class="d-flex align-items-center mb-2">
                            {{-- Ảnh đại diện của người comment (nếu có) --}}
                            <img src="{{asset($comment->user->avatar ? $comment->user->avatar->path : asset('avatar/avatar.png')) }}" 
                                 alt="{{ $comment->user->name }}" 
                                 class="rounded-circle me-2" style="width:40px;height:35px" >
                            <a href="{{Route('profile_detail',$comment->user->id)}}"><strong>{{ $comment->user->name }}</strong></a>
                            <span class="ms-auto text-muted small">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="d-flex justify-between">
                            <p class="mb-0">{{ $comment->content }}</p>
                            @if (Auth::check() && (Auth::user()->id === $comment->user_id || Auth::user()->role === 'admin'))
                            
                            <form action="{{Route('destroy_comment',$comment->id)}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif

        {{-- Form để thêm comment mới --}}
        <div class="card">
            <div class="card-body">
                <form action="{{Route('store_comment',$post->id)}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="comment-content" class="form-label">Bình luận của bạn</label>
                        <textarea name="content" id="comment-content" rows="3" class="form-control" placeholder="Nhập bình luận..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi bình luận</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <h3 class="text-center text-primary mb-4">Bài viết liên quan</h3>
        <div class="row">
            @foreach ($relatePost as $related)
            <style>
                .car:hover {
                    transform: scale(1.03);
                    transition: all 0.5s ease-out;
                }
            </style>
                <div class="car col-md-4">
                    <a href="{{ route('post_detail', $related->slug) }}">
                        <div class="card shadow-sm">
                            @if ($related->photos->isNotEmpty())
                                <img src="{{ asset($related->photos->first()->path) }}" class="card-img-top" alt="{{ $related->title }}" style="height: 150px; object-fit: cover;">
                                 @endif
                            <div class="card-body">
                                <h5 class=" card-title">
                                    <a href="{{ route('post_detail', $related->slug) }}" class="ca text-decoration-none  hover:text-primary">
                                        {{ Str::limit($related->title, 40) }}
                                    </a>
                                </h5>
                                <p class="text-muted small">{{ Str::limit($related->content, 75) }}</p>
                            </div>
                        </div>

                    </a>
                </div>
            @endforeach
        </div>
    </div>
    
</x-app-layout>
