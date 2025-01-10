<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['user_id', 'post_id', 'reason'];

    public function post() 
    {
        return $this->belongsTo(Post::class);
    }
}
