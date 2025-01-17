<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'title', 'check_in_date', 'check_out_date', 'guest_count', 'price', 'image', 'address', 'comment', 'reports_count',
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'reports_count' => 'integer',
    ];

    /**
     * リレーション: 投稿の作成者を取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
