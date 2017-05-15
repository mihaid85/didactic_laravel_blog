<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends Model implements Authenticatable
{
	use AuthenticableTrait;
    protected $fillable = array('username', 'password', 'email', 'first_name', 'last_name');

    public function posts()
    {
    	return $this->hasMany('App\Post');
    }

    public function comments()
    {
    	return $this->hasMany('App\Comment');
    }
}
