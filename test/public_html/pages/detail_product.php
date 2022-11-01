<?php
include 'admin/product/model/indexModel.php';
include 'admin/category/product/model/indexModel.php';
$category = new category(0, 0, "");
$product = new product(0, 0, 0, 0, 0, 0, 0, 0);
$productDetail = $product->getProductById($_GET['productId'])->data[0];
$listProductByCatId = $product->getListProductsByCatId($productDetail->categoryId)->data;
$caca = $category->getAllCategory();
$cc = getDatatree($caca['data'], 0);
?>

<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Điện thoại</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <a href="" title="" id="main-thumb">
                            <img id="zoom" width="350px"  height="350px" src="<?php echo $config['baseUrl'] ?>/admin/public/image/<?php echo $productDetail->image ?>" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg" />
                        </a>
                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="public/images/img-pro-01.png" alt="">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name"><?php echo $productDetail->productName ?></h3>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status"><?php if($productDetail->status == 1) {
                                echo "Còn hàng";
                            } else {
                                echo "hết hàng";
                            } ?></span>
                        </div>
                        <p class="price"><?php echo $productDetail->price  ?>đ</p>
                        <div id="num-order-wp">
                            <a title="" id="minus"><i class="fa fa-minus"></i></a>
                            <input type="text" name="num-order" value="1" id="num-order">
                            <a title="" id="plus"><i class="fa fa-plus"></i></a>
                        </div>
                        <?php if($productDetail->status == 1) { ?>
                        <button id="<?php echo $productDetail->productId ?>" title="Thêm giỏ hàng" class="add-cart status-order">Thêm giỏ hàng</button>
                            <?php } ?>
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <?php echo $productDetail->decription ?>
                </div>
            </div>
            <div class="section-same" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php foreach ($listProductByCatId as $item) { ?>
                            <li>
                                <a href="?page=detail_product" title="" class="thumb">
                                    <img width="200px" height="200px" src="<?php echo $config['baseUrl'] ?>/admin/public/image/<?php echo $item->image ?>" id="<?php echo "image" . $item->productId ?>">
                                </a>
                                <a href="?page=detail_product&productId=<?php echo $item->productId ?>" title="" id="<?php echo "name" . $item->productId ?>" class="product-name"><?php echo $item->productName ?></a>
                                <div class="price">
                                    <span class="new" id="<?php echo "price" . $item->productId ?>"><?php echo $item->price ?></span>
                                    <span class="old"><?php echo $item->price * 120 / 100 ?></span>
                                </div>
                                <div class="action clearfix">
                                    <button id="<?php echo $item->productId ?>" title="" class="add-cart fl-left order">Thêm giỏ hàng</button>
                                    <a href="?page=checkout" id="<?php echo $item->productId ?>" title="" class="buy-now fl-right buy-now">Mua ngay</a>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    <ul class="list-item">
                        <?php foreach ($cc as $item) {
                            if ($item['level'] == 0) { ?>
                                <li>

                                    <a href="?page=category_product" title=""><?php if ($item['level'] == 0) {
                                                                                    echo $item['categoryName'];
                                                                                } else {
                                                                                } ?></a>
                                    <ul class="sub-menu">
                                        <?php foreach ($cc as $item1) {
                                            if ($item1['level'] != 0) { ?>

                                                <li>
                                                    <a href="?page=category_product&categoryId=<?php echo $item1['categoryId'] ?>" title=""><?php if ($item1['parentId'] == $item['categoryId']) {
                                                                                                                                                echo str_repeat('', $item1['level']) . $item1['categoryName'];
                                                                                                                                            } ?></a>
                                                </li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            </div>
    </div>