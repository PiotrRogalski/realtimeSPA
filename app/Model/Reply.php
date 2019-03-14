<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = ['id'];

    protected static function boot() {
        parent::boot();

        static::creating(function($reply) {
           $reply->user_id = auth()->id();
        });
    }

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

    public function getPathAttribute()
    {
        return asset("api/question/".$this->question->slug."/reply/".$this->id);
    }

}
