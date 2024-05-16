<?php

namespace App\Interfaces;

interface CommentsInterface
{
    /**
     * Get User Comments
     * 
     * @method  Get api/user/comments
     * @access  private
     */
    public function getUserComments();
}
