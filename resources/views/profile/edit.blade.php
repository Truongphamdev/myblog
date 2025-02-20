<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg p-4 rounded-lg">
                    <div class="text-center">
                        <h2 class="font-weight-bold text-primary">Hồ Sơ Cá Nhân</h2>
                        <p class="text-muted">Cập nhật thông tin cá nhân của bạn</p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @php
                        $user = Auth::user();
                    @endphp

                    <div class="text-center">
                        <img src="{{ $user->avatar ? asset($user->avatar->path) : asset('avatar/avatar.png') }}"
                            alt="{{ $user->name }}'s Avatar"
                            class="rounded-circle shadow" width="120" height="120">
                        
                        <h4 class="mt-3">{{ $user->name }}</h4>
                        <p class="text-muted">{{ $user->email }}</p>
                    </div>

                    <form action="{{ route('avatar') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="avatar" class="form-label fw-bold">Chọn ảnh đại diện:</label>
                            <input type="file" name="avatar" id="avatar" class="form-control">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Cập Nhật Ảnh</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
