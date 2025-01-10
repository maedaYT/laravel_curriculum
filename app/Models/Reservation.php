<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['user_id', 'post_id', 'check_in_data', 'check_out_data', 'guest_count'];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
