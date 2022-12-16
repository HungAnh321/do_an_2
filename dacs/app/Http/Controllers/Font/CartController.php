<?php

namespace App\Http\Controllers\Font;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Sevice\Product\ProductSeviceInterface;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Redirect;


class CartController extends Controller
{
    private $productSevice;
    public function __construct(ProductSeviceInterface $productSevice)
    {
        $this->productSevice = $productSevice;
    }
    public function index(){
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();

        return view('front.shop.cart', compact('carts', 'total', 'subtotal'));
    }
    public function add(Request $request){
        $products = $this->productSevice->find($request->productId);

        if($request->ajax()){
            $response['cart'] = Cart::add([
                'id' => $products->id,
                'name' => $products->name,
                'qty' => 1,
                'price' => $products->discount ?? $products->price,
                'weight' => $products->weight ?? 0,
                'options' => [
                    'images' => $products->productImage,
                ],
            ]);
            $response['count'] = Cart::count();
            $response['total'] = Cart::total();

            return $response;
        }

        return back();
    }
    public function delete(Request $request){
        if($request->ajax()){
            $response['cart'] = Cart::remove($request->rowId);

            $response['subtotal'] = Cart::subtotal();
            $response['count'] = Cart::count();
            $response['total'] = Cart::total();

            return $response;
        }

        return back();
    }
    public function destroy(){
        Cart::destroy();
    }
    public function update(Request $request){
        if($request->ajax()){
            $response['cart'] = Cart::update($request->rowId, $request->qty);

            $response['count'] = Cart::count();
            $response['total'] = Cart::total();
            $response['subtotal'] = Cart::subtotal();

            return $response;
        }
    }
    public function save_cart(Request $request){
        $productid = $request->productid_hidden;
        $quantity = $request->qty;

        $product_info = Product::where('id', $productid)->first();
        $image = $product_info->productImage[0]->path;

        $data['id'] = $product_info->id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->name;
        $data['price'] = $product_info->price;
        $data['weight'] = '123';
        $data['options']['images'] = $image;

        Cart::add($data);
        return Redirect::to('/cart');

    }
    public function check_coupon(Request $request){
        $data = $request->all();
        print_r($data);
    }
}
