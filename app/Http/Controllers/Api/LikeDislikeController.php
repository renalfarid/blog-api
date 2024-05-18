<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\LikeDislikeInterface;

class LikeDislikeController extends Controller {
    protected $LikeDislikeInterface;

    public function __construct(LikeDislikeInterface $likeDislikeRepositoryInterface)
    {
        $this->LikeDislikeInterface = $likeDislikeRepositoryInterface;
    }

    public function addLikePost($id) {
        return $this->LikeDislikeInterface->addLikePost($id);
    }

    public function addLikeComment($id) {
        return $this->LikeDislikeInterface->addLikeComment($id);
    }

    public function addDislikePost($id) {
        return $this->LikeDislikeInterface->addDislikePost($id);
    }

    public function addDislikeComment($id) {
        return $this->LikeDislikeInterface->addDislikeComment($id);
    }
}