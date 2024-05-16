<?php
namespace App\Repositories;

use App\Interfaces\PostsInterface;
use App\Models\Post;
use App\Trait\ResponseApiTrait;

class PostsRepository implements PostsInterface {
  use ResponseApiTrait;

  public function getPosts()
  {
    $posts = Post::allPost();
    return $this->success("All post", $posts, 200);
  } 

  public function getPostById()
  {
    //
  }

}