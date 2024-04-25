<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'kategori';

    use HasFactory;

    protected $fillable = ['judul'];

    public function prompts(){
        return $this->hasMany(Prompt::class, 'prompt_id');
    }
}
