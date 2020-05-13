<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class LoginSocialiteController extends Controller
{
    public function loginGoogle(){

        return Socialite::with('Google')->redirect();
    }
    public function loginGoogleCallback(){
        try {
            $googleUser = Socialite::driver('Google')->user();
        }
        catch (\Exception $e){
            return redirect('/login');
        }
        $systemUser = User::where('email', $googleUser->email)->get()->first();

        if($systemUser){
            $systemUser ->google_id = $googleUser->id;
            $systemUser->save();
        }
        else{
            $systemUser = User::where('google_id', $googleUser->id)->first();
            if ( ! $systemUser ){
                $systemUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'username'=>  Str::replaceFirst('-','',Str::slug($googleUser->name)),
                    'google_id' =>  $googleUser->id
                ]);
                Profile::create([
                    'user_id' =>$systemUser->id,
                    'title'=>'Login google by '.$systemUser->name.'',
                ]);
            }
        }
        Auth::loginUsingId($systemUser->id);
        return redirect('/');
    }
    public function loginFacebook(){
        return Socialite::with('Facebook')->redirect();
    }
    public function loginFacebookCallback(){
        try {
            $facebookUser = Socialite::driver('Facebook')->user();
        }
        catch (\Exception $e){
            return redirect('/login');
        }
        $systemUser = User::where('email', $facebookUser->email)->get()->first();

        if($systemUser){
            $systemUser ->facebook_id = $facebookUser->id;
            $systemUser->save();
        }
        else{
            $systemUser = User::where('facebook_id', $facebookUser->id)->first();
            if ( ! $systemUser ){
                $systemUser = User::create([
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'username'=>  Str::replaceFirst('-','',Str::slug($facebookUser->name)),
                    'facebook_id' =>  $facebookUser->id
                ]);
                Profile::create([
                    'user_id' =>$systemUser->id,
                    'title'=>'Login facebook by '.$systemUser->name.'',
                ]);
            }
        }
        Auth::loginUsingId($systemUser->id);
        return redirect('/');
    }
}
