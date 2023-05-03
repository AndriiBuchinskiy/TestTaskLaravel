<?php

namespace App\Models;

use App\Policies\PostPolicy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $fillable = [
        'title',
        'content',
        'category_id',
        'img_path',
        'user_id',


    ];
    public function getImagePath(): Attribute
    {
        return Attribute::make(
            get: fn () => url('storage/app/'.$this->img_path)
        );
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];



    public function tags()
    {
        return $this->belongsToMany(Tag::class);
        //return $this->hasMany(Tag::class, 'id');
    }
    public function tagsp()
    {
        return $this->hasMany(Tag::class, 'id');
    }
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }


}
