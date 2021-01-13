<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function post($userId, Request $request)
    {
        $post = new Post([
            'body' => $request->body,
            'created_by' => !empty($userId) ? $userId : \Auth::user()->id
        ]);
        $post->save();

        return response()->json($post);
    }

    public function index()
    {
        return response()->json(Post::with('user')->latest()->paginate(10));
    }

    public function delete(Post $post)
    {
        $post->delete();
    }
}
