<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'komentar';

    use HasFactory;
    
    protected $fillable = ['user_id','prompt_id','komentar'];

    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }

    public function prompt(){
        return $this->belongsTo(Prompt::class,'prompt_id');
    }
    public function likes()
    {
        return $this->morphToMany(User::class, 'dapat_disukai','dapat_disukai','yang_dapat_disukai_id', 'user_id');
    }
}
