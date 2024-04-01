<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\relations\HasMany;

class Prompt extends Model
{
    use HasFactory;

    protected $fillable = ['prompt', 'user_id','category_id'];

    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }

    public function favorites(){
        return $this->belongsToMany(User::class,'favorite_prompt')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,'prompt_tag');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->morphToMany(User::class, 'likeable');
    }
}
