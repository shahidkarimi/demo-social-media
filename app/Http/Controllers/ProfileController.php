<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($id)
    {   $user = User::findOrFail($id);
        return View('profile.index', [
            'user' => $user
        ]);
    }

    public function DoAction($user,$status)
    {
        $user = User::findOrFail($user);
        if($status == 'follow'){
            $user->follow();
            return ['status' => 1];
        }
        $user->unfollow();
        return ['status' => 0];
    }

    public function followStatus($id)
    {
   
        $follower = Follower::where('user_id', $id)
        ->where('follower_id', \Auth::user()->id)
        ->first();

        return ['status' => $follower ? 1 : 0];

    }
}
