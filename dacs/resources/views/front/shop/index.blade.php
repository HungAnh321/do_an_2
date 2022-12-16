@extends('front.layout.masters')
@section('title', 'Product Shop')
@section('body1')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="">
                                <input type="text" placeholder="Search..." value="{{request('search')}}" name="search">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <form action="">
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    <li><a href="#">
                                                    @foreach($category as $category)
                                                        <li><a href="shop/category/{{$category->name}}">{{$category->name}}</a></li>
                                                        @endforeach
                                                        </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__brand">
                                                <div class="fw-brand-check">
                                                    @foreach($brands as $brands)
                                                        <div class="bc-item">
                                                            <label for="bc-{{$brands->id}}">
                                                                {{$brands->name}}
                                                                <input type="checkbox"
                                                                       {{(request("brand")[$brands->id] ?? '') == 'on' ? 'checked' : ''}}
                                                                       id="bc-{{$brands->id}}"
                                                                       name="brand[{{$brands->id}}]"
                                                                       onchange="this.form.submit();">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                <div class="filter-range-wrap">
                                                    <div class="range-slider">
                                                        <div class="price-input">
                                                            <input type="text" id="minamount" name="price_min">
                                                            <input type="text" id="maxamount" name="price_max">
                                                        </div>
                                                    </div>
                                                    <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                                         data-min="33" data-max="600"
                                                         data-min-value="{{str_replace('', '', request('price-min'))}}"
                                                         data-max-value="{{str_replace('', '', request('price-max'))}}">
                                                        <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                                        <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                                        <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                                    </div>
                                                </div>
                                                <button type="submit" class="filter-btn">Lọc giá</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                    </div>
                                    <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__size">
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
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFive">Colors</a>
                                    </div>
                                    <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                                <input type="radio" id="cs-black" name="color" value="black" onchange="this.form.submit();"
                                                    {{request('color') == 'black' ? 'checked' : ''}}>
                                                <label class="cs-black {{request('color') == 'black' ? 'font-weight-bold' : ''}}" for="cs-black">Black</label>
                                                <input type="radio" id="cs-yellow" name="color" value="yellow" onchange="this.form.submit();"
                                                    {{request('color') == 'yellow' ? 'checked' : ''}}>
                                                <label class="cs-yellow {{request('color') == 'yellow' ? 'font-weight-bold' : ''}}" for="cs-yellow">Yellow</label>
                                                <input type="radio" id="cs-violet" name="color" value="violet" onchange="this.form.submit();"
                                                    {{request('color') == 'violet' ? 'checked' : ''}}>
                                                <label class="cs-violet {{request('color') == 'violet' ? 'font-weight-bold' : ''}}" for="cs-violet">Violet</label>
                                                <input type="radio" id="cs-green" name="color" value="green" onchange="this.form.submit();"
                                                    {{request('color') == 'green' ? 'checked' : ''}}>
                                                <label class="cs-green {{request('color') == 'green' ? 'font-weight-bold' : ''}}" for="cs-green">Green</label>
                                                <input type="radio" id="cs-red" name="color" value="red" onchange="this.form.submit();"
                                                    {{request('color') == 'red' ? 'checked' : ''}}>
                                                <label class="cs-red {{request('color') == 'red' ? 'font-weight-bold' : ''}}" for="cs-red">Red</label>
                                                <input type="radio" id="cs-blue" name="color" value="blue" onchange="this.form.submit();"
                                                    {{request('color') == 'blue' ? 'checked' : ''}}>
                                                <label class="cs-blue {{request('color') == 'blue' ? 'font-weight-bold' : ''}}" for="cs-blue">Blue</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <form action="">
                                        <div class="select-option">
                                            <select name="sort_by" onchange="this.form.submit();" class="sorting">
                                                <option {{request('sort_by') == 'latest' ? 'selected' : ''}} value="latest">Sort By: Mới nhất</option>
                                                <option {{request('sort_by') == 'oldest' ? 'selected' : ''}}  value="oldest">Sort By: Cũ nhất</option>
                                                <option {{request('sort_by') == 'price_acs' ? 'selected' : ''}} value="price_acs">Sort By: Giá cao đến thấp</option>
                                                <option {{request('sort_by') == 'price_dec' ? 'selected' : ''}} value="price_dec">Sort By: Giá thấp đến cao</option>
                                                <option {{request('sort_by') == 'name_acs' ? 'selected' : ''}} value="name_acs">Sort By: Theo tên A-Z</option>
                                                <option {{request('sort_by') == 'name_dec' ? 'selected' : ''}} value="name_dec">Sort BY: Theo tên Z-A</option>
                                            </select>
                                            <select name="show" onchange="this.form.submit();" class="p-show">
                                                <option {{request('show') == '6' ? 'selected' : ''}} value="6">View: 6</option>
                                                <option {{request('show') == '9' ? 'selected' : ''}} value="9">View: 9</option>
                                                <option {{request('show') == '12' ? 'selected' : ''}} value="12">View: 12</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="front/fronts/img/product/{{$product->productImage[0]->path}}">
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="front/fronts/img/icon/heart.png" alt=""></a></li>
                                        <li><a href="#"><img src="front/fronts/img/icon/compare.png" alt=""> <span>Compare</span></a>
                                        </li>
                                        <li><a href="shop/product/{{$product->id}}"><img src="front/fronts/img/icon/search.png" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{$product->name}}</h6>
                                    <a href="javascript:addCart({{$product->id}})" class="add-cart">+ Add To Cart</a>
                                    <div class="rating">
                                        @for($i = 1; $i <=5; $i++)
                                            @if($i <= $product->avgRating)
                                                <i class="fa fa-star"></i>
                                            @else
                                                <i class="fa fa-star-o"></i>
                                            @endif
                                        @endfor
                                        <span>({{count($product->productComments)}})</span>
                                    </div>
                                    <h5>
                                        @if($product->discount != null)
                                            $ {{$product->discount}}
                                            <del> {{$product->price}}</del>
                                        @else
                                            $ {{$product->price}}
                                        @endif
                                    </h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                                {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
@endsection
