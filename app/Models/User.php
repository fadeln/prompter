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
        return $this->hasMany(Comment::class);
    }

    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }

    public function favorites(){
        return $this->belongsToMany(Prompt::class,'favorite_prompt')->withTimestamps();
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
        return $this->morphedByMany(Prompt::class, 'likeable');
    }
 

    public function likeComments()
    {
        return $this->morphedByMany(Comment::class, 'likeable');
    }
    public function isLikedPrompt(Prompt $prompt)
    {
        return $this->likePrompts()->where('likeable_id', $prompt->id)
                                   ->where('likeable_type', get_class($prompt))
                                   ->exists();
    }

    public function isLikedComment(Comment $comment)
    {
        return $this->likeComments()->where('likeable_id', $comment->id)
                                    ->where('likeable_type', get_class($comment))
                                    ->exists();
    }
}
