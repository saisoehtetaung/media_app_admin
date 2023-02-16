<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    //direct trend post page
    public function index(){
        $viewPosts = ActionLog::select('action_logs.*','posts.*',DB::raw('COUNT(action_logs.post_id) as post_count'))
                            ->leftJoin('posts','posts.post_id','action_logs.post_id')
                            ->groupBy('action_logs.post_id')//COUNT MAX MIN => DB: raw
                            ->orderBy('post_count','desc')
                            ->get();


        return view('admin.trend_post.index',compact('viewPosts'));
    }

    //trend post detail
    public function details($id){
        $categories = Category::get();
        $postDetail = Post::where('post_id',$id)->first();
        $viewPosts = ActionLog::where('post_id',$id)->get();
        return view("admin.trend_post.details",compact('categories','postDetail','viewPosts'));
    }


}
