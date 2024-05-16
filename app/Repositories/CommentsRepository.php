<?php
namespace App\Repositories;

use App\Interfaces\CommentsInterface;
use App\Models\User;
use App\Trait\ResponseApiTrait;

class CommentsRepository implements CommentsInterface {
  use ResponseApiTrait;

  public function getUserComments()
  {
     return $this->success("User comments", [], 200);
  }

}