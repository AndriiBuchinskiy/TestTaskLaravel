<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasFactory;
    use HasApiTokens;
    protected $fillable = [
        "id",
            "name",
            "email",
            "phone",
            "position",
            "position_id",
            "registration_timestamp",
            "photo"
    ];
    protected $hidden = [
        'remember_token',
    ];

    public $timestamps = false;

    public function position()
    {
        return $this->belongsTo(Position::class,'positions');
    }
}
