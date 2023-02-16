<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //get all category
    public function getallCategory(){
        $categories = Category::select('category_id','title','description')->get();

        return response()->json([
            'categories' => $categories
        ]);
    }

    //category search
    public function categorySearch(Request $request){

        $posts = Category::select('posts.*')
                                ->join('posts','categories.category_id','posts.category_id')
                                ->where('categories.title','like',"%$request->key%")
                                ->get();

        return response()->json([
            'posts' =>$posts
        ]);
    }
}
