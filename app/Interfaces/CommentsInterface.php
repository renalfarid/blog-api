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
     * Create Post Comment
     * 
     * @method  Post api/user/comments/post_id
     * @access  private
     */
    public function createPostComment($id, Request $request);

    /**
     * Update Post Comment
     * 
     * @method  Put api/user/comments/post_id
     * @access  private
     */
    public function updatePostComment($id, Request $request);

    /**
     * Delete Post Comment
     * 
     * @method  Delete api/user/comments/post_id
     * @access  private
     */
    public function deletePostComment($id);

    /**
     * Get Post Comment
     * 
     * @method  Get api/user/comments/post_id
     * @access  private
     */
    public function getPostComment($id, Request $request);
}
