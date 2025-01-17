<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['user_id', 'post_id', 'check_in_date', 'check_out_date', 'guest_count'];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
