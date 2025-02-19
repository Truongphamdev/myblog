<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\fileExists;

class PostController extends Controller
{
    // lấy 3 bài viết gần nhất
    public function index(){
        $posts = Post::latest()->take(4)->with('photos')->get();
        return view('dashboard',compact('posts'));
    }
    // thêm bài viết
    public function addpost(){
        $tags = Tag::all();
        return view('post.addpost',compact('tags'));
    }
    // lưu trữ bài viết
    public function storepost(Request $request){
        $request->validate([
            'title'=>'required',
            'content'=>'required',
            'tags'=>'required|array',
            'tags.*'=>'exists:tags,id',
            'photos.*'=>'nullable|image|mimes:jpeg,pdf,png,jpg,gif|max:2048'
        ]);
        $user_id = Auth::id();

        $post = new Post([
            'title'=>$request->title,
            'content'=>$request->content,
            'user_id'=>$user_id
        ]);

        $post->save();
        if($request->tags){
            $post->tags()->attach($request->tags);
        }
        if($request->hasFile('images')){
            foreach($request->file('images') as $upload){
                $image_ext = $upload->getClientOriginalExtension();
                $image_name = uniqid().'.'.$image_ext;
                $upload->move(public_path('image/'),$image_name);

                $photo = new Photo([
                    'path'=>'image/'.$image_name
                ]);
                $post->photos()->save($photo);
            }
        }
        
        return redirect()->route('dashboard')->with('success', 'Bài viết đã được tạo!');
    }
    // lấy danh sác bài viết
    public function all_post(){
        $posts = Post::with(['photos','user'])->latest()->paginate(3);
        return view('post.all_post',compact('posts'));
    }
    // bài viết chi tiết
    public function post_detail($slug){
        $post = Post::where('slug',$slug)->with('photos')->firstOrFail();
        $relatePost = Post::where('id','!=',$post->id)->latest()->take(3)->get();
        if(!$post){
            return redirect()->route('dashboard')->with('error', 'Bài viết không tồn tại.');
        }
        return view('post.post_detail',compact('post','relatePost'));
    }
    // update post
    public function edit_post($slug){
        $post = Post::where('slug',$slug)->with('photos')->firstOrFail();
        $tags = Tag::all();
        if(!$post){
            return redirect()->route('dashboard')->with('error', 'Bài viết không tồn tại.');
        }
        return view('post.edit_post',compact('post','tags'));
    }

    public function update_post(Request $request, $slug) {
        $post = Post::where('slug', $slug)->with('photos')->firstOrFail();
    
        // Cập nhật thông tin bài viết
        $slug = Str::slug($request->title);
        $post->title = $request->title;
        $post->slug = $slug;
        $post->content = $request->content;
    
        // Xóa ảnh cũ nếu có ảnh mới
        if ($request->hasFile('images')) {
            foreach ($post->photos as $photo) {
                if (file_exists(public_path($photo->path))) {
                    unlink(public_path($photo->path));
                }
                $photo->delete();
            }
    
            // Lưu ảnh mới
            foreach ($request->file('images') as $upload) {
                $image_ext = $upload->getClientOriginalExtension();
                $image_name = uniqid() . '.' . $image_ext;
                $upload->move(public_path('image/'), $image_name);
    
                // Tạo bản ghi mới trong bảng photos
                $post->photos()->create(['path' =>'image/'.$image_name]);
            }
        }
    
        // Giữ lại ảnh cũ nếu không có ảnh mới
        if ($request->old_photo) {
            foreach ($post->photos as $photo) {
                if (!in_array($photo->path, $request->old_photo)) {
                    if (file_exists(public_path($photo->path))) {
                        unlink(public_path($photo->path));
                    }
                    $photo->delete();
                }
            }
        }
    
        $post->save();
        
        // Cập nhật tags
        $post->tags()->sync($request->tags);
    
        return redirect()->route('post_detail',  $slug);
    }
    // delete
    public function destroy_post($slug){
        $post = Post::where('slug', $slug)->with('photos')->firstOrFail();
        foreach ($post->photos as $photo) {
            $file_path = public_path($photo->path);
    
            if (fileExists($file_path)) {
                unlink($file_path);
            }
            $photo->delete();
        }
        $post->delete();
        return redirect()->route('dashboard');
    }
    
}
