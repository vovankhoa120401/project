/*  ---------------------------------------------------
    Template Name: Ogani
    Description:  Ogani eCommerce  HTML Template
    Author: Colorlib
    Author URI: https://colorlib.com
    Version: 1.0
    Created: Colorlib
---------------------------------------------------------  */
var baseUrl = "http://localhost/project";
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
var pathArray = window.location.pathname.split('/');

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
        $('.featured__controls li').on('click', function () {
            $('.featured__controls li').removeClass('active');
            $(this).addClass('active');
        });
        if ($('.featured__filter').length > 0) {
            var containerEl = document.querySelector('.featured__filter');
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

    //Humberger Menu
    $(".humberger__open").on('click', function () {
        $(".humberger__menu__wrapper").addClass("show__humberger__menu__wrapper");
        $(".humberger__menu__overlay").addClass("active");
        $("body").addClass("over_hid");
    });

    $(".humberger__menu__overlay").on('click', function () {
        $(".humberger__menu__wrapper").removeClass("show__humberger__menu__wrapper");
        $(".humberger__menu__overlay").removeClass("active");
        $("body").removeClass("over_hid");
    });

    /*------------------
        Navigation
    --------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*-----------------------
        Categories Slider
    ------------------------*/
    $(".categories__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 4,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {

            0: {
                items: 1,
            },

            480: {
                items: 2,
            },

            768: {
                items: 3,
            },

            992: {
                items: 4,
            }
        }
    });


    $('.hero__categories__all').on('click', function () {
        $('.hero__categories ul').slideToggle(400);
    });

    /*--------------------------
        Latest Product Slider
    ----------------------------*/
    $(".latest-product__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*-----------------------------
        Product Discount Slider
    -------------------------------*/
    $(".product__discount__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 3,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {

            320: {
                items: 1,
            },

            480: {
                items: 2,
            },

            768: {
                items: 2,
            },

            992: {
                items: 3,
            }
        }
    });

    /*---------------------------------
        Product Details Pic Slider
    ----------------------------------*/
    $(".product__details__pic__slider").owlCarousel({
        loop: true,
        margin: 20,
        items: 4,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*-----------------------
        Price Range Slider
    ------------------------ */
    var rangeSlider = $(".price-range"),
        minamount = $("#minamount"),
        maxamount = $("#maxamount"),
        minPrice = rangeSlider.data('min'),
        maxPrice = rangeSlider.data('max');
    rangeSlider.slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        values: [minPrice, maxPrice],
        slide: function (event, ui) {
            minamount.val('$' + ui.values[0]);
            maxamount.val('$' + ui.values[1]);
        }
    });
    minamount.val('$' + rangeSlider.slider("values", 0));
    maxamount.val('$' + rangeSlider.slider("values", 1));

    /*--------------------------
        Select
    ----------------------------*/
    $("select").niceSelect();

    /*------------------
        Single Product
    --------------------*/
    $('.product__details__pic__slider img').on('click', function () {

        var imgurl = $(this).data('imgbigurl');
        var bigImg = $('.product__details__pic__item--large').attr('src');
        if (imgurl != bigImg) {
            $('.product__details__pic__item--large').attr({
                src: imgurl
            });
        }
    });

    let tbody = document.getElementById("productTest");
    function product(name, price, img, productId, categoryId) {
        let td = document.createElement('div');
        td.classList.add("col-lg-3");
        td.classList.add("col-md-4");
        td.classList.add("col-sm-6");
        td.classList.add("mix");
        td.classList.add("oranges");
        td.classList.add("fresh-meat");
        td.innerHTML = `
        <div class="featured__item" id = "product${productId}">
            <div class="featured__item__pic set-bg" data-setbg="img/product/${img}">
            <a href="shop-details.html?getProductById=true&productId=${productId}&catId=${categoryId}" class="">
                <img src="img/product/${img}" alt="">
            </a>
                <ul class="featured__item__pic__hover">
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
            </div>
            <div class="featured__item__text">
                <h6 id = "product1"><a href="#">${name}</a></h6>
                <h5>${price}</h5>
            </div>
        </div>`;
        return td;
    }

    function GetProductsByCatId(name, price, img, productId, categoryId) {
        let td = document.createElement('div');
        td.classList.add("col-lg-3");
        td.classList.add("col-md-4");
        td.classList.add("col-sm-6");
        td.innerHTML = `
        <div class="product__item" id = "product${productId}">
                        <div class="product__item__pic set-bg" data-setbg="img/product/${img}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                            <a href="shop-details.html?getProductById=true&productId=${productId}&catId=${categoryId}" class="">
                            </a>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">${name}</a></h6>
                            <h5>${price}</h5>
                        </div>
        </div>`;
        return td;
    }

    // get listt product main
    $("#logo").click(function () {
        var getAllProduct = "isGet";
        $.ajax({
            url: baseUrl + "/admin/product/controller/indexController.php",
            type: "POST",
            data: {
                getAllProduct: getAllProduct,
            },
            dataType: "json",
            success: function (result) {
                if (result['success'] === true) {
                    for (let i = 0; i <= result['data'].length; i++) {
                        tbody.append(product(result['data'][i]['productName']
                            , result['data'][i]['price']
                            , result['data'][i]['image']
                            , result['data'][i]['productId']
                            , result['data'][i]['categoryId']
                        ));
                    }

                } else {
                }
            }
        });
    })

    if (urlParams.get('getProductById') != "") {
        let getProductById = "true";
        let productId = urlParams.get('productId');
        $.ajax({
            url: baseUrl + "/admin/product/controller/indexController.php",
            type: "GET",
            data: {
                getProductById: getProductById,
                productId: productId
            },
            dataType: "json",
            success: function (result) {
                if (result['success'] === true) {
                    $(".productName").html(result['data'][0]['productName']);
                    $(".productPrice").html(result['data'][0]['price']);
                    $(".productImg").attr('src', "img/product/" + result['data'][0]['image']);
                    $(".productDescription").html(result['data'][0]['decription']);
                } else {
                    alert(result['message']);
                }
            }
        });

        let tbody = document.getElementById("productByCatId");
        let getProductsByCatId = "true";
        let catId = urlParams.get('catId');
        $.ajax({
            url: baseUrl + "/admin/product/controller/indexController.php",
            type: "GET",
            data: {
                getProductsByCatId: getProductsByCatId,
                catId: catId
            },
            dataType: "json",
            success: function (result) {
                if (result['success'] === true) {
                    for (let i = 0; i <= result['data'].length; i++) {
                        tbody.append(product(result['data'][i]['productName']
                            , result['data'][i]['price']
                            , result['data'][i]['image']
                            , result['data'][i]['productId']
                            , result['data'][i]['categoryId']
                        ));
                    }

                } else {
                    alert(result['message']);
                }
            }
        });
    }

    //img/product/details/product-details-1.jpg
    // $("#logo").click(function () {
    //     var getAllProduct = "isGet";
    //     $.ajax({
    //         url: baseUrl+"/admin/product/controller/indexController.php",
    //         type: "post",
    //         data: {
    //             getAllProduct: getAllProduct,
    //         },
    //         dataType: "json",
    //         success: function (result) {
    //             if (result['success'] === true) {
    //                 for (let i = 1; i < result['data'].length; i++) {
    //                     // var id = "#product" + i;
    //                     $("#product" + i).html(result['data'][i]['productName']);
    //                   }
    //             } else
    //             {

    //             }
    //         },
    //     });
    // })
    /*-------------------
        Quantity change
    --------------------- */
    var proQty = $('.pro-qty');
    proQty.prepend('<span class="dec qtybtn">-</span>');
    proQty.append('<span class="inc qtybtn">+</span>');
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
    });

})(jQuery);