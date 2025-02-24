<x-app-layout>
  @if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
  @endif
    <h4 class="mt-4 fs-1 mb-3">Danh sách Bài đăng</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã Post</th>
                <th>Tiêu đề</th>
                <th>Ngày tạo</th>
                <th>Tác giả</th>
                <th>Ảnh</th>  
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
          @if($posts->isNotEmpty())
          @foreach ($posts as $post)
          <tr>
            <td>{{$post->id}}</td>
            <td>{{$post->title}}</td>
            <td>{{$post->created_at}}</td>
            <td>{{$post->user->name}}</td>
            <td><img src="{{asset($post->photos->first()->path)}}" alt='Ảnh bài đăng' class="img-thumbnail" style='width: 40px; height: 40px;'></td>
            <td>{{$post->status=='approved' ? "Đã Duyệt" : "Đang Chờ"}}</td>
            <td>
              <div class="d-flex ">
                <a href="{{Route('post_detail',$post->slug)}}" class="btn btn-primary mr-3">Xem</a>
                @if ($post->status !=='approved')
                <a href="{{Route('approve',$post->id)}}" class="btn btn-warning mr-3">Duyệt</a>
                @endif
                  <a href="{{Route('reject',$post->id)}}" class="btn btn-danger">Xóa</a>
              </div>
            </td>
          </tr>        
          @endforeach
          @else 
          <tr><td colspan='8'>Không có bài đăng nào.</td></tr>
          @endif
        </tbody>
    </table>
</div>

</x-app-layout>