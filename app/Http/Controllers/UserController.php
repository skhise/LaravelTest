<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Quotes;
use Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use Cache;

class UserController extends Controller
{
    //
    public function index(Request $request){
        return view('login');
    }
    public function home(Request $request){
        $now = Carbon::now();
        $user = Auth::user();
        $user->last_seen_at = $now->format('Y-m-d H:i:s');
        $user->save();
        $quotes = array();
        if(Cache::has('quotes')){
            $quotes=Cache::get('quotes');
        } else {
            $quotes = $this->GetQuotes($request);
        }
        //dd($quotes);
        //$this->GetQuotes($request);
       // $quotes = Quotes::orderBy("created_at","DESC")->limit(5)->get();
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
        $user = Auth::user();
        $now = Carbon::now();
        $user->last_seen_at = $now->format('Y-m-d H:i:s');
        $user->save();
         return redirect('/home');
     }
     else
     {
      return back()->with('error', 'Wrong Login Details');
     }

    }
    public function GetQuotes(Request $request){
        $quotes = [];
        for($i=0;$i<5;$i++){
            $response = Http::get('https://api.kanye.rest');
            $now = Carbon::now();
            $arr['id'] = $i+1;
            $arr['name'] =$response['quote'];
            $arr['created_at'] = $now->format('Y-m-d H:i:s');
            array_push($quotes,$arr);
            
        }
        Cache::put('quotes',$quotes,now()->addMinutes(1));
        return $quotes;
    }
    function logout()
    {
     Auth::logout();
     return redirect('login');
    }
}
