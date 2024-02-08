<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'is_admin',
        'name',
        'bio',
        'image',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //Our Users have many ideas, Relatioship with Ideas
    public function ideas() {
        return $this->hasMany(Idea::class)->latest();
    }

    //Relationship with Comments
    public function comments() {
        return $this->hasMany(Comment::class)->latest();
    }

    //Many To Many Relationship
    public function followings() {
        return $this->belongsToMany(User::class, 'follower_user', 'follower_id', 'user_id')->withTimestamps();
    }

    public function followers() {
        return $this->belongsTOmany(User::class, 'follower_user', 'user_id', 'follower_id')->withTimestamps();
    }
    //

    //pass in User model to see if we follow this User or not
    public function follows(User $user) {
        //where user_id equal to user that we are following. It means checking if there are any records or not.
        return $this->followings()->where('user_id', $user->id)->exists();

    }

    //all the users that like the post, means this "like" belong to this Idea
    public function likes() {
        return $this->belongsToMany(Idea::class, 'idea_like')->withTimestamps();
    }

    public function likesIdea(Idea $idea) {
        //where idea_id equal to id that we like. It means checking if there are any records or not.
        return $this->likes()->where('idea_id', $idea->id)->exists();

    }

    public function getImageURL() {
        if ($this->image) {
            return url('storage/'. $this->image);
        }
        return "https://api.dicebear.com/6.x/fun-emoji/svg?seed={$this->name}";
    }



}
