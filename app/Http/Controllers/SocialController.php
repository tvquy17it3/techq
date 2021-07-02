<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use App\DripEmailer;
use App\Mail\NewMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Date;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    
    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->user();
        $user = $this->createUser($getInfo,$provider);
        auth()->login($user);
    
        return redirect()->to('/');
    
    }
    function createUser($getInfo,$provider){
        $user = User::where('provider_id', $getInfo->id)->first();
        
        if (!$user) {
            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider_name' => $provider,
                'provider_id' => $getInfo->id,
                'profile_photo_path'    => $getInfo->avatar,
                'password'=>Hash::make(rand(0,9999999))
            ]);
            $detail =[
                'title'=>'Chào mừng bạn đến với Q',
                'body'=>'Chao mung!'
            ];
            $user->forceFill(['email_verified_at' => Date::now(),'profile_photo_path'    => $getInfo->avatar,])->save();
            Mail::to($getInfo->email)->send(new NewMail($detail));
        }
        return $user;
    }
}
