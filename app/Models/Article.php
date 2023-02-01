<?php

namespace App\Models;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = null;

    protected $fillable = [
        'title', 'author', 'description', 'publication_date'
    ];

    /**
     * The tags that belong to the article.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }
}
