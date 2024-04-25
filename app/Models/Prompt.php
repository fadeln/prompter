<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\relations\HasMany;

class Prompt extends Model
{
    use HasFactory;

    protected $fillable = ['prompt', 'user_id','kategori_id'];

    public function image(){
        return $this->morphOne(Image::class,'dapat_digambar');
    }

    public function favorites(){
        return $this->belongsToMany(User::class,'favorit_prompt')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,'prompt_label','prompt_id','label_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'komentar');
    }

    public function likes()
    {
        return $this->morphToMany(User::class, 'dapat_disukai');
    }
}
