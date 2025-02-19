<x-app-layout>
<hr width="90%" class="ms-20" style="height:3px;background-color: rgb(0, 0, 0);border:none">

    <div class="containeer ms-4 me-4 mb-5">
        <h1 class="fs-2 m-4 mb-5">Tất Cả Bài Viết</h1>

        <div class="row">
            @foreach ($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if ($post->photos->isNotEmpty()) 
                        <img src="{{ asset($post->photos->first()->path) }}" style="width:100%;height:300px" class="card-img-top" alt="{{ $post->title }}">
                    @endif                
                    <div class="card-body">
                        <p style="color: blueviolet" class="small mb-3 ">{{$post->created_at->format('d/m/Y')}}</p>
                        <h5 class="card-title">
                            <a href="" class="text-decoration-none fs-4 text-dark">
                               {{$post->title}}
                            </a>
                        </h5>
    
                        <p class="card-text text-muted">
                            {{ Str::limit($post->content, 100) }}
                        </p>    
    
                       
                        
                    </div>
    
                    <div class="card-footer  bg-white text-end">
                        <a href="" class="btn btn-danger">Đọc tiếp</a>
                    </div>
                </div>
            </div>
            
            @endforeach
<!-- Hiển thị phân trang -->
<div class="d-flex justify-content-center mt-4">
    {{ $posts->links('pagination::bootstrap-5') }}
</div>
        </div>
    </div>
<hr width="90%" class="ms-20 mb-5" style="height:3px;background-color: rgb(0, 0, 0);border:none">

</x-app-layout>
