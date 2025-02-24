<x-app-layout>
    <x-slot name="header"></x-slot>

    <!-- Thanh điều hướng -->

<hr width="90%" class="ms-20" style="height:3px;background-color: rgb(0, 0, 0);border:none">
<h1 class="fs-3 ms-3 mt-3">Bài Viết Gần Đây</h1>
<div class="py-12 pt-0 ps-20 pe-20">
        @if($posts->isNotEmpty())
       @foreach($posts as $post)
       @include('post.post')
       @endforeach
       @else
       <h1 class="m-3 fs-1">Không có bài viết nào được thêm</h1>
       @endif
    </div>
<hr width="90%" class="ms-20 mb-5" style="height:3px;background-color: rgb(0, 0, 0);border:none">

</x-app-layout>
