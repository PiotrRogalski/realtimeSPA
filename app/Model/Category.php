<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function question()
    {
        return $this->hasMany(Question::class);
    }

    public function getPathAttribute()
    {
        return asset("api/category/$this->slug");
    }
}
