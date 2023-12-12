<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'position',
        'position_id',
        'photo',
    ];

    public $timestamps = false;

    public function position()
    {
        return $this->belongsTo(Position::class,'positions');
    }
}
