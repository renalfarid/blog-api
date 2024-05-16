<?php

namespace App\Interfaces;
interface PostsInterface
{
     /**
     * Get Users
     * 
     * @method  Get api/posts
     * @access  private
     */
    public function getPosts();

    /**
     * Get Users
     * 
     * @method  Get api/user/post
     * @access  private
     */
    public function getUserPost();

}
