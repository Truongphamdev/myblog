<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingList extends Model
{
    protected $fillable = ['user_id', 'post_id'];
// App\Models\ReadingListPost.php

public function post()
{
    return $this->belongsTo(Post::class); // Quan hệ bài viết thuộc về ReadingListPost
}

    // Liên kết với người dùng
    public function user() {
        return $this->belongsTo(User::class);
    }
}
