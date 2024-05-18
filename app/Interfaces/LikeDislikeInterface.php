<?php

namespace App\Interfaces;

interface LikeDislikeInterface
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

    /**
     * Add Dislike Post
     * 
     * @method  Post api/dislike/post/{id}
     * @access  private
     */
    public function addDislikePost($id);

    /**
     * Add Dislike Comment
     * 
     * @method  Post api/dislike/comment/{id}
     * @access  private
     */
    public function addDislikeComment($id);
}
