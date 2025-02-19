<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReadLaterController extends Controller
{
    public function add_later($postId){
        $user = Auth::user();
        if (!$user->readingListPosts->contains('post_id', $postId)) {
            // Nếu chưa có, thêm bài viết vào danh sách
            $user->readingListPosts()->attach($postId);
            return redirect()->back()->with('success', 'Đã thêm vào danh sách đọc sau!');
        } else {
            // Nếu bài viết đã có trong danh sách
            return redirect()->back()->with('info', 'Bài viết đã có trong danh sách đọc sau!');
        }
    }
    public function remove_later($postId)
    {
        $user = Auth::user();
    
        // Kiểm tra xem bài viết có trong danh sách đọc sau không
        if ($user->readingListPosts()->where('post_id', $postId)->exists()) {
            $user->readingListPosts()->detach($postId);
            return redirect()->back()->with('success', 'Đã xóa khỏi danh sách đọc sau!');
        }
    
        return redirect()->back()->with('error', 'Không tìm thấy bài viết trong danh sách đọc sau.');
    }
    
    // Hiển thị danh sách các bài viết trong danh sách đọc sau
    public function index()
    {
        $user = Auth::user();
    
        // Eager load bài viết trong danh sách đọc sau
        $readingList = $user->readingListPosts()->with('post')->get(); 

        return view('readlater.index', compact('readingList'));
    }
}
