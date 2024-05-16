<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface CommentsInterface
{
    /**
     * Get User Comments
     * 
     * @method  Get api/user/comments
     * @access  private
     */
    public function getUserComments();

    /**
     * Post User Comment
     * 
     * @method  Post api/user/comments/post_id
     * @access  private
     */
    public function createPostComment($id, Request $request);

    /**
     * Get Post Comment
     * 
     * @method  Get api/user/comments/post_id
     * @access  private
     */
    public function getPostComment($id, Request $request);
}
