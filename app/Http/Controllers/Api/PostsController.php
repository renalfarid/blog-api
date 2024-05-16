<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\PostsInterface;
use Illuminate\Http\Request;

class PostsController extends Controller {
    protected $PostsInterface;

    public function __construct(PostsInterface $postRepositoryInterface)
    {
        $this->PostsInterface= $postRepositoryInterface;
    }

    public function getPosts() {
        return $this->PostsInterface->getPosts();
    }

    public function getUserPost() {
        return $this->PostsInterface->getUserPost();
    }

    public function createUserPost(Request $request) {
        return $this->PostsInterface->createPost($request);
    }

    public function updateUserPost($id, Request $request) {
        return $this->PostsInterface->updatePost($id, $request);
    }

    public function deleteUserPost($id, Request $request) 
    {
        return $this->PostsInterface->deletePost($id, $request);
    }

    /*public function addUserDetails(Request $request) 
    {
        return $this->UserRepositoryInterface->addUserDetails($request);
    }*/
}