<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'likes_count',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'likes_count' => 'integer',
    ];

    // relationship to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
