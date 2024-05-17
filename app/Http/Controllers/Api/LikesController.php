<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\LikesInterface;

class LikesController extends Controller {
    protected $LikesInterface;

    public function __construct(LikesInterface $likesRepositoryInterface)
    {
        $this->LikesInterface = $likesRepositoryInterface;
    }

    public function addLikePost($id) {
        return $this->LikesInterface->addLikePost($id);
    }

    public function addLikeComment($id) {
        return $this->LikesInterface->addLikeComment($id);
    }
}