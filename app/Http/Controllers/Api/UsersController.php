<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\UsersInterface;

class UsersController extends Controller {
    protected $UserInterface;

    public function __construct(UsersInterface $userRepositoryInterface)
    {
        $this->UserInterface = $userRepositoryInterface;
    }

    public function getUsers() {
        return $this->UserInterface->getUsers();
    }

    public function getUserDetails() {
        return $this->UserInterface->getCurrentUser();
    }

    /*public function addUserDetails(Request $request) 
    {
        return $this->UserRepositoryInterface->addUserDetails($request);
    }*/
}