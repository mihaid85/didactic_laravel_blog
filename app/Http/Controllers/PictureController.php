<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Picture;


class PictureController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    
}
