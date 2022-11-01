<?php
    include 'admin/product/model/indexModel.php';
    include 'admin/category/product/model/indexModel.php';
    $product = new product(0, 0, "", "", "", "", 0, 0);
    $category = new category(0, 0, "");
    $current_page = (!isset($_GET['page'])) ? 1 : $_GET['page'];
    $categoryId = (!isset($_GET['categoryId'])) ? 1 : $_GET['categoryId'];
    $listProduct = $product->getListProductsByCatId($categoryId);
    $caca = $category->getAllCategory();
    $cc = getDatatree($caca['data'], 0);

?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div id="main-content-wp" class="clearfix category-product-page">
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
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">Laptop</h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị 45 trên 50 sản phẩm</p>
                        <div class="form-filter">
                            <form method="POST" action="">
                                <select name="select">
                                    <option value="0">Sắp xếp</option>
                                    <option value="1">Từ A-Z</option>
                                    <option value="2">Từ Z-A</option>
                                    <option value="3">Giá cao xuống thấp</option>
                                    <option value="3">Giá thấp lên cao</option>
                                </select>
                                <button type="submit">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php foreach ($listProduct->data as $item) { ?>
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
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                    <?php
                            if ($current_page > 1 && $_SESSION['total_page_product'] > 1) {
                                echo $current_page;
                                echo '<li class="page-item"><a class="page-link" href="?view=list-product&page=' . ($current_page - 1) . '">Prev</a><li class="page-item">';
                            }

                            // Lặp khoảng giữa
                            for ($i = 1; $i <= $_SESSION['total_page_product']; $i++) {
                                // Nếu là trang hiện tại thì hiển thị thẻ span
                                // ngược lại hiển thị thẻ a
                                if ($i == $current_page) {
                                    echo '<span>' . $i . '</span>  ';
                                } else {
                                    echo ' <li class="page-item"><a class="page-link"<a href="?view=list-product&page=' . $i . '">' . $i . '</a> <li class="page-item"> ';
                                }
                            }

                            if ($current_page < $_SESSION['total_page_product'] && $_SESSION['total_page_product'] > 1) {
                                echo '<li class="page-item"><a class="page-link" <a href="?view=list-product&page=' . ($current_page + 1) . '">Next</a> <li class="page-item"> ';
                            }
                            ?>
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
            <div class="section" id="filter-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Bộ lọc</h3>
                </div>
                <div class="section-detail">
                    <form method="POST" action="">
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Giá</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>Dưới 500.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>500.000đ - 1.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>1.000.000đ - 5.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>5.000.000đ - 10.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>Trên 10.000.000đ</td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Hãng</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Acer</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Apple</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Hp</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Lenovo</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Samsung</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Toshiba</td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Loại</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>Điện thoại</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>Laptop</td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>