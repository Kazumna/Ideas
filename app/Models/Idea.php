<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    //This is for security thing
    protected $fillable = [
        'user_id',
        'content',
        'like',
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

}
