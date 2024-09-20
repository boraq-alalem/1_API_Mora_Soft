<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiResponseTrait;

    public function index(){

        $posts = Post::get();        
        return $this->ApiResponce($posts, 200, 'get data is succussfuly');
        
    }
    
    public function show($id){
        $post = Post::find($id);
        if($post){
            return $this->ApiResponce($post, 200, 'get data is succussfuly');
        }else{
            return $this->ApiResponce('', 401, 'the post is not fuond,🤦‍♂️');
        }
        // return $this->ApiResponce($post, 200, 'get data is succussfuly');
    }
}
