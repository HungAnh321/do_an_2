@extends('front.layout.masters')
@section('title', 'Cart Products')
@section('body1')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="./">Home</a>
                            <a href="./shop">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <div class="cart-table">
                            @if(Cart::count()>0)
                        <table>
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th><i onclick="confirm('Bạn có chắc chắn muốn xóa toàn bộ ?') === true ? destroyCart() : ''"
                                                           style="cursor: pointer" class="fa fa-close"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($carts as $carts)
                            <tr data-rowid="{{$carts->rowId}}">
                                <td class="product__cart__item">
                                    <div class="product__cart__item__pic">
                                        <img style=" height: 100px" src="front/img/products/{{$carts->options->images}}" alt="">
                                    </div>
                                    <div class="product__cart__item__text">
                                        <h6>{{$carts->name}}</h6>
                                        <h5>$ {{number_format($carts->price)}}</h5>
                                    </div>
                                </td>
                                <td class="quantity__item">
                                    <div class="quantity">
                                        <div class="pro-qty-2">
                                            <input type="text" value="{{$carts->qty}}" data-rowid="{{$carts->rowId}}">
                                        </div>
                                    </div>
                                </td>
                                <td class="cart__price">$ {{number_format($carts->price * $carts->qty) }}</td>
                                <td class="cart__close"><i onclick="removeCart('{{$carts->rowId}}')" style="cursor: pointer" class="fa fa-close"></i></td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                            @else
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th><i onclick="confirm('Bạn có chắc chắn muốn xóa toàn bộ ?') === true ? destroyCart() : ''"
                                               style="cursor: pointer" class="fa fa-close"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td colspan="3">
                                            <h3>Your Cart Empty!</h3>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="./shop">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
{{--                        <h6>Discount codes</h6>--}}
{{--                        <form action="#">--}}
{{--                            <input type="text" placeholder="Coupon code">--}}
{{--                            <button type="submit">Apply</button>--}}
{{--                        </form>--}}
                        <h6>Discount codes</h6>
                        <form action="{{url('/check-coupon')}}" method="post">
                            @csrf
                            <input type="text" name="coupon" placeholder="Coupon code">
                            <input type="submit" value="Apply" name="check-coupon" class="btn-dark"></input>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal <span>$ {{$subtotal}}</span></li>
                            <li>Total <span>$ {{$total}}</span></li>
                        </ul>
                        <a href="./checkout" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection
