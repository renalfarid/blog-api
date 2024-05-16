<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function scopeAllPost() 
    {
        $posts = Post::leftJoin('users', 'posts.author_id', '=', 'users.id')
        ->select('posts.id', 'posts.title', 'users.name', 'posts.slug', 'posts.content', 'posts.published_date')
        ->orderBy('posts.published_date', 'DESC')
        ->get();
       return $posts;
    }

    public function scopeById($query, $userId)
    {
      $posts = $query->where('author_id', $userId)
               ->orderBy('published_date', 'DESC')
                ->get();
      return $posts;
    }
}
