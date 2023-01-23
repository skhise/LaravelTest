<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Quotes;
use Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;


class UserController extends Controller
{
    //
    public function index(Request $request){
        return view('login');
    }
    public function home(Request $request){
        $this->GetQuotes($request);
        $quotes = Quotes::orderBy("created_at","DESC")->limit(5)->get();
        return view('home',['quotes' => $quotes]);
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
         return redirect('/home');
     }
     else
     {
      return back()->with('error', 'Wrong Login Details');
     }

    }
    public function GetQuotes(Request $request){
        for($i=0;$i<5;$i++){
            $response = Http::get('https://api.kanye.rest');
            Quotes::create(['name'=>$response['quote']]);
        }
    }
    function logout()
    {
     Auth::logout();
     return redirect('login');
    }
}
