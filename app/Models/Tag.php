<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public static function createNew($data)
    {
        return static::create($data);
    }

    public static function updateById($id, $data)
    {
        $tag = static::find($id);
        $tag->update($data);
        return $tag;
    }

    public static function deleteById($id)
    {
        static::destroy($id);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'post_tag','tag_id','post_id');
    }
}
