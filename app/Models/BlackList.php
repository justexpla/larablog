<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlackList extends Model
{
    protected $table = 'user_blacklist';

    protected $fillable = [
        'user_id',
        'banned_id'
    ];
}
