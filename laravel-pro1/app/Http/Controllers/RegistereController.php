<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RegistereController extends Controller
{
    //

    public function loadRegister(){
        if(Auth::user()&& Auth::user()->is_admin==0){
            return redirect('/dashboard');   
        }
        return view('register');

    }
    
    public function candidateRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'password_confirm' => 'required|string|same:password',
            'is_admin'=>'required'
        ]);
        
        
        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->is_admin=$request->is_admin;
        $user->save();
        

      return back()->with('success', 'Your registration was successful');
   }

   public function loadlogin(){

    if(Auth::user()&& Auth::user()->is_admin==1){
        return redirect('/admin/dashboard');
    }
    else if(Auth::user()&& Auth::user()->is_admin==0){
        return redirect('/dashboard');   
    }
    else{
        return view('/login');
    }
}
 
   public function userLogin(Request $request)
   {
    $request->validate([
        'email'=>'string|required|email',
        'password'=>'string|required'
    ]);
    $userCredencial=$request->only('email','password');

    if(Auth::attempt($userCredencial)){
        if(Auth::user()->is_admin==1){
            $name = Auth::user()->name;
            return redirect('/alluser');
        }
        else{
            // dd(Auth::user());
            session()->put('candidate_id', Auth::user()->id);
            session()->put('candidate_name', Auth::user()->name);
            return redirect('/dashboard');
        }
    }else{
        return back()->with('error','User name and password is incorrect');
    }
   }

   public  function loadDashboard()
   {
    return view('candidate.dashboard');
   }

   public  function adminDashboard()
   {
    
    $subjects=Subject::all();
    return view('admin.dashboard',compact('subjects'));
   }

   public function logout(Request $request){
    $request->session()->flush();
    Auth::logout();
    return redirect('/login');
   }
   public function forgotPassword(){
        return view('/forgot');
   }

   public function updatedPassword(Request $request){

    if(User::find())
    $request->validate([
        'name' => 'required|string|min:2',
        'email' => 'required|string|email|max:100|unique:users',
        'password' => [
            'required',
            'string',
            'min:6',
            'regex:/^(?=.*[A-Z])/u', // Requires at least one uppercase alphabetic character
        ],
        'password_confirm' => 'required|string|same:password',
        'is_admin' => 'required'
    ]);
    
   }


   

}
