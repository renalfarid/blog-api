<?php

namespace App\Interfaces;
interface UsersInterface
{
     /**
     * Get Users
     * 
     * @method  Get api/users
     * @access  private
     */
    public function getUsers();

     /**
     * Get Users
     * 
     * @method  Get api/user
     * @access  private
     */
    public function getCurrentUser();

}
