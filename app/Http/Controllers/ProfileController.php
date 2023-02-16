<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //direct admin home page
    public function index(){
        $id = Auth::user()->id;
        // dd(Auth::user()->toArray());

        $userInfo = User::select('id','name','email','address','phone','gender')->where('id',$id)->first();
        // dd($userInfo->toArray());
        return view('admin.profile.index',compact('userInfo'));
    }

    //update admin account
    public function updateAdminAccount(Request $request){
        $userData = $this->getUserInfo($request);

        $this->userValidationCheck($request);

        User::where('id',Auth::user()->id)->update($userData);
        return back()->with(['updateSuccess'=>"Account Updated"]);
    }

    //direct Change Password
    public function directChangePassword(){
        return view('admin.profile.change_password');
    }

    //change password
    public function changePassword(Request $request){
        $validator= $this->passwordValidationCheck($request);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $dbdata = User::where('id',Auth::user()->id)->first();
        $dbPassword = $dbdata->password;

        if(Hash::check($request->oldPass,$dbPassword)){
           $newPassword = Hash::make($request->newPass);

           User::where('id',Auth::user()->id)->update(["password"=>$newPassword,'updated_at'=>Carbon::now()]);
            return redirect()->route('dashboard');
        }else{
            return back()->with(['fail'=>"Old Password Do Not Match."]);
        }

    }

    //get user info
    private function getUserInfo($request){
        return [
            'name' => $request->adminName,
            'email' => $request->adminEmail,
            'phone' => $request->adminPhone,
            'address' => $request->adminAddress,
            'gender' => $request->adminGender,
            'updated_at' => Carbon::now()
        ];
    }

    //user data valition
    private function userValidationCheck($request){
        Validator::make($request->all(),[
            'adminName' => 'required',
            'adminEmail' => 'required|unique:users,email,'.$request->adminId,
        ],[
            'adminName.required'=>" Name is required",
            'adminEmail.required' => "Please Enter Email"
        ])->validate();
    }

    //password validatin check
    private function passwordValidationCheck($request){
        return Validator::make($request->all(),[
            'oldPass' => 'required',
            'newPass' => 'required|min:8',
            'confirmPass' => 'required|min:8|same:newPass'
        ],[
            'confirmPass.same' => "New Password & Confirm Password must be same."
        ]);
    }
}
