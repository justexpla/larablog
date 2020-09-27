<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentary extends Model
{
    use HasFactory;

    public function post()
    {
        return $this->BelongsTo(Post::class);
    }

    public function user()
    {
        return $this->BelongsTo(User::class);
    }
}
