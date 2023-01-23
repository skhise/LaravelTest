<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;


class UserController extends Controller
{
    //
    protected function authenticated(Request $request, $user)
    {
      $user->last_seen_at = Carbon::now()->format('Y-m-d H:i:s');
      $user->save();
    }
    public function index(Request $request){
        return view('login');
    }
    public function home(Request $request){
        return view('home');
    }

    function checklogin(Request $request)
    {
     $this->validate($request, [
      'email'   => 'required|email',
      'password'  => 'required|alphaNum|min:3'
     ]);

     $user_data = array(
      'email'  => $request->get('email'),
      'password' => $request->get('password')
     );

     if(Auth::attempt($user_data))
     {
        $this->authenticated($request,$user_data);
         return redirect('/home');
     }
     else
     {
      return back()->with('error', 'Wrong Login Details');
     }

    }
    public function GetQuotes(Request $request){

    }
}
