<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_title',
        'article_content',
        'is_published',
        'author_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
