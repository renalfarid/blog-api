<?php
namespace App\Repositories;

use App\Interfaces\AuthInterface;
use App\Models\User;
use App\Trait\ResponseApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthRepository implements AuthInterface {
  use ResponseApiTrait;

  
  public function signup(Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',
        'role' => 'required',
    ]);

    if ($validator->fails()) {
       $error = $validator->errors()->first();
        return $this->error($error);
    }
    $validated = $validator->validated();
    $name = $validated['name'];
    $email = $validated['email'];
    $password = Hash::make($validated['password'], ['round' => 12]);
    $role = $validated['role'];
   
    try {
      $query_add_user = User::addUser();
      $users = DB::select($query_add_user, [$name, $email, $password, $role]);
      
      $query_last_user = User::getLastUser();
      $users = DB::select($query_last_user);
      return $this->success("success create new user", $users);
    } catch (\Exception $e) {
      return $this->error("insert data failed: " . $e->getMessage());
    }
    
    
    $users = DB::table('users')->insert([
      'name' => $name,
      'email' => $email,
      'password' => $password
    ]);
   return $this->success("user created !", $users);


  }

  public function auth(Request $request)
  {
    $email = $request->input("email");
    $password = $request->input("password");

    $query = User::userLogin();
    
    $user = DB::select($query, [$email]);

    if (empty($user)) {
      return $this->error("email is invalid !");
    }

    $user = (object) $user[0];
    
    if (!$user || !Hash::check($password, $user->password)) {
      return $this->error("invalid credential !"); 
    }

    $user = User::where('email', $request->email)->firstOrFail();
   
    $token = $user->createToken('auth_token')->plainTextToken;
    $user->token = $token;
    return $this->success('login success', $user);
  
  }

  public function logout()
  {
    auth('sanctum')->user()->currentAccessToken()->delete();
    return $this->success("successfully logout", []);
  }
}