<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Traits\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use JsonResponse;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        try {
            $posts  = $this->post->all();
            return $this->succcess('Success!', $posts);
        } catch (\Exception $exception) {
            return $this->handleErrorMessage($exception);
        }
    }

    public function show($slug)
    {
        try {
            $posts  = $this->post->where('slug', $slug)->get();
            return $this->succcess('Success!', $posts);
        } catch (\Exception $exception) {
            return $this->handleErrorMessage($exception);
        }
    }

    public function store(Request $request)
    {
        try {
            $post = new Post();
            $post->title    = $request->title;
            $post->body     = $request->body;
            $post->slug     = $request->slug;

            $post->save();

            return $this->succcess('Success!', $post);
        } catch (\Exception $exception) {
            return $this->handleErrorMessage($exception);
        }
    }

    public function update(Request $request)
    {
        try {
            $post = $this->post->find($request->_id);

            $post->title = $request->title;
            $post->body = $request->body;
            $post->slug = $request->slug;
            $post->save();

            return $this->succcess('Success!', $post);
        } catch (\Exception $exception) {
            return $this->handleErrorMessage($exception);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $result = $this->post->destroy($request->_id);

            return $this->succcess('Success!', $result);
        } catch (\Exception $exception) {
            return $this->handleErrorMessage($exception);
        }
    }
}
