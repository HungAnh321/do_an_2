<?php

namespace App\Http\Controllers\Admin;

use App\Social; //sử dụng model Social
use Socialite; //sử dụng Socialite
use App\Models\User; //sử dụng model Login
use Validator;

use Exception;

use App\Http\Controllers\Controller;
use App\Utilities\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /*public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }
    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri
            $account_name = User::where('id',$account->user)->first();
            Session::put('name',$account_name->admin_name);
            Session::put('id',$account_name->admin_id);
            return redirect('/')->with('message', 'Đăng nhập Admin thành công');
        }else{

            $hieu = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = User::where('email',$provider->getEmail())->first();

            if(!$orang){
                $orang = User::create([
                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => '',
                    'phone' => '',

                ]);
            }
            $hieu->login()->associate($orang);
            $hieu->save();

            $account_name = User::where('notification',$account->user)->first();

            Session::put('name',$account_name->admin_name);
            Session::put('id',$account_name->admin_id);
            return redirect('/admin/dashboard')->with('message', 'Đăng nhập Admin thành công');
        }
        return 'call';
    }*/


//    public function redirectToFacebook()
//    {
//        return Socialite::driver('facebook')->redirect();
//    }
//
//    public function facebookSignin()
//    {
//        try {
//
//            $user = Socialite::driver('facebook')->user();
//            $facebookId = User::where('facebook_id', $user->id)->first();
//
//            if($facebookId){
//                Auth::login($facebookId);
//                return redirect('/dashboard');
//            }else{
//                $createUser = User::create([
//                    'name' => $user->name,
//                    'email' => $user->email,
//                    'facebook_id' => $user->id,
//                    'password' => encrypt('john123')
//                ]);
//
//                Auth::login($createUser);
//                return redirect('/dashboard');
//            }
//
//        } catch (Exception $exception) {
//            dd($exception->getMessage());
//        }
//    }

    public function getLogin(){
        return view('admin.login');
    }
    public function postLogin(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => [Constant::user_level_host, Constant::user_level_admin], //account host or admin
        ];
        $remenber = $request->remenber;

        if(Auth::attempt($credentials, $remenber)){
            return redirect()->intended('admin/user');//mặc định l trang củ
        }else{
            return back()->with('notification', 'Lỗi, Đăng nhập thất bại!');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('admin/login');
    }

}
