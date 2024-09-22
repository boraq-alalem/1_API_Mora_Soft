<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use ApiResponseTrait;



    public function index(Request $request)
    {

        // $validator = Validator::make($request->all(), [
        //     'token' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return $this->ApiResponce($validator->errors(), 401, 'check the error below,🤦‍♂️');
        // }

        $posts = PostResource::collection(Post::get());
        return $this->ApiResponce($posts, 200, 'get data is succussfuly');
    }

    public function show($id)
    {
        $post = Post::find($id);
        if ($post) {
            return $this->ApiResponce(new PostResource($post), 200, 'get data is succussfuly');
        }
        return $this->ApiResponce('', 401, 'the post is not fuond,🤦‍♂️');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->ApiResponce($validator->errors(), 401, 'check the error below,🤦‍♂️');
        }

        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);
        return $this->ApiResponce(new PostResource($post), 201, ' data stored succussfuly');
    }

    public function update(Request $request, $id)
    {

        $post = Post::find($id);

        if (!$post) {
            return $this->ApiResponce('', 401, 'the post is not fuond,🤦‍♂️');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->ApiResponce($validator->errors(), 401, 'check the error below,🤦‍♂️');
        }

        $post->update($request->all());

        return $this->ApiResponce(new PostResource($post), 200, 'data updated succussfuly');
    }

    public function delete($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return $this->ApiResponce('', 401, 'the post is not fuond,🤦‍♂️');
        }
        $post->delete($id);
        return $this->ApiResponce(new PostResource($post), 200, 'data deleted succussfuly');
    }
}
