<footer class="bg-dark text-white py-5">
    <style>
        .text-secondary:hover{
            color: white !important;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .ic:hover {
            color: rgb(161, 161, 161) !important;
        }
    </style>
    <div class="container">
        <div class="row ms-2">
            <!-- Logo & Giới thiệu -->
            <div class="col-md-3">
                <h3 class="text-uppercase mb-2 fs-2">MyBlog</h3>
                <p class="text-white">
                    Chia sẻ kiến thức, kinh nghiệm lập trình và công nghệ mới nhất. Hãy cùng nhau khám phá thế giới code!
                </p>
            </div>

            <!-- Danh mục nổi bật -->
            <div class="col-md-3">
                <h5 class="text-uppercase mb-2 fs-4">Danh mục</h5>
                <ul class="list-unstyled">
                    <li><a href="" class="text-secondary">Lập trình Web</a></li>
                    <li><a href="" class="text-secondary">Trí tuệ nhân tạo</a></li>
                    <li><a href="" class="text-secondary">Bảo mật</a></li>
                    <li><a href="" class="text-secondary">DevOps</a></li>
                </ul>
            </div>

            <!-- Liên kết nhanh -->
            <div class="col-md-3">
                <h5 class="text-uppercase mb-2 fs-4">Liên kết nhanh</h5>
                <ul class="list-unstyled">
                    <li><a href="" class="text-secondary ">Trang chủ</a></li>
                    <li><a href="" class="text-secondary">Giới thiệu</a></li>
                    <li><a href="" class="text-secondary">Liên hệ</a></li>
                    <li><a href="" class="text-secondary">Chính sách bảo mật</a></li>
                    <li><a href="" class="text-secondary">Điều khoản sử dụng</a></li>
                </ul>
            </div>

            <!-- Bản tin (Newsletter) -->
            <div class="col-md-3">
                <h5 class="text-uppercase mb-2 fs-4">Nhận tin mới</h5>
                <p class="text-white">Đăng ký để nhận các bài viết mới nhất từ chúng tôi.</p>
                <form  method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Nhập email của bạn" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-3">Đăng ký</button>
                </form>
            </div>
        </div>

        <hr class="bg-secondary">

        <!-- Mạng xã hội -->
        <div class="text-center py-3">
            <h5 class="mb-2">Theo dõi chúng tôi</h5>
            <div class="d-flex justify-content-center">
                <a href="#" class="text-white ic mx-2"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="#" class="text-white ic mx-2"><i class="fab fa-twitter fa-2x"></i></a>
                <a href="#" class="text-white ic mx-2"><i class="fab fa-instagram fa-2x"></i></a>
                <a href="#" class="text-white ic mx-2"><i class="fab fa-linkedin fa-2x"></i></a>
                <a href="#" class="text-white ic mx-2"><i class="fab fa-youtube fa-2x"></i></a>
                <a href="#" class="text-white ic mx-2"><i class="fab fa-github fa-2x"></i></a>
            </div>
        </div>

        <hr class="bg-secondary">

        <!-- Bản quyền -->
        <div class="text-center">
            <p class="text-white mb-0 mt-1">&copy; {{ date('Y') }} MyBlog. All rights reserved.</p>
        </div>
    </div>
</footer>
