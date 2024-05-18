<?php
namespace App\Repositories;

use App\Interfaces\LikeDislikeInterface;
use App\Lib\Helper;
use App\Models\Dislike;
use App\Models\Like;
use App\Trait\ResponseApiTrait;
use Illuminate\Support\Facades\Log;

class LikeDislikeRepository implements LikeDislikeInterface {
  use ResponseApiTrait;

   public function addLikePost($id)
   {
     $post_id = intval($id);
     $user_id = Helper::getCurrentId();
     try {
       $like = Like::postAdd($user_id, $post_id);
       return $this->success("Liked post", $like, 200);
     } catch (\Exception $e) {
        Log::error($e->getMessage());
        return $this->error("failed like post");
     }
     
   }

   public function addLikeComment($id)
   {
    $comment_id = intval($id);
    $user_id = Helper::getCurrentId();
    try {
      $like = Like::commentAdd($user_id, $comment_id);
      return $this->success("Liked comment", $like, 200);
    } catch (\Exception $e) {
       Log::error($e->getMessage());
       return $this->error("failed like comment");
    }
   }

   public function addDislikePost($id)
   {
    $post_id = intval($id);
     $user_id = Helper::getCurrentId();
     try {
       $dislike = Dislike::postAdd($user_id, $post_id);
       return $this->success("Dislike post", $dislike, 200);
     } catch (\Exception $e) {
        Log::error($e->getMessage());
        return $this->error("failed dislike post");
     }
   }

   public function addDislikeComment($id)
   {
    $comment_id = intval($id);
    $user_id = Helper::getCurrentId();
    try {
      $dislike = Dislike::commentAdd($user_id, $comment_id);
      return $this->success("Dislike comment", $dislike, 200);
    } catch (\Exception $e) {
       Log::error($e->getMessage());
       return $this->error("failed dislike comment");
    }
   }
}