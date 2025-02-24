<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $posts = Post::latest()->get();
        return view('admin.admin',compact('posts'));
    }
    public function approve($id){
        $post = Post::findOrFail($id);
        $post->status ="approved";
        $post->save();
        return back()->with('success', 'Bài viết đã được duyệt!');
    }
    public function reject($id){
        $post = Post::findOrFail($id);
        $post->status = 'rejected';
        $post->save();
        if($post->status == 'rejected'){
            $post->delete();
            return back()->with('success', 'Bài viết đã bị xóa!');
        }
        return back()->with('error', 'Chỉ có thể xóa bài viết bị từ chối.');
    }
}
