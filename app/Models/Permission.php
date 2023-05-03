<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    protected $guarded = false;

    protected $fillable = [
        'name',
        'description',
    ];
    public function roles() {
        return $this->belongsToMany(Role::class, 'permission_role');
    }
    /**
     * Связь модели Permission с моделью User, позволяет получить
     * всех пользователей с этим правом
     */
    public function users() {
        return $this
            ->belongsToMany(User::class,'permission_role')
            ->withTimestamps();
    }
}
