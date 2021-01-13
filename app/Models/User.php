<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $appends = ['profileUrl'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getProfileUrlAttribute()
    {
        return route('user.profile', ['id' => $this->id, 'slug' => \Str::slug($this->name)]);
    }

    public function follow()
    {
        $follower = Follower::firstOrCreate([
            'user_id' => $this->id,
            'follower_id' => \Auth::user()->id
        ]);

        return 'unfollow';
    }
    public function unfollow()
    {
        $follower = Follower::where('follower_id', \Auth::user()->id)->first();
        $follower->delete();
        return 'follow';
    }
}
