<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //direct post page
    public function index(){
        $categories = Category::get();
        $posts = Post::get();
        return view('admin.post.index',compact('categories','posts'));
    }

    //Post Create
    public function createPost(Request $request){
        $this->postValidationCheck($request);

        $data = $this->getPostData($request);


        if(!empty($request->postImage)){

            $data['image'] = $this->addImageToPublic($request);
        }
        Post::create($data);
        return back();
    }

    //delete Post
    public function deletePost($id){
        $this->deleteFromPublic($id);
        Post::where('post_id',$id)->delete();

        return back();
    }

    // update Post Page
    public function updatePostPage($id){
        $categories = Category::get();
        $postDetail = Post::where('post_id',$id)->first();
        return view("admin.post.update",compact('categories','postDetail'));
    }

    //update Post
    public function updatePost($id,Request $request){
        $this->postValidationCheck($request);

        $data = $this->getPostData($request);

        if(!empty($request->postImage)){
            $this->deleteFromPublic($id);

            $data['image'] = $this->addImageToPublic($request);;
        }
        Post::where('post_id',$id)->update($data);
        return redirect()->route('admin#post');
    }

    private function deleteFromPublic($id){
        $postData = Post::where('post_id',$id)->first();
         $dbImageName = $postData->image;

        if(File::exists(public_path().'/postImage/'.$dbImageName)){
            File::delete(public_path().'/postImage/'.$dbImageName);
        }
    }

    private function addImageToPublic($request){
        $file = $request->file('postImage');
        $fileName = uniqid().'_'.$file->getClientOriginalName();

        $file->move(public_path().'/postImage',$fileName);
        return $fileName;
    }
    private function getPostData($request){
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'category_id' => $request->postCategory,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }

    //Post validation Check
    private function postValidationCheck($request){
        Validator::make($request->all(),[
            'postTitle' => 'required' ,
            'postDescription' => 'required',
            'postCategory' => 'required'
        ])->validate();
    }
}
