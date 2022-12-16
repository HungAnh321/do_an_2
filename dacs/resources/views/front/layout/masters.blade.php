<!DOCTYPE html>
<html lang="zxx">

<head>
    <base href="{{asset('/')}}">
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | Sport Shop</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
          rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@1.0/dist/tailwind.min.css" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="front/fronts/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="front/fronts/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="front/fronts/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="front/fronts/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="front/fronts/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="front/fronts/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="front/fronts/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="front/fronts/css/style.css" type="text/css">

    <link rel="stylesheet" href="front/css/jquery-ui.min.css" type="text/css">
    <script src="https://kit.fontawesome.com/3d8803ff5e.js" crossorigin="anonymous"></script>
</head>

<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__option">
        <div class="offcanvas__links">
            <a href="./account/login">Sign in</a>
            <a href="#">FAQs</a>
        </div>

    </div>
    <div class="offcanvas__nav__option">
        <a href="#" class=""><img src="{{url('front/fronts/img/icon/search.png')}}" alt=""></a>
        <a href="#"><img src="front/fronts/img/icon/heart.png" alt=""></a>
        <a href="#"><img src="front/fronts/img/icon/cart.png" alt=""> <span>0</span></a>
        <div class="price">0.00</div>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__text">
        <p>WELCOME TO OUR STORE! WISHING YOU A HAPPY NEW DAY.</p>
    </div>
</div>
<!-- Offcanvas Menu End -->



<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="header__top__left">
                        <p style="color: yellow"><marquee attribute_name ="value"....>
                              WELCOME TO OUR STORE! WISHING YOU A HAPPY NEW DAY.
                            </marquee></p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <div class="header__top__links">
                            @if(\Illuminate\Support\Facades\Auth::check())
                                <style>
                                    /* Thiết lập vị trí cho thẻ div với class dropdown*/
                                    .dropdown {
                                        position: relative;
                                        display: inline-block;
                                    }

                                    /* Nội dung Dropdown */
                                    .noidung_dropdown {
                                        /*Ẩn nội dụng các đường dẫn*/
                                        display: none;
                                        margin-top: 10px;
                                        border-radius: 10px;
                                        margin-left: 80px;
                                        position: absolute;
                                        background-color: black;
                                        min-width: 130px;
                                        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                                        z-index: 10;
                                    }

                                    /* Thiết kế style cho các đường dẫn tronng Dropdown */
                                    .noidung_dropdown a {
                                        color: yellow;
                                        /*padding: 10px 10px;*/
                                        text-decoration: none;
                                        display: block;
                                        border-radius: 10px;
                                    }

                                    .hienThi {
                                        display: table;
                                    }

                                    /* thay đổi màu background khi hover vào đường dẫn */
                                    .noidung_dropdown a:hover {
                                        background-color: white;
                                    }
                                </style>
                                <script>
                                    function hamDropdown() {
                                        document.querySelector(".noidung_dropdown").classList.toggle("hienThi");
                                    }

                                    window.onclick = function (e) {
                                        if (!e.target.matches('.nut_dropdown')) {
                                            var noiDungDropdown = document.querySelector(".noidung_dropdown");
                                            if (noiDungDropdown.classList.contains('hienThi')) {
                                                noiDungDropdown.classList.remove('hienThi');
                                            }
                                        }
                                    }
                                </script>
                                <div class="dropdown login-panel">
                                    <button onclick="hamDropdown()" class="nut_dropdown" style="color: white">
                                        Hello,
                                        {{ \Illuminate\Support\Facades\Auth::user()->name }}
                                        <i class="fa-solid fa-caret-down"></i>
                                    </button>
                                    <div class="noidung_dropdown">
                                        <a href=""><i class="fa-solid fa-user"></i>Account</a>
                                        <a href="./account/logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
                                        <a href=""><i class="fa-solid fa-user"></i>Account</a>
                                    </div>
                                </div>
                            @else
                                <a href="./account/login" class="login-panel"><i class="fa fa-user"></i>Login</a>
                            @endif
                        </div>
                        <div class="header__top__hover">
                            <span>Usd <i class="arrow_carrot-down"></i></span>
                            <ul style="width: 200px; height: 300px">
                                <li>USD</li>
                            </ul>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="./index.html"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class="{{(request()->segment(1) == '') ? 'active' : ''}}"><a href="./">Home</a></li>
                        <li class="{{(request()->segment(1) == 'shop') ? 'active' : ''}}"><a href="./shop">Shop</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="./about.html">About Us</a></li>
                                <li><a href="./shop-details.html">Shop Details</a></li>
                                <li><a href="./cart">Shopping Cart</a></li>
                                <li><a href="./checkout.html">Check Out</a></li>
                                <li><a href="./blog-details.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a href="./blogs">Blog</a></li>
                        <li><a href="./contact.html">Contacts</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">
                    <button style="padding-right: 20px" type="submit" class="search-switch"><img src="front/fronts/img/icon/search.png" alt=""></button>
                    <a href="#"><img src="front/fronts/img/icon/heart.png" alt=""></a>
                    <a href="./cart"><img style="padding-top: 3px" src="front/fronts/img/icon/cart.png" alt=""><span class="cart-count">{{Cart::count()}}</span></a>
                    <div class="price">${{Cart::total()}}</div>
                </div>

            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
<!-- Header Section End -->

@yield('body1')
<!-- Footer Section Begin -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="#"><img src="img/footer-logo.png" alt=""></a>
                    </div>
                    <p>The customer is at the heart of our unique business model, which includes design.</p>
                    <a href="#"><img src="img/payment.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Shopping</h6>
                    <ul>
                        <li><a href="#">Clothing Store</a></li>
                        <li><a href="#">Trending Shoes</a></li>
                        <li><a href="#">Accessories</a></li>
                        <li><a href="#">Sale</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Shopping</h6>
                    <ul>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Payment Methods</a></li>
                        <li><a href="#">Delivary</a></li>
                        <li><a href="#">Return & Exchanges</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6>NewLetter</h6>
                    <div class="footer__newslatter">
                        <p>Be the first to know about new arrivals, look books, sales & promos!</p>
                        <form action="#">
                            <input type="text" placeholder="Your email">
                            <button type="submit"><span class="icon_mail_alt"></span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="footer__copyright__text">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <p>Copyright ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>2020
                        All rights reserved | This template is made with <i class="fa fa-heart-o"
                                                                            aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    </p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form" action="">
            <input type="text" id="search-input" value="{{request('search')}}" name="search" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search End -->

<!-- Js Plugins -->
<script src="front/fronts/js/jquery-3.3.1.min.js"></script>
<script src="front/fronts/js/bootstrap.min.js"></script>
<script src="front/fronts/js/jquery.nice-select.min.js"></script>
<script src="front/fronts/js/jquery.magnific-popup.min.js"></script>
<script src="front/fronts/js/jquery.countdown.min.js"></script>
<script src="front/fronts/js/jquery.slicknav.js"></script>
<script src="front/fronts/js/mixitup.min.js"></script>
<script src="front/fronts/js/owl.carousel.min.js"></script>
<script src="front/fronts/js/main.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

{{--<script src="front/js/jquery-3.3.1.min.js"></script>--}}
{{--<script src="front/js/bootstrap.min.js"></script>--}}
{{--<script src="front/js/jquery-ui.min.js"></script>--}}
{{--<script src="front/js/jquery.nice-select.min.js"></script>--}}
{{--<script src="front/js/jquery.dd.min.js"></script>--}}
{{--<script src="front/js/jquery.slicknav.js"></script>--}}
{{--<script src="front/js/owl.carousel.min.js"></script>--}}
{{--<script src="front/js/main.js"></script>--}}
<!-- Messenger Plugin chat Code -->
<!-- Messenger Plugin chat Code -->
<div id="fb-root"></div>

<!-- Your Plugin chat code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "105573345731638");
    chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
    window.fbAsyncInit = function() {
        FB.init({
            xfbml            : true,
            version          : 'v15.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    var usd = document.getElementById("vnd_to_usd").value;
    paypal.Button.render({
        // Configure environment
        env: 'sandbox',
        client: {
            sandbox: 'Ae7Z2LkvT2nqZIcZP6V3PJglBwyULFlSKN5klOPORfQcEEKl9rtHcyjHKZrgH4zIQdTE9Oa1NjTHOeA3',
            production: 'demo_production_client_id'
        },
        // Customize button (optional)
        locale: 'en_US',
        style: {
            size: 'large',
            color: 'gold',
            shape: 'pill',
        },

        // Enable Pay Now checkout flow (optional)
        commit: true,

        // Set up a payment
        payment: function(data, actions) {
            return actions.payment.create({
                transactions: [{
                    amount: {
                        total: usd,
                        currency: 'USD'
                    }
                }]
            });
        },
        // Execute the payment
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                // Show a confirmation message to the buyer
                window.alert('Thank you for your purchase!');
            });
        }
    }, '#paypal-button');

</script>
<script>
    var proQty = $('.pro-qty-2');
    proQty.prepend('<span class="fa fa-angle-left dec qtybtn"></span>');
    proQty.append('<span class="fa fa-angle-right inc qtybtn"></span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);

        var rowId = $button.parent().find('input').data('rowid');
        updateCart(rowId, newVal);
    });

    const product_men = $(".product-slider.men");
    const product_women = $(".product-slider.women");

    $('.filter-control').on('click', '.item', function (){
        const $item = $(this);
        const filter = $item.data('tag');
        const category = $item.data('category');

        $item.siblings().removeClass('active');
        $item.addClass('active');

        if(category === 'men'){
            product_men.owlcarousel2_filter(filter);

        }
        if(category === 'women'){
            product_women.owlcarousel2_filter(filter);

        }
    });
</script>
<style>
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }
    .rate:not(:checked) > input {
        display: none;
    }
    .rate:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
    }
    .rate:not(:checked) > label:before {
        content: '★ ';
    }
    .rate > input:checked ~ label {
        color: #ffc700;
    }
    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        color: #deb217;
    }
    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label {
        color: #c59b08;
    }
</style>
<style>
    header .tickey{
        opacity: 0.9;
        background-color: whitesmoke;
    }
</style>
<script>
    $(document).ready(function (){
        $(window).scroll(function (){
            if($(this).scrollTop()){
                $('header').addClass('tickey');
            }
        })
    })
</script>
</body>

</html>
