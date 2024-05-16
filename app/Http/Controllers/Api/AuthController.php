<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\AuthInterface;

class AuthController extends Controller
{
  protected $AuthInterface;
  /**
     * Create a new constructor for this controller
     */
    public function __construct(AuthInterface $AuthRepositoryInterface)
    {
        $this->AuthInterface = $AuthRepositoryInterface;
    }

  public function auth(Request $request) {
    return $this->AuthInterface->auth($request);
  }

  public function signup(Request $request) {
    return $this->AuthInterface->signup(($request));
  }

  public function logout() {
    return $this->AuthInterface->logout();
  }
}
