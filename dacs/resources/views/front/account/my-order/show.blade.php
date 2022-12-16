@extends('front.layout.masters')
@section('title', 'Order Details')
@section('body1')

    <<section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="./">Home</a>
                            <a href="./my-order">My Order</a>
                            <span>Order Details</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="coupon__code"><span class="icon_tag_alt"></span> <div class="checkout-content">
                                    <a href="#" class="content-btn">
                                        Order ID:
                                        <b>#{{$order->id}}</b>
                                    </a>
                                </div></h6>
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text"  name="first_name" value="{{$order->first_name}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="last_name" value="{{$order->last_name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Company Name<span>*</span></p>
                                <input type="text" name="company_name" value="{{$order->company_name}}">
                            </div>
                            <div class="checkout__input">
                                <p>Country/State<span>*</span></p>
                                <input type="text" name="country" value="{{$order->country}}">
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add"
                                       name="street_address" value="{{$order->street_address}}">
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name="postcode_zip" value="{{$order->postcode_zip}}">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="email" value="{{$order->email}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone" value="{{$order->phone}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                <div class="checkout__order__products">Product <span>Total</span></div>
                                <ul class="checkout__total__products">
                                    @foreach($order->orderDetails as $orderDetails)
                                        <li>
                                            {{$orderDetails->product->name}} x {{$orderDetails->qty}}
                                            <span>{{$orderDetails->total}}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Subtotal <span>$ {{array_sum(array_column($order->orderDetails->toArray(), 'total'))}}</span></li>
{{--                                    <li>Total <span>$ {{$subtotal}}</span></li>--}}
                                </ul>
                                <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Pay later
                                        <input onclick="toggleDiv()" type="radio" name="payment_type" value="pay_later" id="acc-or"
                                            {{$order->payment_type == 'pay_later' ? 'checked' : ''}}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Pay online
                                        <input onclick="toggleDiv()" type="radio" name="payment_type" value="pay_online" id="payment"
                                            {{$order->payment_type == 'online_payment' ? 'checked' : ''}}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
