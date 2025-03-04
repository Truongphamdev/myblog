<div class="container ms-2 mt-5 card">
    <div class="row w-100 ">
        <div class="col-md-6 mt-3 mb-3"> 
            <div class="card h-100 shadow-sm">
                @if ($post->photos->isNotEmpty()) 
                    <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset($post->photos->first()->path) }}" class="card-img-top" alt="{{ $post->title }}">
                @endif
            </div>
        </div>

        <div class="col-md-6 d-flex flex-column justify-content-between"> 
            <div class="card-body">
                <style>
                    .title:hover {
                        color: red !important;
                        transition: all 0.2s ease-in-out;
                    }
                </style>
                <h5 class="card-title">
                    <a href="{{Route('post_detail',$post->slug)}}" class="title text-decoration-none fs-2 text-dark">
                        {{$post->title}}
                    </a>
                </h5>
                <p class="card-text text-muted">
                    {{ Str::limit($post->content, 1060) }}
                </p>
                <div class="d-flex justify-between mt-2">
                <div class="d-flex justify-content-end">
                    <img src="{{ $post->user->avatar ? asset($post->user->avatar->path) : asset('avatar/avatar.png') }}" 
                        alt="{{ $post->user->name }}'s Avatar" 
                        class="rounded-circle me-2" style="width: 40px; height: 35px;">
                    <a href="{{Route('profile_detail',$post->user->id)}}" style="text-decoration: underline; color: red; font-style: italic">
                        {{$post->user->name}}
                    </a>
                </div>
                <span class="text-primary " style="font-size: 12px">{{$post->created_at->format('d/m/Y')}}</span>
                    
            </div>
            </div>

            <div class="card-footer bg-white text-end">
                <a href="{{Route('post_detail',$post->slug)}}" class="btn btn-primary but">Đọc tiếp</a>
            </div>
        </div>
    </div>
</div>

<style>
    .but:hover {
        background-color: red !important;
        border-color: red !important;
        transition: all 0.3s ease;
    }
</style>
