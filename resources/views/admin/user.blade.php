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
                  <th>Email</th>
                  <th>Avatar</th>  
                  <th>Hành động</th>
              </tr>
          </thead>
          <tbody>
            @if($users->isNotEmpty())
            @foreach ($users as $key => $user)
            <tr>
              <td>{{$key + 1}}</td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td><img src="{{isset($user->avatar->path) ? asset($user->avatar->path) : asset('avatar/avatar.png')}}" alt='Ảnh bài đăng' class="img-thumbnail" style='width: 40px; height: 40px;'></td>
              <td>
                <div class="d-flex ">
                  <a href="{{Route('profile_detail',$user->id)}}" class="btn btn-primary mr-3">Xem</a>
                  <form action="{{Route('remove_user',$user->id)}}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này này không?');">
                      @csrf
                    @method('DELETE')
                      <button type="submit" class="btn btn-danger mr-3">Xóa</button>
                    </form>
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