<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface UsersInterface
{
     /**
     * Get Users
     * 
     * @method  Get api/users
     * @access  private
     */
    public function getUsers();

}
