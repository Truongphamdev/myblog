<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg rounded-lg overflow-hidden">

                    <div class="bg-primary text-white text-center py-4 position-relative">
                        <h2 class="fw-bold">Hồ Sơ Cá Nhân</h2>
                        <p class="mb-0">Quản lý thông tin và hoạt động của bạn</p>
                    </div>

                    <div class="card-body text-center">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

     
                        <div class="position-relative d-inline-block">
                            <img src="{{ $user->avatar ? asset($user->avatar->path) : asset('avatar/avatar.png') }}"
                                alt="{{ $user->name }}'s Avatar"
                                class="rounded-circle shadow-lg border border-3 border-primary"
                                width="140" height="140"
                                style="object-fit: cover; transition: transform 0.3s;"
                                onmouseover="this.style.transform='scale(1.1)';"
                                onmouseout="this.style.transform='scale(1)';">
                        </div>

                 
                        <h4 class="mt-3 fw-bold text-primary">Tên: {{ $user->name }}</h4>
                        <p class="text-muted">Email: {{ $user->email }}</p>

                    
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="border p-3 rounded shadow-sm bg-light">
                                    <h4 class="fw-bold text-primary">{{ $postCount }}</h4>
                                    <p class="text-muted mb-0">Bài Viết</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border p-3 rounded shadow-sm bg-light">
                                    <h4 class="fw-bold text-danger">{{ $likeCount }}</h4>
                                    <p class="text-muted mb-0">Lượt Thích</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form cập nhật avatar -->
                        @if(Auth::id() === $user->id)
                        <form action="{{ route('avatar') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="avatar" class="form-label fw-bold">Cập Nhật Ảnh Đại Diện:</label>
                                <input type="file" name="avatar" id="avatar" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm">Cập Nhật Ảnh</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
