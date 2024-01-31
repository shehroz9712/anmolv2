<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
class TwitterController extends Controller
{
    public function loginwithTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }
       
    public function cbTwitter()
    {
        try {
     
            $user = Socialite::driver('twitter')->user();
      
            $userWhere = User::where('twitter_id', $user->id)->first();
      
            if($userWhere){
      
                Auth::login($userWhere);
     
                return redirect('/home');
      
            }else{
                $gitUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'twitter_id'=> $user->id,
                    'oauth_type'=> 'twitter'
                ]);
     
                Auth::login($gitUser);
      
                return redirect('/home');
            }
     
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }
   
}