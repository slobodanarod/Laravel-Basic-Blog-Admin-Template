<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\Exception\Exception;

class AuthController extends Controller
{
    use ImageUploadTrait;

    public function login(){
        if(Auth::guard('admin')->check()){
            return redirect()->intended('/admin/dashboard');
        }
        return view('backend.auth.login');
    }

    public function loginPost(Request $request){

        $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        if(Auth::guard('admin')->attempt($request->except('_token'),1)){
             return redirect()->intended("/admin/dashboard");
        }else{
            return back()->with('type','danger')->with('message','Wrong email or password.')->withInput();
        }

    }

    public function edit(){
        $user = Auth::guard("admin")->user();
        // dd($user);
        return view('backend.auth.edit',compact('user'));
    }

    public function editPost(Request $request){

        try{

            $user = User::find(Auth::guard("admin")->user()->id);
            $user->name = $request->name;
            $imageName = $user->image;
            if($request->file){
                $imageName = $this->imageUpload($request->file,"users",$request->name);
            }
            $user->image = $imageName;

            if($request->password){
                $user->password = bcrypt($request->password);
            }

            if($user->save()){
                Auth::guard('admin')->logout();
                return redirect()->intended('admin/login')->with('type',"success")->with('message',"Succesful.Please login again.");
            }else{
                return back()->with('type',"danger")->with('message',"Error Succesfull");
            }

        }catch(Exception $e){
            dd($e);

        }

    }

    public function change_admin_mode(){

        $mode = Auth::guard('admin')->user()->admin_mode;
        if($mode == "dark"){
            $newMode = "light";
        }else{
            $newMode = "dark";
        }
        User::where('id',Auth::guard('admin')->user()->id)->update(["admin_mode" => $newMode]);
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return back();
    }

}
