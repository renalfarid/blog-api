<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
      'content',
      'author_id',
      'post_id'
   ];

    public function scopeUserComments($query, $userId)
    {
      $comments = $query->where('comments.author_id', $userId)
                  ->leftJoin('users', 'comments.author_id', '=', 'users.id')
                  ->leftJoin('posts', 'comments.post_id', '=', 'posts.id')
                  ->select('comments.id',
                     'comments.content',
                     'comments.updated_at',
                     'posts.title',
                     'users.name'
                  )
                  ->orderBy('comments.updated_at', 'DESC')
                  ->get();
      return $comments;
    }

    public function scopeCreatePostComment($query, $content, $author, $post_id)
    {
       $comment = $query->create([
         'content' => $content, 
         'author_id' => $author,
         'post_id' => $post_id
       ]);
       return $comment;
    }

    public function scopeGetPostComment($query, $post_id)
    {
      /* $comment = $query->where('post_id', $post_id)
                 ->leftJoin('users', 'comments.author_id', '=', 'users.id')
                 ->select('comments.id', 'comments.post_id','comments.content', 'users.name')
                 ->get();
      return $comment;*/
      // change query to return count like and dislike
      $comment = $query->where('comments.post_id', $post_id)
                ->leftJoin('users', 'comments.author_id', '=', 'users.id')
                ->leftJoin('posts', 'comments.post_id', '=', 'posts.id')
                ->leftJoin('likes', function($join) {
                    $join->on('comments.id', '=', 'likes.comment_id')
                         ->whereNull('likes.post_id'); 
                })
                ->leftJoin('dislikes', function($join) {
                    $join->on('comments.id', '=', 'dislikes.comment_id')
                         ->whereNull('dislikes.post_id'); 
                })
                ->select(
                    'comments.id', 
                    'comments.post_id',
                    'posts.title',
                    'comments.content',
                    'comments.updated_at', 
                    'users.name',
                    DB::raw('COUNT(likes.id) as likes_count'), // Count likes
                    DB::raw('COUNT(dislikes.id) as dislikes_count') // Count dislikes
                )
                ->groupBy('comments.id', 
                'comments.post_id',
                'posts.title', 
                'comments.content', 
                'comments.updated_at', 
                'users.name') // Group by all selected columns except the counts
                ->orderBy('comments.updated_at', 'DESC')
                ->get();
    return $comment;
    }

    public function scopeFindPostComment($query, $id)
    {
      $comment = $query->find($id);
      if (!$comment) {
        return [];
      }
      return $comment;
    }

    public function scopeUpdatePostComment()
    {
      //
    }
}
