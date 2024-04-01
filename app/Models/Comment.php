<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    
    protected $fillable = ['user_id','prompt_id','comment'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function prompt(){
        return $this->belongsTo(Prompt::class);
    }
    public function likes()
    {
        return $this->morphToMany(User::class, 'likeable');
    }
}
