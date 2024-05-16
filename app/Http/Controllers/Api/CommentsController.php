<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\CommentsInterface;

class CommentsController extends Controller {
    protected $CommentsInterface;

    public function __construct(CommentsInterface $commentRepositoryInterface)
    {
        $this->CommentsInterface = $commentRepositoryInterface;
    }

    public function getUserComments() {
        return $this->CommentsInterface->getUserComments();
    }


    /*public function addUserDetails(Request $request) 
    {
        return $this->UserRepositoryInterface->addUserDetails($request);
    }*/
}