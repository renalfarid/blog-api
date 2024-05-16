<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
      'title',
      'content',
      'slug',
      'author_id',
  ];

    public function scopeAllPost() 
    {
        $posts = Post::where('status', 'published')
        ->leftJoin('users', 'posts.author_id', '=', 'users.id')
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

    public function scopeCreatePost($query, $title, $slug, $content, $userId) 
    {
      $posts = $query->updateOrCreate(
         ['title' => $title, 'slug' => $slug, 'content' => $content, 'author_id' => $userId]
      );
      return $posts;
    }

}
