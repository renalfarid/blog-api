<?php

namespace App\Interfaces;

interface LikesInterface
{
    /**
     * Add Like Post
     * 
     * @method  Post api/like/post/{id}
     * @access  private
     */
    public function addLikePost($id);

    /**
     * Add Like Comment
     * 
     * @method  Post api/like/comment/{id}
     * @access  private
     */
    public function addLikeComment($id);
}
