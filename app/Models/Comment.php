<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['сontent'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function validateComment($request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);
    }
}
