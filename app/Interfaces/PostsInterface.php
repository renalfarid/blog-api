<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface PostsInterface
{
     /**
     * Get All Post
     * 
     * @method  Get api/posts
     * @access  public
     */
    public function getPosts();

    /**
     * Get User Post
     * 
     * @method  Get api/user/post
     * @access  private
     */
    public function getUserPost();

     /**
     * Create Post
     * 
     * @method  POST api/posts
     * @access  private
     */
    public function createPost(Request $request);

}
