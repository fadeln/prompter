<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'gambar';

    use HasFactory;

    protected $fillable = ['url', 'dapat_digambar_id', 'dapat_digambar_type'];

    public function imageable()
    {
        return $this->morphTo();
    }
}
