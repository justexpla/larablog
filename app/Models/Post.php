<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $user_id
 * @property User $user
 *
 * @package App\Models
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'published_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentaries()
    {
        return $this->hasManyThrough(Commentary::class,);
    }
}
