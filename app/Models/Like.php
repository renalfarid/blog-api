<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'post_id',
        'comment_id'
     ];

    public function scopePostAdd($query, $userId, $postId)
    {
      $like = $query->create(
        ["user_id" => $userId, "post_id" => $postId]
      );
      return $like;
    }

    public function scopeCommentAdd($query, $userId, $commentId)
    {
      $like = $query->create(
        ["user_id" => $userId, "comment_id" => $commentId]
      );
      return $like;
    }
}
