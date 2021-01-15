<?php

namespace App\Http\Controllers;

use App\Models\Follower;
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
        ->when(is_null($id), function($query){
            $follwers = Follower::where('follower_id', \Auth::user()->id)->pluck('user_id');
            return $query->whereIn('created_by', $follwers)->orWhere('created_by', \Auth::user()->id);
        })
        ->latest()
        ->paginate(20);
        return response()->json($post);
    }

    public function show($id)
    {
        $post = Post::with('user')->findOrFail($id);

        return View('post.show', compact('post'));
    }

    public function delete(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();
    }
}
