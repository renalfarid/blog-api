<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\CommentsInterface;
use Illuminate\Http\Request;

class CommentsController extends Controller {
    protected $CommentsInterface;

    public function __construct(CommentsInterface $commentRepositoryInterface)
    {
        $this->CommentsInterface = $commentRepositoryInterface;
    }

    public function getUserComments() {
        return $this->CommentsInterface->getUserComments();
    }

    public function createPostComment($id, Request $request) {
        return $this->CommentsInterface->createPostComment($id, $request);
    }

    public function getPostComment($id, Request $request) {
        return $this->CommentsInterface->getPostComment($id, $request);
    }
}