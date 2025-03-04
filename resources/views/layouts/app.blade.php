<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>MyBlog</title>
        <link rel="icon"  type="image/jpeg" href="{{ asset('image/goku2.png') }}">

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
            {{-- <div id="loading">
                <img src="{{ asset('image/giphy.gif') }}" alt="Loading..." />
            </div>
            <style>

                #loading {
                    position: fixed;
                    width: 100%;
                    height: 100%;
                    background:transparent;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    top: 0;
                    left: 0;
                    z-index: 9999;
                }
                </style>
                <script>
                    window.onload = function() {
                        setTimeout(function() {
                            document.getElementById("loading").style.display = "none";
                        }, 1000); // Ẩn sau 1 giây
                    };
                </script> --}}
                
            
            <main>
                <div class="py-12 mb-3 card" style="background-color: rgb(255, 90, 30)">
                    <div class="d-flex justify-content-between">
                        <div class="ms-20 me-20">
                            <a href="{{Route('dashboard')}}"><button class="btn  {{ request()->routeIs('dashboard') ? 'btn-light' : 'btn-info' }}">Trang Chủ</button></a>
                        </div>
                        <div style="width:70%" class="d-flex justify-content-around">
                            <div>
                                <a   href="{{Route('addpost')}}"><button class="btn {{ request()->routeIs('addpost') ? 'btn-light' : 'btn-info' }}">Thêm Bài Viết</button></a>
                            </div>
                            
                            <div>
                                <a href="{{Route('all_post')}}"><button   class="btn  {{request()->routeIs('all_post') ? 'btn-light' : 'btn-info'}}">Danh Sách Bài Viết</button></a>
                            </div>
                            <div>
                                <a href="{{Route('read_later_list')}}"><button   class="btn  {{request()->routeIs('read_later_list') ? 'btn-light' : 'btn-info'}}">Danh Sách Đọc Sau</button></a>
                            </div>
                            @if (Auth::check() && Auth::user()->role === 'admin')
                            <div class="dropdown">
                                <button class="btn btn-info dropdown-toggle" type="button" id="adminDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Quản Lý Admin
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('admin') ? 'active' : '' }}" href="{{ route('admin') }}">
                                            Quản Lý Post
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('admin_user') ? 'active' : '' }}" href="{{ route('admin_user') }}">
                                            Quản Lý User
                                        </a>
                                    </li>
                                    <!-- Nếu bạn muốn thay cái thứ 3, thay link và tên tại đây -->
                                    <li>
                                        <a class="dropdown-item {{ request()->routeIs('manage_comment') ? 'active' : '' }}" href="{{ route('manage_comment') }}">
                                            Quản Lý Comment
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                            <div>
                                <form action="{{Route('search')}}" method="GET">
                                    <input id="search" class="" style="border-radius:10px" placeholder="tìm kiếm" type="text" value="{{request('search')}}" name="search">
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
