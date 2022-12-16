/*  ---------------------------------------------------
    Template Name: Male Fashion
    Description: Male Fashion - ecommerce teplate
    Author: Colorib
    Author URI: https://www.colorib.com/
    Version: 1.0
    Created: Colorib
---------------------------------------------------------  */

'use strict';

(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");

        /*------------------
            Gallery filter
        --------------------*/
        $('.filter__controls li').on('click', function () {
            $('.filter__controls li').removeClass('active');
            $(this).addClass('active');
        });
        if ($('.product__filter').length > 0) {
            var containerEl = document.querySelector('.product__filter');
            var mixer = mixitup(containerEl);
        }
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    //Search Switch
    $('.search-switch').on('click', function () {
        $('.search-model').fadeIn(400);
    });

    $('.search-close-switch').on('click', function () {
        $('.search-model').fadeOut(400, function () {
            $('#search-input').val('{{request(\'search\')}}');
        });
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*------------------
        Accordin Active
    --------------------*/
    $('.collapse').on('shown.bs.collapse', function () {
        $(this).prev().addClass('active');
    });

    $('.collapse').on('hidden.bs.collapse', function () {
        $(this).prev().removeClass('active');
    });

    //Canvas Menu
    $(".canvas__open").on('click', function () {
        $(".offcanvas-menu-wrapper").addClass("active");
        $(".offcanvas-menu-overlay").addClass("active");
    });

    $(".offcanvas-menu-overlay").on('click', function () {
        $(".offcanvas-menu-wrapper").removeClass("active");
        $(".offcanvas-menu-overlay").removeClass("active");
    });

    /*-----------------------
        Hero Slider
    ------------------------*/
    $(".hero__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<span class='arrow_left'><span/>", "<span class='arrow_right'><span/>"],
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: false
    });

    /*--------------------------
        Select
    ----------------------------*/
    $("select").niceSelect();

    /*-------------------
		Radio Btn
	--------------------- */
    $(".product__color__select label, .shop__sidebar__size label, .product__details__option__size label").on('click', function () {
        $(".product__color__select label, .shop__sidebar__size label, .product__details__option__size label").removeClass('active');
        $(this).addClass('active');
    });

    /*-------------------
		Scroll
	--------------------- */
    $(".nice-scroll").niceScroll({
        cursorcolor: "#0d0d0d",
        cursorwidth: "5px",
        background: "#e5e5e5",
        cursorborder: "",
        autohidemode: true,
        horizrailenabled: false
    });

    /*------------------
        CountDown
    --------------------*/
    // For demo preview start
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    if(mm == 12) {
        mm = '01';
        yyyy = yyyy + 1;
    } else {
        mm = parseInt(mm) + 1;
        mm = String(mm).padStart(2, '0');
    }
    var timerdate = mm + '/' + dd + '/' + yyyy;
    // For demo preview end


    // Uncomment below and use your date //

    /* var timerdate = "2020/12/30" */

    $("#countdown").countdown(timerdate, function (event) {
        $(this).html(event.strftime("<div class='cd-item'><span>%D</span> <p>Days</p> </div>" + "<div class='cd-item'><span>%H</span> <p>Hours</p> </div>" + "<div class='cd-item'><span>%M</span> <p>Minutes</p> </div>" + "<div class='cd-item'><span>%S</span> <p>Seconds</p> </div>"));
    });

    /*------------------
		Magnific
	--------------------*/
    $('.video-popup').magnificPopup({
        type: 'iframe'
    });

    /*-------------------
		Quantity change
	--------------------- */



    /*------------------
        Achieve Counter
    --------------------*/
    $('.cn_num').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 4000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });

///////////////////////////////////////


})(jQuery);


function addCart(productId){
    $.ajax({
        type: "GET",
        url: "cart/add",
        data: {productId: productId},
        success: function (response) {
            $('.cart-count').text(response['count']);
            $('.cart__total span').text('$' + response['total']);
            $('.price').text('$' + response['total']);

            var cartHover_tbody = $('.select-items tbody');
            var cartHover_existItem = cartHover_tbody.find("tr" + "[data-rowId='" + response['cart'].rowId + "']");

            if(cartHover_existItem.length){
                cartHover_existItem.find('.product-selected p').text(response['cart'].price.toFixed(2)+' VND '+'x '+response['cart'].qty);
            }else{
                var newItem =
                    '<tr data-rowId="' + response['cart'].rowId +'">\n' +
                    '<td class="si-pic"><img style="height: 70px" src="front/img/products/' + response['cart'].options.images[0].path + '" alt=""></td>\n' +
                    '<td class="si-text">\n' +
                    '    <div class="product-selected">\n' +
                    '        <p>' + response['cart'].price.toFixed(2)+' VND '+'x '+response['cart'].qty + '</p>\n' +
                    '        <h6>' + response['cart'].name + '</h6>\n' +
                    '   </div>\n' +
                    '</td>\n' +
                    '<td class="si-close">\n' +
                    '    <i onclick="removeCart(\'' + response['cart'].rowId + '\')" class="ti-close"></i>\n' +
                    '</td>\n' +
                    '</tr>  ' ;

                cartHover_tbody.append(newItem);
            }
            // alert('Thêm giỏ hàng thành công!\nSản phẩm: ' + response['cart'].name)
            swal("Thêm giỏ hàng thành công!","Sản phẩm:" + response['cart'].name, "success");
            console.log(response);

        },
        error: function (response) {
            alert('Thêm thất bại!');
            console.log(response);
        }
    })
}
function removeCart(rowId){
    $.ajax({
        type: "GET",
        url: "cart/delete",
        data: {rowId: rowId},
        success: function (response){

            $('.cart-count').text(response['count']);
            $('.cart__total span').text('$' + response['total']);
            $('.price').text('$' + response['total']);

            // var cartHover_tbody = $('.select-item tbody');
            // var cartHover_existItem = cartHover_tbody.find("tr" + "[data-rowId='" + rowId + "']");
            //
            // cartHover_existItem.remove();


            var cart_tbody = $('.cart-table tbody');
            var cart_existItem = cart_tbody.find("tr" + "[data-rowId='" + rowId + "']");

            cart_existItem.remove();

            alert('Xóa thành công! \n Product:' + response['cart'].name);
            console.log(response);
        },
        error: function (response){
            alert('Xóa lỗi');
            console.log(response);
        },
    });
}
function destroyCart(){
    $.ajax({
        type: "GET",
        url: "cart/destroy",
        data: {},
        success: function (response){

            $('.cart-count').text('0');
            $('.cart__total span').text('0');
            $('.price').text('0');

            var cartHover_tbody = $('.select-item tbody');
            cartHover_tbody.children().remove();


            var cart_tbody = $('.cart-table tbody');
            cart_tbody.children().remove();

            $('.subtotal span').text('0');
            $('.cart-total span').text('0');

            alert('Xóa thành công! \n Product:' + response['cart'].name);
            console.log(response);
        },
        error: function (response){
            alert('Xóa lỗi');
            console.log(response);
        },
    });
}
function updateCart(rowId, qty){
    $.ajax({
        type:"GET",
        url:"cart/update",
        data:{rowId: rowId, qty: qty},
        success: function (response){
            $('.cart-count').text(response['count']);
            $('.cart__total span').text('$' + response['total']);
            $('.price').text('$' + response['total']);

            var cartHover_tbody = $('.select-item tbody');
            var cartHover_existItem = cartHover_tbody.find("tr" + "[data-rowId='" + rowId + "']");
            if(qty === 0){
                cartHover_existItem.remove();
            }else{
                cartHover_existItem.find('.product-selected p').text(response['cart'].price.toFixed(2)+' VND '+'x '+response['cart'].qty);
            }

            //
            var cart_tbody = $('.cart-table tbody');
            var cart_existItem = cart_tbody.find("tr" + "[data-rowId='" + rowId + "']");
            if(qty === 0){
                cart_existItem.remove();
            }else{
                cart_existItem.find('.total-price').text((response['cart'].price * response['cart'].qty).toFixed(2) + ' VND');
            }
            $('.subtotal span').text('$' + response['subtotal']);
            $('.cart-total span').text('$' + response['total']);

            alert('Cập nhật giỏ hàng thành công!');
            console.log(response);
        },
        error: function (error){
            alert('Cập nhật lỗi');
            console.log(error);
        },

    });
}
