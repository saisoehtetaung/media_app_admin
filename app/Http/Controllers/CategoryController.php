<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category page
    public function index(){
        $categories = Category::get();
        return view('admin.category.index',compact('categories'));
    }

    //create Category
    public function createCategory(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->getCategoryData($request);

        Category::create($data);
        return back();
    }

    //delete Category
    public function deleteCaregory($id){
        Category::where('category_id',$id)->delete();
        return back()->with(['deleteSuccess'=> 'Category Deleted']);
    }

    //Search Category
    public function categorySearch(Request $request){
        $categories=Category::where('title','like',"%$request->searchKey%")->get();
        return view('admin.category.index',compact('categories'));
    }

    //category Edit Page
    public function categoryEditPage($id){
        $data = Category::where('category_id',$id)->first();
        return view('admin.category.edit',compact('data'));
    }

    //Update Category
    public function categoryUpdate(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->getCategoryData($request);

        Category::where('category_id',$request->categoryId)->update($data);
        return redirect()->route('admin#category');
    }

    //get category data
    private function getCategoryData($request){
         return [
            'title' => $request->categoryName,
            'description' => $request->categoryDescription,
        ];
    }

    //category validation
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName' => 'required',
            'categoryDescription' => 'required'
        ])->validate();
    }
}
