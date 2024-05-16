<?php
namespace App\Repositories;

use App\Interfaces\PostsInterface;
use App\Lib\Helper;
use App\Models\Post;
use App\Trait\ResponseApiTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
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
    $validator = Validator::make($request->all(), [
      'title' => 'required',
      'content' => 'required',
      'status' => 'required',
    ]);

    if ($validator->fails()) {
      $error = $validator->errors()->first();
      return $this->error($error, 422);
    }

    $validated = $validator->validated();
    $title = $validated['title'];
    $content = $validated['content'];
    $status = str::lower($validated['status']);
    $published_date = null;
    if ($status == 'published') {
      $published_date = Carbon::now();
    } else {
      $published_date = null;
    }
    $slug = Str::slug($title, '_');
    $user_id = Helper::getCurrentId();

    try {
      $post = Post::createPost($title, $slug, $content, $user_id, $status, $published_date);  
      return $this->success('New post created', $post, 200);
    } catch (\Exception $e) {
      Log::error($e->getMessage());
      $error = "Failed create new post";
      return $this->error($error);
    }

  }

  public function updatePost($id, Request $request)
  {
    $post_id = intval($id);
    $post = Post::findPost($post_id);
    if (!$post) {
      return $this->error("post not found", 404);
    }
    $post->update($request->all());
    return $this->success("post updated", [], 200);
  }

  public function deletePost($id, Request $request)
  {
    $post_id = intval($id);
    $post = Post::findPost($post_id);
    if (!$post) {
      return $this->error("post not found", 404);
    }

    $post->delete();
    return $this->success("post deleted", [], 200);
  }

}