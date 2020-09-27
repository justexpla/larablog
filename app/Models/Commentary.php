<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentary extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'post_id',
        'parent_id'
    ];

    public function post()
    {
        return $this->BelongsTo(Post::class);
    }

    public function user()
    {
        return $this->BelongsTo(User::class);
    }
}
