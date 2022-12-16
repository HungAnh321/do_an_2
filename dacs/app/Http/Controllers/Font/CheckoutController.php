<?php

namespace App\Http\Controllers\Font;

use App\Http\Controllers\Controller;
use App\Sevice\Order\OrderSeviceInterface;
use App\Sevice\OrderDetail\OrderDetailSeviceInterface;
use App\Utilities\Constant;
use App\Utilities\VNPay;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    private $orderSevice;
    private $orderDetailSevice;

    public function __construct(OrderSeviceInterface $orderSevice,
                                OrderDetailSeviceInterface $orderDetailSevice)
    {
        $this->orderSevice = $orderSevice;
        $this->orderDetailSevice = $orderDetailSevice;
    }


    public function index(){
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();
        return view('front.checkout.index',  compact('carts', 'total', 'subtotal'));
    }
    public function addOrder(Request $request){
        //Thêm đơn hàng
        $data = $request->all();
        $data['status'] = Constant::order_status_ReceiveOrders;
        $order = $this->orderSevice->create($data);

        //Thêm chi tiết đơn hàng
        $carts = Cart::content();

        foreach ($carts as $cart){
            $data = [
                'order_id' => $order->id,
                'product_id' => $cart->id,
                'qty' => $cart->qty,
                'amount' => $cart->price,
                'total' => $cart->qty * $cart->price,
            ];
            $this->orderDetailSevice->create($data);
        }
        if($request->payment_type == 'pay_later'){
            //Gui mail

            $total = Cart::total();
            $subtotal = Cart::subtotal();
            $this->sendEmail($order, $subtotal, $total);//goi ham gui mail da dinh nghia

            //Xóa giỏ hàng
            Cart::destroy();

            //Trả về kết quả thông báo
            return redirect('checkout/result')->with('notification', 'Successful payment! Please check your mail');
        }
        if($request->payment_type == 'pay_online'){
            // Lấy URL thanh toán
            $data_url = VNPay::vnpay_create_payment([
                'vnp_TxnRef' => $order->id, //id đơn hàng
                'vnp_OrderInfo' => 'Mô tả đơn hàng ', //Mô tả đơn hàng
                'vnp_Amount' => Cart::total(0,'','')*23085, //tổng giá của đơn hàng

            ]);
            //Chuyển hướng đến URL lấydduowjc
            return redirect()->to($data_url);
        }

    }
    public function vnPayCheck(Request $request){
        //Lấy data từ URL (do VNPAY gửi về Returnurl)
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');//Mã phản hồi kết quả thanh toán. 00 = thành công
        $vnp_TxnRef = $request->get('vnp_TxnRef');//Order_id
        $vnp_Amount = $request->get('vnp_Amount');//Số tiền thanh toán

        //Kiểm tra data xem kết quả giao dịch có hợp lệ hay không
        if($vnp_ResponseCode != null){
            //Nếu thành công
            if($vnp_ResponseCode == 00){
                //Cập nhật trạng thái Order
                $this->orderSevice->update([
                    'status' => Constant::order_status_Paid
                ], $vnp_TxnRef);
                //gui mail
                $order = $this->orderSevice->find($vnp_TxnRef);//ni lla order_id
                $total = Cart::total();
                $subtotal = Cart::subtotal();
                $this->sendEmail($order, $subtotal, $total);//goi ham gui mail da dinh nghia

                //Xóa giỏ hàng
                Cart::destroy();
                //thông báo kết quả
                return redirect('checkout/result')->with('notification', 'Successful payment! Please check your mail');

            }else{//Nếu không thành công
                //Xóa đơn hàng đã lưu vào database
                $this->orderSevice->delete($vnp_TxnRef);


                //thông báo lỗi
                return redirect('checkout/result')->with('notification', 'Payment failure! ');

            }
        }
    }
    public function result(){
        $notification = session('notification');
        return view('front.checkout.result', compact('notification'));
    }
    private function sendEmail($order, $total, $subtotal){
        $email_to = $order->email;
        Mail::send('front.checkout.email', compact('order', 'total', 'subtotal'),
            function ($message) use ($email_to){
                $message->from('truonghungjjs@gmail.com', 'Sport Shop');
                $message->to($email_to, $email_to);
                $message->subject('Oder Notification');
        });
    }
}
