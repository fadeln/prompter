<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'label';

    use HasFactory;

    protected $fillable = ['nama'];

    public function prompts(){
        return $this->belongsToMany(Prompt::class,'prompt_label','label_id','prompt_id');
    }
}
