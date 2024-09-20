<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiResponseTrait;

    public function index(){
        // return "Hello";
        $posts = Post::get();
        
        return $this->ApiResponce($posts, 200, 'get data is succussfuly');

    }
}
