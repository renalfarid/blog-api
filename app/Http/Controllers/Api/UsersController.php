<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\UsersInterface;
use Illuminate\Http\Request;

class UsersController extends Controller {
    protected $UserRepositoryInterface;

    public function __construct(UsersInterface $userRepositoryInterface)
    {
        $this->UserRepositoryInterface = $userRepositoryInterface;
    }

    public function getUsers() {
        return $this->UserRepositoryInterface->getUsers();
    }

    public function getUserDetails() {
        return $this->UserRepositoryInterface->getCurrentUser();
    }

    /*public function addUserDetails(Request $request) 
    {
        return $this->UserRepositoryInterface->addUserDetails($request);
    }*/
}