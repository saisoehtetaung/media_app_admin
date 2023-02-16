<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class postController extends Controller
{
    //get all Post
    public function getAllPost(){
        $posts = Post::get();
        return response()->json([
            'posts' =>$posts
        ]);
    }

        // post search
        public function postSearch(Request $request){
            $posts = Post::where('title','like',"%$request->key%")->get();
           return response()-> json([
            'posts' => $posts
           ]);
        }


        //post detail
        public function postDetails(Request $request){
            $posts = Post::where('post_id',$request->postId)->first();

            return response()->json([
                'posts' => $posts
            ]);
        }
}
