<?php
namespace App\Repositories;

use App\Interfaces\UsersInterface;
use App\Models\User;
use App\Trait\ResponseApiTrait;

class Usersrepository implements UsersInterface {
  use ResponseApiTrait;

  public function getUsers() {
    $users = User::all();

    return $this->success("Users data", $users);
  }

  public function getCurrentUser()
  {
    $user =  auth('sanctum')->user();
    return $this->success("Current user", $user);
  }

}