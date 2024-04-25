<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function comments(){
        return $this->hasMany(Comment::class, 'komentar');
    }

    public function image(){
        return $this->morphOne(Image::class,'gambar');
    }

    public function favorites(){
        return $this->belongsToMany(Prompt::class,'favorit_prompt')->withTimestamps();
    }
    
    public function isFavorited(Prompt $prompt){
        return $this->favorites()->where('prompt_id',$prompt->id)->exists();
    }

    public function prompt()
    {
        return $this->hasMany(Prompt::class);
    }
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Morph relationship
    public function likePrompts()
    {
        return $this->morphToMany(User::class, 'dapat_disukai', 'dapat_disukai', 'dapat_disukai_id', 'user_id');
    }
 

    public function likeComments()
    {
        return $this->morphedByMany(Comment::class, 'dapat_disukai','dapat_disukai_id');
    }
    public function isLikedPrompt(Prompt $prompt)
    {
        return $this->likePrompts()->where('yang_dapat_disukai_id', $prompt->id)
        ->where('dapat_disukai_type', get_class($prompt))
        ->exists();
    }

    public function isLikedComment(Comment $comment)
    {
        return $this->likeComments()->where('dapat_disukai_id', $comment->id)
                                    ->where('dapat_disukai_type', get_class($comment))
                                    ->exists();
    }
}
