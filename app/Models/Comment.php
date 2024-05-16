<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
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

    public function scopeUserComments()
    {
      $comments = Comment::all();
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
      $comment = $query->where('post_id', $post_id)->get();
      return $comment;
    }
}