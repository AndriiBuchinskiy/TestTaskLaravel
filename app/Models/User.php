<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'amount',
        'avatar',
    ];
    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany(Product::class,'user_products');
    }
}
