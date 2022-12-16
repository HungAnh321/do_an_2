@extends('front.layout.masters')
@section('title', 'Product Details')
@section('body1')
    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="./">Home</a>
                            <a href="./shop">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach($products->productImage as $productImage)
                            <li class="nav-item">
                                <a class="nav-link " data-toggle="tab" href="#tabs{{$productImage->id}}" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="front/fronts/img/product/{{$productImage->path}}">
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs{{$products->productImage[0]->path}}" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="front/fronts/img/product/{{$products->productImage[0]->path}}" alt="">
                                </div>
                            </div>
                            @foreach($products->productImage as $productImage)
                            <div class="tab-pane " id="tabs{{$productImage->id}}" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="front/fronts/img/product/{{$productImage->path}}" alt="">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{$products->name}}</h4>
                            <div class="rating">
                                @for($i = 1; $i <=5; $i++)
                                    @if($i <= $products->avgRating)
                                        <i class="fa fa-star"></i>
                                    @else
                                        <i class="fa fa-star-o"></i>
                                    @endif
                                @endfor
                                <span>({{count($products->productComments)}})</span>
                            </div>
                            @if($products->discount != null)
                                <h3>${{$products->discount}} <span>{{$products->price}}</span></h3>
                            @else
                                <h3>${{$products->price}}</h3>
                            @endif
                            <p>{!!$products->content!!}</p>
                            <div class="product__details__option">
                                <div class="product__details__option__size">
                                    <label for="s-size" class={{request('size') == 's' ? 'active' : ''}}>s
                                        <input type="radio" id="s-size" name="size" value="s" onchange="this.form.submit();"
                                            {{request('size') == 's' ? 'checked' : ''}}>
                                    </label>
                                    <label for="m-size" class={{request('size') == 'm' ? 'active' : ''}}>m
                                        <input type="radio" id="m-size" name="size" value="m" onchange="this.form.submit();"
                                            {{request('size') == 'm' ? 'checked' : ''}}>
                                    </label>
                                    <label for="l-size" class={{request('size') == 'l' ? 'active' : ''}}>l
                                        <input type="radio" id="l-size" name="size" value="l" onchange="this.form.submit();"
                                            {{request('size') == 'l' ? 'checked' : ''}}>
                                    </label>
                                    <label for="xs-size" class={{request('size') == 'xs' ? 'active' : ''}}>xs
                                        <input type="radio" id="xs-size" name="size" value="xs" onchange="this.form.submit();"
                                            {{request('size') == 'xs' ? 'checked' : ''}}>
                                    </label>
                                    <label for="sl-size" class={{request('size') == 'sl' ? 'active' : ''}}>sl
                                        <input type="radio" id="sl-size" name="size" value="sl" onchange="this.form.submit();"
                                            {{request('size') == 'sl' ? 'checked' : ''}}>
                                    </label>
                                </div>
                                <div class="product__details__option__color">
                                    <span>Color:</span>
                                    @foreach(array_unique(array_column($products->productDetails->toArray(), 'color')) as $productColor)
                                    <label class="c-{{$productColor}}" for="sp-{{$productColor}}">
                                        <input type="radio" id="sp-{{$productColor}}">
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            <form action="{{URL::to('/save-cart')}}" method="post">
                                @csrf
                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text"name="qty" value="1">
                                        <input type="hidden" name="productid_hidden" value="{{$products->id}}">
                                    </div>
                                </div>
                                <button type="submit" class="primary-btn">add to cart</button>
                            </div>
                            </form>
                            <div class="product__details__btns__option">
                                <a href="#"><i class="fa fa-heart"></i> add to wishlist</a>
                                <a href="#"><i class="fa fa-exchange"></i> Add To Compare</a>
                            </div>
                            <div class="product__details__last__option">
                                <h5><span>Guaranteed Safe Checkout</span></h5>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <img style="height: 100px" src="front/fronts/img/pay.png" alt="">
                                    </div>
                                    <div class="col-lg-4">
                                        <img style="height: 100px" src="front/fronts/img/pay1.png" alt="">
                                    </div>
                                    <div class="col-lg-4">
                                        <img style="height: 100px" src="front/fronts/img/pay2.png" alt="">
                                    </div>
                                </div>
                                <ul>
                                    <li><span>SKU:</span> {{$products->sku}}</li>
                                    <li><span>Categories:</span> {{$products->ProductCategory->name}}</li>
                                    <li><span>Tag:</span> {{$products->tag}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                       role="tab">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                        Previews({{count($products->productComments)}})</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Additional
                                        information</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                                {!! $products->description !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="row">
                                            <div class="col-lg-4">
                                        <div class="customer-review-option">
                                            <h4 style="font-weight: bold">Rate Comment</h4>
                                            <br>
                                            <div class="comment-option">
                                                @foreach($products->productComments as $productComments)
                                                    <div class="co-item">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <div class="blog__details__author">
                                                                <div class="blog__details__author__pic">
                                                                    <img src="front/img/user/{{$productComments->user->avatar ?? 'default.jpg'}}" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="avatar-text">
                                                            <div class="at-rating">
                                                                @for($i =1; $i<=5; $i++)
                                                                    @if($i <= $productComments->rating)
                                                                        <i class="fa fa-star"></i>
                                                                    @else
                                                                        <i class="fa fa-star-o"></i>
                                                                    @endif
                                                                @endfor

                                                            </div>
                                                            <h5>{{$productComments->name}}<span style="font-size : 12px">  {{date('M d, Y', strtotime($productComments->created_at))}}</span></h5>
                                                            <div class="at-reply">{{$productComments->messages}}</div>
                                                            <br>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                            </div>
                                            <div class="col-lg-8">
                                            <div class="blog__details__comment">
                                                <h4>Leave A Comment</h4>
                                                <form action="" method="post">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{$products->id}}">
                                                    <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id ?? null}}">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <input type="text" placeholder="Name" name="name">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <input type="text" placeholder="Email" name="email">
                                                        </div>
                                                        <div class="col-lg-12 text-center">
                                                            <textarea placeholder="Comment" name="messages"></textarea>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="personal-rating">
                                                                <h6>Private start</h6>
                                                                <div class="rate">

                                                                    <input class="rate" type="radio" id="star5" name="rating" value="5" />
                                                                    <label for="star5" title="text">5 stars</label>
                                                                    <input type="radio" id="star4" name="rating" value="4" />
                                                                    <label for="star4" title="text">4 stars</label>
                                                                    <input type="radio" id="star3" name="rating" value="3" />
                                                                    <label for="star3" title="text">3 stars</label>
                                                                    <input type="radio" id="star2" name="rating" value="2" />
                                                                    <label for="star2" title="text">2 stars</label>
                                                                    <input type="radio" id="star1" name="rating" value="1" />
                                                                    <label for="star1" title="text">1 star</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 text-center">
                                                            <button type="submit" class="site-btn">Post Comment</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-7" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="shopping__cart__table" style="padding-left: 80px">
                                            <table style="margin-bottom: 60px; font-size: 20px">
                                                <tr>
                                                    <td class="p-catagory">Customer Rating</td>
                                                    <td>
                                                        <div class="pd-rating">
                                                            @for($i =1; $i<=5; $i++)
                                                                @if($i <= $products->avgRating)
                                                                    <i class="fa fa-star"></i>
                                                                @else
                                                                    <i class="fa fa-star-o"></i>
                                                                @endif
                                                            @endfor
                                                            <span>({{count($products->productComments)}})</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="p-catagory">Price</td>
                                                    <td>
                                                        <div class="p-price">{{$products->price}}</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="p-catagory">Add To Cart</td>
                                                    <td>
                                                        <div class="cart-add">+ add to cart</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="p-catagory">Availability</td>
                                                    <td>
                                                        <div class="p-stock">{{$products->qty}} in stock</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="p-catagory">Weight</td>
                                                    <td>
                                                        <div class="p-weight">{{$products->weight}}kg</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="p-catagory">Size</td>
                                                    <td>
                                                        <div class="p-size">
                                                            @foreach(array_unique(array_column($products->productDetails->toArray(), 'size')) as $productSize)
                                                                {{$productSize}}
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="p-catagory">Color</td>
                                                    <td>
                                                        @foreach(array_unique(array_column($products->productDetails->toArray(), 'color')) as $productColor)
                                                            {{$productColor}}
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="p-catagory">Sku</td>
                                                    <td>
                                                        <div class="p-code">{{$products->sku}}</div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Related Product</h3>
                </div>
            </div>
            <div class="row">
                @foreach($relateProducts as $products)
                <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="front/img/products/{{$products->productImage[0]->path}}">
                            <ul class="product__hover">
                                <li><a href="#"><img src="front/fronts/img/icon/heart.png" alt=""></a></li>
                                <li><a href="#"><img src="front/fronts/img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                                <li><a href="shop/product/{{$products->id}}"><img src="front/fronts/img/icon/search.png" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>{{$products->name}}</h6>
                            <a href="javascript:addCart({{$products->id}})" class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                @for($i = 1; $i <=5; $i++)
                                    @if($i <= $products->avgRating)
                                        <i class="fa fa-star"></i>
                                    @else
                                        <i class="fa fa-star-o"></i>
                                    @endif
                                @endfor
                                <span>({{count($products->productComments)}})</span>
                            </div>
                            <h5>@if($products->discount != null)
                                    $ {{$products->discount}}
                                    <del> {{$products->price}}</del>
                                @else
                                    $ {{$products->price}}
                                @endif</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <style>
        .product__details__option__color label.c-black {
            background: #0b090c;
        }

        .product__details__option__color label.c-blue {
            background: #20315f;
        }

        .product__details__option__color label.c-yellow {
            background: #f1af4d;
        }

        .product__details__option__color label.c-grey {
            background: #636068;
        }

        .product__details__option__color label.c-green {
            background: #57594d;
        }

        .product__details__option__color label.c-6 {
            background: #e8bac4;
        }

        .product__details__option__color label.c-pink {
            background: #d6c1d7;
        }

        .product__details__option__color label.c-red {
            background: #ed1c24;
        }

        .product__details__option__color label.c-white {
            background: #ffffff;
        }
    </style>
    <!-- Related Section End -->
@endsection
