<div class="container ms-2 mt-5">
    <div class="row w-100">
            <div class="">
                <div class=" card h-100 shadow-sm">
                    @if ($post->photos->isNotEmpty()) 
                    <img style="width:100%;object-fit: cover; height: 600px" src="{{ asset($post->photos->first()->path) }}" class="card-img-top" alt="{{ $post->title }}">
                @endif                

                    <div class="card-body d-flex justify-between">
                        <!-- Tiêu đề bài viết -->
                        <div>
                            <style>
                                .title:hover {
                                    color: red !important;
                                    transition: all 0.2s ease-in-out
                                }
                            </style>
                        <h5 class=" card-title">
                            <a href="" class="title text-decoration-none fs-4 text-dark r">
                               {{$post->title}}
                            </a>
                        </h5>

                        <!-- Mô tả ngắn -->
                        <p class="card-text text-muted">
                            {{ Str::limit($post->content, 100) }}
                           
                        </p>
                                                   
                    </div>
                    <div>
                        <a href="" style="text-decoration:underline;color:red;font-style:italic">{{$post->user->name}}</a>
                        <div>

                            <span class="ms-5" style="font-size: 12px">{{$post->created_at}}</span>
                        </div>
                    </div>
                    </div>
                    <style>
                        .but:hover {
                            background-color: red !important;
                            border-color: red !important;
                            transition: all 0.3s ease
                        }
                    </style>
                    <div class="card-footer bg-white text-end">
                        <a href="{{Route('post_detail',$post->slug)}}" class="btn btn-primary but">Đọc tiếp</a>
                    </div>
                </div>
            </div>
        {{-- @endforeach --}}
    </div>
</div>
