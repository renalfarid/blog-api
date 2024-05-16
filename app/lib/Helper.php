<?php
namespace App\Lib;

Class Helper {
  public static function isAdmin() 
  {
    $user =  auth('sanctum')->user();
    $user_role = $user->role;
    if ($user_role == 'admin') {
      return true;
    } else {
        return false;
    }
  }

  public static function getCurrentId()
  {
    $id = auth('sanctum')->id();
    return $id;
  }
}