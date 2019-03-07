<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
