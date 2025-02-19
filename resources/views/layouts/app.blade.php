<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>MyBlog</title>
        <link rel="icon" type="image/jpeg" href="{{ asset('anhtn1.jpg') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen ">
            @include('layouts.navigation')

            <!-- Page Heading -->
            {{-- @isset($header)
                
                        {{ $header }}
   
            @endisset --}}

            <!-- Page Content -->
            <main>
                <div class="py-12 mb-3 card" style="background-color: rgb(250, 78, 40)">
                    <div class="d-flex justify-content-between">
                        <div class="ms-20 me-20">
                            <a href="{{Route('dashboard')}}"><button class="btn  {{ request()->routeIs('dashboard') ? 'btn-info' : 'btn-success' }}">Trang Chủ</button></a>
                        </div>
                        <div style="width:70%" class="d-flex justify-content-around">
                            <div>
                                <a   href="{{Route('addpost')}}"><button class="btn {{ request()->routeIs('addpost') ? 'btn-info' : 'btn-success' }}">Thêm Bài Viết</button></a>
                            </div>
                            <div>
                                <a href="{{Route('all_post')}}"><button   class="btn  {{request()->routeIs('all_post') ? 'btn-info' : 'btn-success'}}">Danh Sách Bài Viết</button></a>
                            </div>
                            <div>
                                <form action="">
                                    <input id="search" class="" style="border-radius:10px" placeholder="tìm kiếm" type="text" name="search">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{ $slot }}
            </main>
        </div>
    </body>
    {{-- <script>
        function changeColor(button) {
            // Xóa class 'btn-primary' khỏi tất cả các nút
            document.querySelectorAll('.but').forEach(btn => {
                btn.classList.remove('btn-info');
                btn.classList.add('btn-success'); // Đảm bảo các nút khác giữ màu ban đầu
            });
    
            // Thêm class 'btn-danger' vào nút được nhấn
            button.classList.remove('btn-success');
            button.classList.add('btn-info');
        }
    </script> --}}
    <x-footer/>
</html>
