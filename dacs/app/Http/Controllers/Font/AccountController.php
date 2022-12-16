<?php

namespace App\Http\Controllers\Font;

use App\Http\Controllers\Controller;
use App\Sevice\Order\OrderSeviceInterface;
use App\Sevice\User\UserSeviceInterface;
use App\Utilities\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    private $userSevice;
    private $orderSevice;

    public function __construct(UserSeviceInterface $userSevice, OrderSeviceInterface $orderSevice)
    {
        $this->userSevice = $userSevice;
        $this->orderSevice = $orderSevice;
    }

    public function login(){
        return view('front.account.login');
    }
    public function checkLogin(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => Constant::user_level_client,
        ];
        $remenber = $request->remenber;

        if(Auth::attempt($credentials, $remenber)){
            return redirect()->intended('');//mặc định l trang củ
        }else{
            return back()->with('notification', 'Lỗi, Đăng nhập thất bại!');
        }
    }
    public function logout(){
        Auth::logout();

        return back();
    }
    public function register(){
        return view('front.account.register');
    }
    public function postRegister(Request $request){
        if($request->password != $request->password_confirm){
            return back()->with('notification', 'Loi');
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => md5($request->password),
            'level' => Constant::user_level_client,
        ];

        $this->userSevice->create($data);
        return redirect('account/login')->with('notification', 'Dang ki thanh cong');
    }
    public function myOrderIndex(){

        $orders = $this->orderSevice->getOrderByUserId(Auth::id());

        return view('front.account.my-order.index', compact('orders'));
    }
    public function myOrderDetails($id){
        $order = $this->orderSevice->find($id);

        return view('front.account.my-order.show', compact('order'));
    }
}
