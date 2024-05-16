<?php
namespace App\Repositories;

use App\Interfaces\PostsInterface;
use App\Models\User;
use App\Trait\ResponseApiTrait;

class PostsRepository implements PostsInterface {
  use ResponseApiTrait;

  public function getPosts()
  {
    //
  } 

  public function getPostById()
  {
    //
  }

}