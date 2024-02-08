<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    //with('user') is for Eager Loading, passing 'user' relationship from Idea model, reducing duplicated in Queries
    protected $with = ['user:id,name,image', 'comments.user:id,name,image'];

    protected $withCount = ['likes'];


    //This is for security thing
    protected $fillable = [
        'user_id',
        'content',
    ];

    //Defining Relationship with Laravel
    //The name of the method is gonna be the name of the
    //table Idea has realtionship with which is comments table

    public function comments() {

        //return type of realtionship we have
        return $this->hasMany(Comment::class);
    }

    //New relation for use one-many. One user can have many ideas
    public function user() {
        return $this->belongsTo(User::class);
    }

    //all the users that like the post, means this "like" belong to many users
    //idea_like table, no need to defind key
    public function likes() {
        return $this->belongsToMany(User::class, 'idea_like')->withTimestamps();
    }


    // Scopes are defined in Model
    // Scopes are just a method that apply some queries on existing set of queries
    public function scopeSearch($query, $search = '') {

        return $query->where('content', 'like', '%' . $search . '%');
    }

}
