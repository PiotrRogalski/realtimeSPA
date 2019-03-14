<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Str;

class Question extends Model
{
    protected static function boot() {
        parent::boot();

        static::creating(function ($question) {
            $question->slug = Str::slug($question->title);
        });
    }


    protected $fillable = ['title','slug','body','category_id','user_id'];


    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string {
        return 'slug';
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function replies() {
        return $this->hasMany(Reply::class);
    }

    public function getPathAttribute() {
        return "question/$this->slug";
    }

    public function getRepliesNumber(): int {
        return count($this->replies);
    }

//    public function setSlugAttribute()
//    {
//        $this->attributes['slug'] = Str::slug($this->attributes['title']);
//    }


}
