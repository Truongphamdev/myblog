<x-app-layout>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center mb-4">📝 Đăng bài viết</h2>
                    <form action="{{Route('storepost')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">📌 Tiêu đề</label>
                            <input type="text" name="title" class="form-control" placeholder="Nhập tiêu đề..." required>
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">📝 Nội dung</label>
                            <textarea name="content" class="form-control" rows="5" placeholder="Nhập nội dung..." required></textarea>
                            @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">🏷️ Thẻ tag</label>
                            <select name="tags[]" multiple class="form-select">
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            @error('tags')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">🖼 Ảnh bài viết (Chọn nhiều ảnh)</label>
                            <input type="file" name="images[]" multiple class="form-control @error('images') is-invalid @enderror">
                            @error('images')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            @error('images.*')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-3">🚀 Đăng bài</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
