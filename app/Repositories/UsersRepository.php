<?php
namespace App\Repositories;

use App\Http\Resources\Resource\UserResource;
use App\Interfaces\UsersInterface;
use App\Lib\Helper;
use App\Models\User;
use App\Models\UserDetails;
use App\Trait\ResponseApiTrait;
use Illuminate\Http\Request;

class Usersrepository implements UsersInterface {
  use ResponseApiTrait;

  public function getUsers() {
    $users = User::all();

    //$user_collection = new UserResource($users);

    return $this->success("Users data", $users);
  }

}