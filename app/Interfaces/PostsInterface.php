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
    public function getPosts(Request $request);

    /**
     * Get Filter Post
     * 
     * @method  Get api/posts/filter?{filter}
     * @access  public
     */
    public function getFilterPosts(Request $request);

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

     /**
     * Update user post
     * 
     * @method  PUT api/posts
     * @access  private
     */
    public function updatePost($id, Request $request);

    /**
     * Delete user post
     * 
     * @method  DELETE api/posts
     * @access  private
     */
    public function deletePost($id, Request $request);

}
