<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * @const int
     */
    const ROLE_ADMIN_ID = 1;

    /**
     * @const int
     */
    const ROLE_MODERATOR_ID = 2;

    /**
     * @const int
     */
    const ROLE_USER_ID = 3;

    /**
     * @const int
     */
    const ROLE_BANNED_ID = 4;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
