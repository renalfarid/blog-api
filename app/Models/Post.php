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
        ->leftJoin('likes', 'posts.id', '=', 'likes.post_id')
        ->leftJoin('dislikes', 'posts.id', '=', 'dislikes.post_id')
        ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
        ->select('posts.id', 
        'posts.title', 
        'users.name', 
        'posts.slug', 
        'posts.content', 
        'posts.published_date', 
        'likes.post_id', 
        'likes.id as like_id', 
        'dislikes.post_id', 
        'dislikes.id as dislike_id',
        DB::raw('(SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) as comment_count'))
        ->orderBy('posts.published_date', 'DESC')
        ->get();
        $posts = $posts->map(function ($post) {
          $post->is_like = !is_null($post->like_id);
          $post->is_dislike = !is_null($post->dislike_id);
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

    public function scopeById($query, $userId)
    {
      $posts = DB::table('posts')
           ->select('posts.*', 'likes.id as like_id', 'dislikes.id as dislike_id')
           ->leftJoin('likes', 'posts.id', '=', 'likes.post_id')
           ->leftJoin('dislikes', 'posts.id', '=', 'dislikes.post_id')
           ->where('posts.author_id', $userId)
           ->orderBy('posts.published_date', 'DESC')
           ->get();
      
      $posts = $posts->map(function ($post) {
        $post->is_like = !is_null($post->like_id);
        $post->is_dislike = !is_null($post->dislike_id);
        return $post;
      });

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
