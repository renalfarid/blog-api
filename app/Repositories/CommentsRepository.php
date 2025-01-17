<?php
namespace App\Repositories;

use App\Interfaces\CommentsInterface;
use App\Lib\Helper;
use App\Models\Comment;
use App\Trait\ResponseApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CommentsRepository implements CommentsInterface {
  use ResponseApiTrait;

  public function getUserComments()
  {
     $user_id = Helper::getCurrentId();
     $comments = Comment::userComments($user_id);
     return $this->success("User comments", $comments, 200);
  }

  public function createPostComment($id, Request $request)
  {
    $validator = Validator::make($request->all(), [
      'content' => 'required',
    ]);
    
    if ($validator->fails()) {
      $error = $validator->errors()->first();
      return $this->error($error, 422);
    }
    
    $validated = $validator->validated();
    
    $content = $validated['content'];
    $post_id = intval($id);
    $user_id = Helper::getCurrentId();

    try {
      $comment = Comment::createPostComment($content, $user_id, $post_id);

      return $this->success("comment added", $comment, 200);
    } catch (\Exception $e) {
      Log::error($e->getMessage());
      $error = "Failed add comment";
      return $this->error($error, 500);
    }

  }

  public function getPostComment($id, Request $request)
  {
    $comment = Comment::getPostComment($id);
    return $this->success("post comment", $comment, 200);
  }

  public function updatePostComment($id, Request $request)
  {
    $validator = Validator::make($request->all(), [
      'content' => 'required',
    ]);
    
    if ($validator->fails()) {
      $error = $validator->errors()->first();
      return $this->error($error, 422);
    }
    
    $comment = Comment::findPostComment($id);

    $comment->update($request->all());
    return $this->success("comment updated", [], 200);

  }

  public function deletePostComment($id)
  {
    $post_id = intval($id);
    $comment = Comment::findPostComment($post_id);
    if (!$comment) {
      return $this->error("comment not found", 404);
    }

    $comment->delete();
    return $this->success("comment deleted", [], 200);
  }
}