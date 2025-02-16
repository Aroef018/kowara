<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalImage extends Model
{
    use HasFactory;

    protected $fillable = ['article_id', 'path'];

    // Relasi ke model Article
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}