<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function tags(){
    	return $this->belongsToMany('App\Tag', 'post_tag', 'post_id', 'tag_id');
    }

    public function picture()
    {
    	return $this->hasOne('App\Picture');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
