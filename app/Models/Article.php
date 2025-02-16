<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'main_image'];

    // Relasi ke AdditionalImage
    public function additionalImages()
    {
        return $this->hasMany(AdditionalImage::class);
    }
}