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

        return response()->json($post->load('user'));
    }

    public function index($id = null)
    {
        $post = Post::with('user')->when(!is_null($id), function($query) use($id){
            return $query->where('created_by', $id);
        })
        ->latest()
        ->paginate(10);
        return response()->json($post);
    }

    public function delete(Post $post)
    {
        $post->delete();
    }
}
