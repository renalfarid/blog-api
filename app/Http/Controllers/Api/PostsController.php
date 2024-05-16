<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\PostsInterface;

class PostsController extends Controller {
    protected $PostsInterface;

    public function __construct(PostsInterface $postRepositoryInterface)
    {
        $this->PostsInterface= $postRepositoryInterface;
    }

    public function getPosts() {
        return $this->PostsInterface->getPosts();
    }

    public function getPostById() {
        return $this->PostsInterface->getPostById();
    }

    /*public function addUserDetails(Request $request) 
    {
        return $this->UserRepositoryInterface->addUserDetails($request);
    }*/
}