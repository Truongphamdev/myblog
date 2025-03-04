<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
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
    // user
    public function manageUser(){
        $users = User::latest()->get();
        return view('admin.user',compact('users'));
    }
    // remove user
    public function remove_user($id){
        $user = User::findOrFail($id);
        if($user){
            $user->delete();
            return back()->with('success', 'Người dùng đã bị xóa!');
        }
        return back()->with('error', 'không thể xóa');
    }
    // comment
    public function manage_comment(){
        $comments = Comment::latest()->get();
        return view('admin.comment',compact('comments'));
    }

    public function approve_comment($id){
        $comment = Comment::findOrFail($id);
        $comment->status ="approved";
        $comment->save();
        return back()->with('success', 'Bình luận đã được duyệt!');
    }

    public function reject_comment($id){
        $comment = Comment::findOrFail($id);
        $comment->status = 'rejected';
        $comment->save();
        if($comment->status == 'rejected'){
            $comment->delete();
            return back()->with('success', 'Bình luận đã bị xóa!');
        }
        return back()->with('error', 'Chỉ có thể xóa Bình luận bị từ chối.');
    }
}
