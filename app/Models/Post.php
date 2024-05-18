<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class Post extends Model
{
    use HasFactory, SoftDeletes;
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
      'status',
      'published_date',
   ]; 

    public function scopeAllPost() 
    {
      $posts = Post::where('status', 'published')
      ->leftJoin('users', 'posts.author_id', '=', 'users.id')
      ->leftJoin(DB::raw('(SELECT post_id, COUNT(*) as likes_count FROM likes GROUP BY post_id) likes'), 'posts.id', '=', 'likes.post_id')
      ->leftJoin(DB::raw('(SELECT post_id, COUNT(*) as dislikes_count FROM dislikes GROUP BY post_id) dislikes'), 'posts.id', '=', 'dislikes.post_id')
      ->leftJoin(DB::raw('(SELECT post_id, COUNT(*) as comment_count FROM comments GROUP BY post_id) comments'), 'posts.id', '=', 'comments.post_id')
      ->select('posts.id', 
          'posts.title', 
          'users.name', 
          'posts.slug', 
          'posts.content', 
          'posts.published_date', 
          DB::raw('COALESCE(likes.likes_count, 0) as likes_count'),
          DB::raw('COALESCE(dislikes.dislikes_count, 0) as dislikes_count'),
          DB::raw('COALESCE(comments.comment_count, 0) as comment_count'))
      ->orderBy('posts.published_date', 'DESC')
      ->get();

      $posts = $posts->map(function ($post) {
        $post->is_like = $post->likes_count > 0;
        $post->is_dislike = $post->dislikes_count > 0;
          return $post;
      });
      return $posts;
    }

    public function scopeBySlug($query, $slug)
    {
      $post = $query->where('slug', $slug)
              ->leftJoin('users', 'posts.author_id', '=', 'users.id')
              ->select('posts.id', 'posts.title', 'posts.content', 'posts.published_date',
              'users.id as user_id', 'users.name')
              ->first();
      return $post;
    }

    public function scopeByPostId($query, $id)
    {
      $post = $query->where('posts.id', $id)
              ->leftJoin('users', 'posts.author_id', '=', 'users.id')
              ->select('posts.id as post_id', 'posts.title', 'posts.content', 'posts.published_date',
              'users.id as user_id', 'users.name')
              ->first();
      return $post;
    }

    public function scopeById($query, $userId)
    {
      $posts = DB::table('posts')
           ->select('posts.*', 'likes.id as like_id', 'dislikes.id as dislike_id')
           ->leftJoin('users', 'users.id', '=', 'posts.author_id')
           ->leftJoin('likes', 'posts.id', '=', 'likes.post_id')
           ->leftJoin('dislikes', 'posts.id', '=', 'dislikes.post_id')
           ->select('posts.id as post_id', 'users.name', 'posts.title', 'posts.content', 
           'posts.published_date')
           ->where('posts.author_id', $userId)
           ->orderBy('posts.published_date', 'DESC')
           ->get();
      
      return $posts;
    }

    public function scopeCreatePost($query, $title, $slug, $content, $userId, $status, $published_date) 
    {
      $posts = $query->updateOrCreate(
         [
           'title' => $title, 'slug' => $slug, 
           'content' => $content, 'author_id' => $userId, 
           'status' => $status,'published_date' => $published_date
          ]
      );
      return $posts;
    }

    public function scopeUpdatePost($query, $title, $slug, $content, $userId, $status, $published_date) 
    {
      $posts = $query->update(
         [
           'title' => $title, 'slug' => $slug, 
           'content' => $content, 'author_id' => $userId, 
           'status' => $status,'published_date' => $published_date
          ]
      );
      return $posts;
    }

    public function scopeFindPost($query, $id)
    {
      $post = $query->find($id);
      if (!$post) {
        return [];
      }
      return $post;
    }

}
