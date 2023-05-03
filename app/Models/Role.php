<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $guarded = false;
    protected $fillable = ['name'];
    public $timestamps = false;

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }


    /**
     * Связь модели Role с моделью Usrer, позволяет получить
     * всех пользователей с этой ролью
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }



    public const IS_ADMIN = 1;
    public const IS_MANAGER = 2;
    public const IS_USER = 3;
}


