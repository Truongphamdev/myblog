<x-app-layout>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center mb-4">📝 Cập Nhật bài viết</h2>
                    <form action="{{Route('update_post',$post->slug)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-bold">📌 Tiêu đề</label>
                            <input type="text" name="title" class="form-control" value="{{$post->title}}" placeholder="Nhập tiêu đề..." required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">📝 Nội dung</label>
                            <textarea name="content" class="form-control" rows="5"  placeholder="Nhập nội dung..." required>{{$post->content}}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">🏷️ Thẻ tag</label>
                            <select name="tags[]" multiple class="form-select">
                                @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" {{ $post->tags->contains($tag->id) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                                @endforeach
                            </select>
                            
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">🖼 Ảnh bài viết (Chọn nhiều ảnh)</label>
                            <input type="file" name="images[]" multiple class="form-control">
                            @foreach($post->photos as $photo)
                            <img src="{{ asset($photo->path) }}" alt="Ảnh cũ" class="img-thumbnail me-2" width="100">
                                <input type="hidden" name="old_photo[]" value="{{$photo->path}}">
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-danger w-100 mt-3">🚀UPDATE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
