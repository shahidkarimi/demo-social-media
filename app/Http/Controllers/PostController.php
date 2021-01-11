<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function post(Request $request)
    {
        $post = new Post([
            'body' => $request->body,
            'created_by' => \Auth::user()->id
        ]);
        $post->save();

        return response()->json($post);
    }

    public function index()
    {
        return response()->json(Post::latest()->paginate(10));
    }
}
