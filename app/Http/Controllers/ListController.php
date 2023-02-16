<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //direct admin list page
    public function index(){
        $userDatas = User::select('id','name','email','phone','address','gender')->get();
        return view('admin.list.index',compact('userDatas'));
    }

    //delete admin account
    public function deleteAccount ($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'User Account Deleted']);
    }

    //admin list search
    public function adminListSearch(Request $request){
        $userDatas=User::where('name','like',"%$request->adminSearchKey%")
                        ->orWhere('email','like',"%$request->adminSearchKey%")
                        ->orWhere('phone','like',"%$request->adminSearchKey%")
                        ->orWhere('address','like',"%$request->adminSearchKey%")
                        ->orWhere('gender','like',"%$request->adminSearchKey%")
                        ->orWhere('id','like',"%$request->adminSearchKey%")
                        ->get();
        return view('admin.list.index',compact('userDatas'));
        // return back(compact('userDatas'));
    }
}
