
    var baseUrl = "http://localhost/project/";
    $('.nav-link.active .sub-menu').slideDown();
    $("p").slideUp();

    $('#sidebar-menu .arrow').click(function () {
        $(this).parents('li').children('.sub-menu').slideToggle();
        $(this).toggleClass('fa-angle-right fa-angle-down');
    });

    $("input[name='checkall']").click(function () {
        var checked = $(this).is(':checked');
        $('.table-checkall tbody tr td input:checkbox').prop('checked', checked);
    });

    $("#addCat").click(function () {
        var categoryName = $('#name').val();
        var parentId = $('#parentId option:selected').val();
        var addCat = "asdasd";
        $.ajax({
            url: baseUrl + "/admin/category/product/controller/indexController.php",
            type: "post",
            data: {
                categoryName: categoryName,
                parentId: parentId,
                addCat: addCat
            },
            dataType: "json",
            success: function (result) {
                if (result['success'] === true) {
                    alert(result['message']);

                } else {
                    alert(result['message']);
                }
            },
        });
    })

    //delete product
    $(".btnDeleteProduct").click(function () {
        var productId = $(this).attr('id');
        var isActive = $("#isActive" + productId).text();
        var delProduct = "del";
        alert(productId);

        $.ajax({
            url: baseUrl + "/admin/product/controller/indexController.php",
            type: "post",
            data: {
                productId: productId,
                isActive: isActive,
                delProduct: delProduct,
            },
            dataType: "json",
            success: function (result) {
                if (result['success'] === true) {
                    alert(result['message']);

                } else {
                    alert(result['message']);
                }
            },
        });
    })

    $(".btnDeletePost").click(function () {
        var postId = $(this).attr('id');
        var delPost = "delPost";
        $.ajax({
            url: baseUrl + "/admin/post/controller/indexController.php",
            type: "post",
            data: {
                postId: postId,
                delPost: delPost,
            },
            dataType: "json",
            success: function (result) {
                if (result['success'] === true) {
                    $("#" + result['data'][0]).html("đã xóa");
                } else {
                    alert(result['message']);
                }
            },
        });
    })

    

    $(".btnDeleteUser").click(function () {
        var userId = $(this).attr('id');
        var delUser = "delUser";

        $.ajax({
            url: baseUrl + "/admin/user/controller/indexController.php",
            type: "post",
            data: {
                userId: userId,
                delUser: delUser,
            },
            dataType: "json",
            success: function (result) {
                if (result['success'] === true) {
                    $("#" + result['data'][0]).html("đã xóa");
                } else {
                    alert(result['message']);
                }
            },
        });
    })

    $(".btnDeleteOrder").click(function () {
        var orderId = $(this).attr('id');
        var delOrder = "delOrder";

        $.ajax({
            url: baseUrl + "/admin/order/controller/indexController.php",
            type: "post",
            data: {
                orderId: orderId,
                delOrder: delOrder,
            },
            dataType: "json",
            success: function (result) {
                if (result['success'] === true) {
                    $("#" + result['data'][0]).html("đã hủy");
                } else {
                    alert(result['message']);
                }
            },
        });
    })

    $(".listActionProduct").click(function () {
        var listId = $("input[name^='check']:checked:enabled").map(function (idx, ele) {
            if ($(ele).val() !== 'on') {
                return $(ele).val();
            }
        }).get();
        var statusProduct = $('#listActive option:selected').val();
        var listAction = "listAction";
        $.ajax({
            url: baseUrl + "/admin/product/controller/indexController.php",
            type: "post",
            data: {
                listId: listId,
                statusProduct: statusProduct,
                listAction: listAction,
            },
            dataType: "json",
            success: function (result) {
                if (result['success'] === true) {
                    for (let i = 0; i < result['data'][0].length; i++) {
                        if (result['data'][1] == 1) {
                            $("#" + result['data'][0][i]).html("còn hàng");
                        } else {
                            $("#" + result['data'][0][i]).html("hết hàng");
                        }
                    }
                } else {
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus, errorThrown);
            }
        });
    });

    $(".listActionPost").click(function () {
        var listId = $("input[name^='check']:checked:enabled").map(function (idx, ele) {
            if ($(ele).val() !== 'on') {
                return $(ele).val();
            }
        }).get();
        var statusPost = $('#listActive option:selected').val();
        var listAction = "listAction";
        $.ajax({
            url: baseUrl + "/admin/post/controller/indexController.php",
            type: "post",
            data: {
                listId: listId,
                statusPost: statusPost,
                listAction: listAction,
            },
            dataType: "json",
            success: function (result) {
                if (result['success'] === true) {
                    for (let i = 0; i < result['data'][0].length; i++) {
                        if (result['data'][1] == 1) {
                            $("#" + result['data'][0][i]).html("đã đăng");
                        } else if (result['data'][1] == 0) {
                            $("#" + result['data'][0][i]).html("chờ duyệt");
                        } else {
                            $("#" + result['data'][0][i]).html("Đã xóa");
                        }
                    }
                } else {
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus, errorThrown);
            }
        });
    });

    $(".btn-success").click(function () {
        var userName = $("#usr").val();
        var password = $("#pwd").val();
        var login = "loginUser";
        $.ajax({
            url: "https://xuankhai.000webhostapp.com/admin/user/controller/indexController.php",
            type: "POST",
            data: {
                userName: userName,
                password: password,
                loginUser: login,
            },
            dataType: "json",
            success: function (result) {
                if (result['success'] == true) {
                    window.location = "https://xuankhai.000webhostapp.com/";
                }
                else {
                    alert(result['message']);
                }
            },

        });
    });

    $(".listActionUser").click(function () {
        var listId = $("input[name^='check']:checked:enabled").map(function (idx, ele) {
            if ($(ele).val() !== 'on') {
                return $(ele).val();
            }
        }).get();
        var statusUser = $('#listActive option:selected').val();
        var listAction = "listAction";
        alert(listId);
        $.ajax({
            url: baseUrl + "/admin/user/controller/indexController.php",
            type: "post",
            data: {
                listId: listId,
                statusUser: statusUser,
                listAction: listAction,
            },
            dataType: "json",
            success: function (result) {
                if (result['success'] == true) {
                    for (let i = 0; i < result['data'][0].length; i++) {

                        if (result['data'][1] == 1) {
                            $("#" + result['data'][0][i]).html("user");
                        } else if (result['data'][1] == 0) {
                            $("#" + result['data'][0][i]).html("đã xóa");
                        } else {
                            $("#" + result['data'][0][i]).html("admin");
                        }
                    }
                } else {
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus, errorThrown);
            }
        });
    });

    $(".listActionOrder").click(function () {
        var listId = $("input[name^='check']:checked:enabled").map(function (idx, ele) {
            if ($(ele).val() !== 'on') {
                return $(ele).val();
            }
        }).get();
        var statusOrder = $('#listActive option:selected').val();
        var listAction = "listAction";
        $.ajax({
            url: baseUrl + "/admin/order/controller/indexController.php",
            type: "post",
            data: {
                listId: listId,
                listStatusOrder: statusOrder,
                listAction: listAction,
            },
            dataType: "json",
            success: function (result) {
                if (result['success'] == true) {
                    for (let i = 0; i < result['data'][0].length; i++) {
                        if (result['data'][1] == 1) {
                            $("#" + result['data'][0][i]).html("đã hoàn thành");
                        } else if (result['data'][1] == 0) {
                            $("#" + result['data'][0][i]).html("đang xử lý");
                        } else {
                            $("#" + result['data'][0][i]).html("đã hủy");
                        }
                    }
                } else {
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus, errorThrown);
            }
        });
    });

    $(function () {
        var inputFile = $('#file');
        $('#upload_single_bt').click(function (event) {
            var fileToUpload = inputFile[0].files[0];
            var formData = new FormData();
            formData.append('file', fileToUpload);
            $.ajax({
                url: 'public/views/upload_single.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    if (data.status == 'ok') {
                        showThumbUpload(data);
                        $('#thumbnail_url').val(data.file_path);
                    }

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
            return false;
        });

        function showThumbUpload(data) {
            var items;
            items = '<img width="200px" height="200px" src="' + baseUrl + '/admin/public/image/' + data.name + '"/>';
            $('#show_list_file').html(items);
        }

    });
    $(".order").click(function () {
        var id = $(this).attr('id');
        var name = $("#name" + id).text();
        var picture = $("#image" + id).attr('src');
        var price = parseInt($("#price" + id).text().replace(/[^0-9.]/g, ""));
        var addCart = "addcart";

        $.ajax({
            url: baseUrl + "/admin/cart/indexController.php",
            type: "post",
            data: {
                id: id,
                name: name,
                picture: picture,
                price: price,
                addCart: addCart,
            },
            dataType: "json",
            success: function (result) {
                if (result['success'] == true) {
                    var totalPrice = result['data'][4];
                    var price = result['data'][3];
                    var numProduct = result['data'][6];
                    var name = result['data'][2];
                    var img = result['data'][7];
                    $("#totalPrice").html(totalPrice);
                    $("#ajax-price").html(price);
                    $("#ajax-amount").html(numProduct);
                    $("#ajax-name").html(name);
                    $("#ajax-img").attr('src', img);
                } else {
                    alert(result['message']);
                }
            },
        });
    });

    $(".buy-now").click(function () {
        var id = $(this).attr('id');
        var name = $("#name" + id).text();
        var picture = $("#image" + id).attr('src');
        var price = parseInt($("#price" + id).text().replace(/[^0-9.]/g, ""));
        var addCart = "addcart";

        $.ajax({
            url: baseUrl + "/admin/cart/indexController.php",
            type: "post",
            data: {
                id: id,
                name: name,
                picture: picture,
                price: price,
                addCart: addCart,
            },
            dataType: "json",
            success: function (result) {
                if (result['success'] == true) {
                    window.location("?page=cart");

                } else {
                    alert(result['message']);
                }
            },
        });
    });

    $("#order-now").click(function () {
        var order = $(this).val();
        var fullname = $("#fullname").val();
        var address = $("#address").val();
        var phone_number = $("#phone").val();
        var note = $("#note").val();
        $.ajax({
            url: baseUrl + "/admin/order/controller/indexController.php",
            type: "post",
            data: {
                order: order,
                fullname: fullname,
                address: address,
                phone_number: phone_number,
                note: note,
            },
            dataType: "json",
            success: function (result) {
                if (result['success'] == true) {
                    window.location("?page=home");

                } else {
                    alert(result['message']);
                }
            },
        });
    });
    $("#status-order").click(function () {
        var statusOrder = $(this).text();
        var orderId = $(this).attr('class');

        $.ajax({
            url: baseUrl + "/admin/order/controller/indexController.php",
            type: "post",
            data: {
                statusOrder: statusOrder,
                orderId: orderId,
            },
            dataType: "json",
            success: function (result) {
                if (result['success'] == true) {
                    if ($("#status-order").text() === "Đã hoàn thành") {
                        $("#status-order").html("Đang xử lý");
                    } else {
                        $("#status-order").html("Đã hoàn thành");
                    }

                } else {
                    alert(result['message']);
                }
            },
        });
    });

    $(".status-order").click(function () {
        var id = $(this).attr('id');
        var name = $("#name" + id).text();
        var picture = $(".product-img").attr('src');
        var price = parseInt($("#price" + id).text().replace(/[^0-9.]/g, ""));
        var amount = $("#num-order").val();
        var addCart = "addcart";
        alert(price);
        $.ajax({
            url: baseUrl + "/admin/cart/indexController.php",
            type: "post",
            data: {
                id: id,
                name: name,
                picture: picture,
                price: price,
                amount: amount,
                addCart: addCart,

            },
            dataType: "json",
            success: function (result) {
                if (result['success'] == true) {
                    var totalPrice = result['data'][4];
                    var price = result['data'][3];
                    var numProduct = result['data'][6];
                    var name = result['data'][2];
                    var img = result['data'][7];
                    $("#num").html(numProduct);

                } else {
                    alert(result['message']);
                }
            },
        });
    });

    $(".num-order").click(function () {
        var id = $(this).attr('id');
        var amount = $(this).val();
        var name = $("#name" + id).text();
        var picture = $("#picture" + id).attr('src');
        var addCart = "addcart";
        var price = parseInt($("#price" + id).text().replace(/[^0-9.]/g, ""));


        $.ajax({
            url: baseUrl + "/admin/cart/indexController.php",
            type: "post",
            data: {
                id: id,
                amount: amount,
                picture: picture,
                name: name,
                addCart: addCart,
                price: price,
            },
            dataType: "json",
            success: function (result) {
                if (result['success'] == true) {
                    var totalPrice = result['data'][4];
                    var price = result['data'][3];
                    var numProduct = result['data'][6];
                    var name = result['data'][2];
                    var img = result['data'][7];
                    var subTotal = result['data'][1];
                    $("#price" + result['data'][0]).html(subTotal);
                    $("span#totalPrice").html(totalPrice);
                    $("#num").html(numProduct)
                } else {
                    alert(result['message']);
                }
            },
        });
    });

    $(".delProduct").click(function () {
        var id = $(this).attr('id');
        var delProduct = "delProduct";
        $.ajax({
            url: baseUrl + "/admin/cart/indexController.php",
            type: "post",
            data: {
                id: id,
                delProduct: delProduct,
            },
            dataType: "json",
            success: function (result) {
                if (result['success'] == true) {
                    $("#product" + result['data'][0]).css("display", "none");
                    $("#product-icon" + result['data'][0]).css("display", "none");
                    $(".num").html(result['data'][1]);
                    $("span#totalPrice").html(result['data'][2]);

                } else {
                    alert(result['message']);
                }
            },
        });
    });
    var slider = $('.section-same .section-detail');

    slider.owlCarousel({
        autoPlay: 4500,
        navigation: false,
        navigationText: false,
        paginationNumbers: false,
        pagination: true,
        items: 1, //10 items above 1000px browser width
        itemsDesktop: [1000, 1], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 1], // betweem 900px and 601px
        itemsTablet: [600, 1], //2 items between 600 and 0
        itemsMobile: true // itemsMobile disabled - inherit from itemsTablet option
    });

    //  ZOOM PRODUCT DETAIL
    $("#zoom").elevateZoom({ gallery: 'list-thumb', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif' });

    //  LIST THUMB
    var list_thumb = $('#list-thumb');
    list_thumb.owlCarousel({
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 5, //10 items above 1000px browser width
        itemsDesktop: [1000, 5], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 5], // betweem 900px and 601px
        itemsTablet: [768, 5], //2 items between 600 and 0
        itemsMobile: true // itemsMobile disabled - inherit from itemsTablet option
    });

    //  FEATURE PRODUCT
    var feature_product = $('#feature-product-wp .list-item');
    feature_product.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 4, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
    });

    //  SAME CATEGORY
    var same_category = $('#same-category-wp .list-item');
    same_category.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 4, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
    });

    //  SCROLL TOP
    $(window).scroll(function () {
        if ($(this).scrollTop() != 0) {
            $('#btn-top').stop().fadeIn(150);
        } else {
            $('#btn-top').stop().fadeOut(150);
        }
    });
    $('#btn-top').click(function () {
        $('body,html').stop().animate({ scrollTop: 0 }, 800);
    });

    // CHOOSE NUMBER ORDER
    var value = parseInt($('#num-order').attr('value'));
    $('#plus').click(function () {
        value++;
        $('#num-order').attr('value', value);
        update_href(value);
    });
    $('#minus').click(function () {
        if (value > 1) {
            value--;
            $('#num-order').attr('value', value);
        }
        update_href(value);
    });

    //  MAIN MENU
    $('#category-product-wp .list-item > li').find('.sub-menu').after('<i class="fa fa-angle-right arrow" aria-hidden="true"></i>');

    //  TAB
    tab();

    //  EVEN MENU RESPON
    $('html').on('click', function (event) {
        var target = $(event.target);
        var site = $('#site');

        if (target.is('#btn-respon i')) {
            if (!site.hasClass('show-respon-menu')) {
                site.addClass('show-respon-menu');
            } else {
                site.removeClass('show-respon-menu');
            }
        } else {
            $('#container').click(function () {
                if (site.hasClass('show-respon-menu')) {
                    site.removeClass('show-respon-menu');
                    return false;
                }
            });
        }
    });

    //  MENU RESPON
    $('#main-menu-respon li .sub-menu').after('<span class="fa fa-angle-right arrow"></span>');
    $('#main-menu-respon li .arrow').click(function () {
        if ($(this).parent('li').hasClass('open')) {
            $(this).parent('li').removeClass('open');
        } else {

            //            $('.sub-menu').slideUp();
            //            $('#main-menu-respon li').removeClass('open');
            $(this).parent('li').addClass('open');
            //            $(this).parent('li').find('.sub-menu').slideDown();
        }
    });


    function tab() {
        var tab_menu = $('#tab-menu li');
        tab_menu.stop().click(function () {
            $('#tab-menu li').removeClass('show');
            $(this).addClass('show');
            var id = $(this).find('a').attr('href');
            $('.tabItem').hide();
            $(id).show();
            return false;
        });
        $('#tab-menu li:first-child').addClass('show');
        $('.tabItem:first-child').show();
    }
    document.getElementById("p").style.display = "block";
