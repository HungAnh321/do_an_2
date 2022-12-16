<?php

namespace App\Http\Controllers;

use App\Utilities\Constant;
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite;
use App\Models\User;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();

    }

    public function callback($provider)
    {

        $getInfo = Socialite::driver('google')->stateless()->user();

        $user = $this->createUser($getInfo,$provider);

        auth()->login($user);

        return redirect('/');

    }
    function createUser($getInfo,$provider){

        $user = User::where('provider_id', $getInfo->id)->first();

        if (!$user) {
            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id,
                'level' => Constant::user_level_client,
            ]);
        }
        return $user;
    }
}
