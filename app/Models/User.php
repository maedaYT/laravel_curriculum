<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class User extends Authenticatable
{
    use Notifiable, softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image', 'role', 'last_access_at', 'last_post_at', 'suspended_posts_count',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_access_at' => 'datetime',
        'last_post_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    /**
     * リレーション:　ユーザーの投稿を取得
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}

