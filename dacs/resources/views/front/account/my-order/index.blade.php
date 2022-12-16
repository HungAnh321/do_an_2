@extends('front.layout.masters')
@section('title', 'My Order')
@section('body1')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>My Order</h4>
                        <div class="breadcrumb__links">
                            <a href="./">Home</a>
                            <span>My Order</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Form Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Id</th>
                                <th class="p-name">Product</th>
                                <th>Total</th>
                                <th>Details</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="cart-pic first-row"><img style="padding-left: 26%; height: 120px" src="front/img/products/{{$order->orderDetails[0]->product->productImage[0]->path}}" alt=""></td>
                                        <td class="first-row">#{{$order->id}}</td>
                                        <td class="cart-title first-row">
                                            <h5>{{$order->orderDetails[0]->product->name}}
                                                @if(count($order->orderDetails)>1)
                                                (and {{count($order->orderDetails)}} other products)
                                                @endif
                                            </h5>
                                        </td>
                                        <td class="total-price first-row">
                                            $ {{array_sum(array_column($order->orderDetails->toArray(), 'total'))}}
                                        </td>
                                        <td class="first-row">
                                            <a class="btn" href="./my-order/{{$order->id}}">Details</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
@endsection
