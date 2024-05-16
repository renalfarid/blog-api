<?php
namespace App\Repositories;

use App\Interfaces\PostsInterface;
use App\Lib\Helper;
use App\Models\Post;
use App\Trait\ResponseApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Str;

class PostsRepository implements PostsInterface {
  use ResponseApiTrait;

  private function getPostById($id)
  {
    $posts = Post::byId($id);
    return $this->success("User post", $posts);
  }

  public function getPosts()
  {
    $posts = Post::allPost();
    return $this->success("All post", $posts, 200);
  } 

  public function getUserPost()
  {
    $isAdmin = Helper::isAdmin();
    
    if ($isAdmin) {
      return $this->getPosts();
    } 

    $user_id = Helper::getCurrentId();
    return $this->getPostById($user_id);
  }

  public function createPost(Request $request)
  {
    $validator = FacadesValidator::make($request->all(), [
      'title' => 'required',
      'content' => 'required',
    ]);

    if ($validator->fails()) {
      $error = $validator->errors()->first();
      return $this->error($error);
    }

    $validated = $validator->validated();
    $title = $validated['title'];
    $content = $validated['content'];
    $slug = Str::slug($title, '_');
    $user_id = Helper::getCurrentId();

    try {
      $post = Post::createPost($title, $slug, $content, $user_id);  
      return $this->success('New post created', $post, 200);
    } catch (\Exception $e) {
      $error = $e->getMessage();
      return $this->error($error);
    }

  }

}