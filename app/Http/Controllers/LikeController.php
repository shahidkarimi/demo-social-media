<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Notifications\LikeNotification;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like($type, $id)
    {
        $xisting  = Like::where('source_type', $type)
            ->where('source_type', $type)
            ->where('source_id', $id)
            ->where('user_id', \Auth::user()->id)
            ->first();
        if($xisting){
            $xisting->delete();
            return;
        }

        $like = new Like([
            'source_type' => $type,
            'source_id' => $id,
            'user_id' => \Auth::user()->id
        ]);
        $like->save();

        if($type == 'post'){
            $post = Post::find($id);
            $post->user->notify(new LikeNotification('post', $post));
        }

    }

    public function count($type, $id)
    {
        $c = Like::where('source_type', $type)
            ->where('source_id', $id)
            ->count();
        return response()->json(['value' => $c]);
    }
}
