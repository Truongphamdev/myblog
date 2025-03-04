<x-app-layout>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
      <h4 class="mt-4 fs-1 mb-3">Danh sách User</h4>
      <table class="table table-bordered">
          <thead>
              <tr>
                  <th>Số thứ tự</th>
                  <th>Tên</th>
                  <th>Nội dung</th>
                  <th>Trạng thái</th>  
                  <th>Hành động</th>
              </tr>
          </thead>
          <tbody>
            @if($comments->isNotEmpty())
            @foreach ($comments as $key => $comment)
            <tr>
              <td>{{$key + 1}}</td>
              <td>{{$comment->user->name}}</td>
              <td>{{$comment->content}}</td>
              <td>{{$comment->status=='approved' ? "Đã Duyệt" : "Đang Chờ"}}</td>
              <td>
                <div class="d-flex align-center justify-between">
                  <a href="{{Route('profile_detail',$comment->user_id)}}" class="btn btn-primary mr-3">Profile</a>
                  @if ($comment->status !=='approved')
                <a href="{{Route('approve_comment',$comment->id)}}" class="btn btn-warning mr-3">Duyệt</a>
                @endif
                  <a href="{{Route('reject_comment',$comment->id)}}" class="btn btn-danger mr-4">Xóa Comment</a>
                      <form action="{{Route('remove_user',$comment->user_id)}}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này này không?');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-success mr-3">Xóa User</button>
                        </form>
              </div>
              </td>
            </tr>        
            @endforeach
            @else 
            <tr><td colspan='8'>Không người dùng.</td></tr>
            @endif
          </tbody>
      </table>
  </div>
  
  </x-app-layout>