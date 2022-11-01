<?php

?>

<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Sản phẩm làm đẹp da</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Mã sản phẩm</td>
                            <td>Ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td colspan="2">Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($_SESSION['cart']['product'])){
                        foreach ($_SESSION['cart']['product'] as $item)  {?>

                            <tr id="<?php echo "product".$item['id'] ?>">
                                <td>HCA00031</td>
                                <td>
                                <a href="?page=detail_product&productId=<?php echo $item['id'] ?>" title="" class="thumb">
                                    <img src="<?php echo $item["picture"] ?>" id="<?php echo "picture". $item["id"] ?>">
                                    </a>
                                </td>
                                <td>
                                    <a href="?page=detail_product&productId=<?php echo $item['id'] ?>" title="" class="name-product" id="<?php echo "name". $item["id"] ?>"><?php echo $item["name"] ?></a>
                                </td>
                                <td><?php echo $item["price"] ?></td>
                                <td>
                                    <input type="number" min="1" max="10"  name="num-order" value="<?php echo $item["amount"] ?>" id="<?php echo $item["id"] ?>" class="num-order">
                                </td>
                                <td class="price" id="<?php echo "price". $item["id"] ?>"><?php echo $item["subTotal"] ?></td>
                                <td>
                                    <p title="" class="del-product"><i class="fa fa-trash-o delProduct" id="<?php echo $item['id'] ?>"></i></p>
                                </td>
    
                            </tr>
                            <?php } ?>
                            <?php } else { ?>
                                <p>chua cos san pham dc mua</p>
                                <?php } ?>


                    
                    </tfoot>
                </table>
                <p class="fl-right">tong tien <span id="totalPrice"><?php
                if(isset($_SESSION['cart']['totalPrice']))
                echo $_SESSION['cart']['totalPrice'] ?></span></p>
            </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <a href="?page=home" title="" id="buy-more">Mua tiếp</a><br/>
                <a href="" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
    </div>
</div>