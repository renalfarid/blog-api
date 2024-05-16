<?php
namespace App\Repositories;

use App\Interfaces\PostsInterface;
use App\Lib\Helper;
use App\Models\Post;
use App\Trait\ResponseApiTrait;

class PostsRepository implements PostsInterface {
  use ResponseApiTrait;

  private function getPostById($id)
  {
    $posts = Post::byId($id);
    return $this->success("User post", $posts);
  }

  public function getPosts()
  {
    $posts = Post::allPost();
    return $this->success("All post", $posts, 200);
  } 

  public function getUserPost()
  {
    $isAdmin = Helper::isAdmin();
    
    if ($isAdmin) {
      return $this->getPosts();
    } 

    $user_id = Helper::getCurrentId();
    return $this->getPostById($user_id);
  }

}