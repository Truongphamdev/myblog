<?php

namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'title', 'content', 'status'
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function($post){
            $post->slug = Str::slug($post->title);
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function readingListUsers(){
        return $this->belongsToMany(User::class, 'reading_lists', 'post_id', 'user_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    public function photos(){
        return $this->morphMany(Photo::class,"photoable");
    }
}
