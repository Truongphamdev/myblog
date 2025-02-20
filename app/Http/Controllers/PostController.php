<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Photo;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
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
            'title'=>'required|max:255',
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
        $comments = Comment::where('post_id',$post->id)->latest()->get();
        if(!$post){
            return redirect()->route('dashboard')->with('error', 'Bài viết không tồn tại.');
        }
        return view('post.post_detail',compact('post','relatePost','comments'));
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

    // nút like
    public function like($id){
        $existlike = Like::where('user_id',Auth::id())->where('post_id',$id)->first();

        if($existlike){
            $existlike->delete();
            return back()->with('success','Đã Bỏ Like Bài Viết');
        }

        Like::create([
            'user_id'=>Auth::id(),
            'post_id'=>$id
        ]);
        return back()->with('success','Đã Like Bài Viết');
        
    }
    // avatar
    public function avatar(Request $request){
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        $user = Auth::user();
        $existavatar = $user->avatar;
        if ($existavatar) {
            $fileex = public_path($existavatar->path);
            if (file_exists($fileex)) { 
                unlink($fileex);
            }
            $existavatar->delete();
        }
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $namefile = uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('avatar'),$namefile);

            $path = 'avatar/'.$namefile;
            $user->avatar()->create(['path'=>$path]);
        }




        return redirect()->back()->with('success','ảnh đại diện đã được cập nhật');
    }
    // comment
    public function store_comment(Request $request,$id){
        $request->validate([
             'content' => 'required|min:5'
        ]);
        $content = $request->content;
        Comment::create([
            'user_id'=>Auth::id(),
            'post_id'=>$id,
            'content'=>$content
        ]);
        return redirect()->back()->with('success', 'Bình luận đã được gửi!');
    }
    // search
    public function search(Request $request){
        $search = $request->search;
        $result = Post::whereRaw('LOWER(title) LIKE ?', ["%".strtolower($search)."%"])->orwhereRaw('LOWER(content) LIKE ?', ["%".strtolower($search)."%"])->get();
        return view('search.search',compact('result'));

    }
    // profile
    public function show($id=null){
        if(!$id){
            $user=Auth::user();
        }
        else {
            $user = User::findOrFail($id);
        }
        $postCount = $user->posts()->count(); 
        $likeCount = $user->posts()->withCount('likes')->get()->sum('likes_count');
        return view('profile.profile',compact('user','postCount','likeCount'));
    }
}
