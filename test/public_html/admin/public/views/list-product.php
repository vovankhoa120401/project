<div id="content" class="container-fluid">
    <?php
        include './product/model/indexModel.php';
        include './category/product/model/indexModel.php';
        $product = new product(0,0,"","","","",0,0);
        $category = new category("sfdsdf","adas","dsadas");
        // $CategoryById = $category->getCategoryId();
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $listProduct = $product->getAllProduct($current_page);

         if(isset($_GET['action'])){
            if ($_GET['action'] == 'delete') {
                $listProduct = $product->showDeleteProduct();
                $countDelProduct = count($listProduct->data);
            } elseif ($_GET['action'] == 'showStocking') {
                $listProduct = $product->showStocking();
                $countShowStockingProduct = count($listProduct->data);

            }

            elseif($_GET['action'] == 'showOutOfStock') {
                $listProduct = $product->showOutOfStock();
                $countShowOutOfStockProduct = count($listProduct->data);

            };
        }
        else {
            $listProduct = $product->getAllProduct($current_page);

        }
        
    ?>
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách sản phẩm</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="?view=list-product&action=showStocking" class="text-primary">Còn hàng <span class="text-muted">(<?php if(isset($countShowStockingProduct)) echo $countShowStockingProduct ?>)</span></a>
                <a href="?view=list-product&action=showOutOfStock" class="text-primary">Hết hàng <span class="text-muted">(<?php if(isset($countShowOutOfStockProduct)) echo $countShowOutOfStockProduct ?>)</span></a>
                <a href="?view=list-product&action=delete" class="text-primary">Đã xóa<span class="text-muted">(<?php if(isset($countDelProduct)) echo $countDelProduct ?>)</span></a>
        
            </div>
            <div class="form-action form-inline py-3">
                <select name="listActive" id="listActive" class="form-control mr-1">
                    <option >Chọn</option>
                    <option value="1">Còn hàng</option>
                    <option value="0">Hết hàng</option>
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary listActionProduct">
            </div>
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $t = 0;
                        foreach($listProduct->data as $product) {
                            $t++
                    ?>

                        <tr class="table-primary">
                            <td><input id="check" name="check[]" type="checkbox" value="<?php echo $product->productId ?>"></td>
                            <td><?php echo $t ?></td>
                            <td><img width="100px" height="100px" id="<?php echo "image". $product->productId ?>" class = "image" src="<?php echo $config['baseUrl']."/admin/public/image/" . $product->image ?>" alt=""></td>
                            <td id="<?php echo "name" . $product->productId?>"><?php echo $product->productName ?></td>
                            <td id="<?php echo "price" . $product->productId?>"><?php echo moneyFormatIndia($product->price)  ?></td>
                            <td id="<?php echo "chil" . $product->productId?>"><?php echo $product->categoryName  ?></td>
                            <td id="<?php echo "createdAt" . $product->productId?>"><?php echo $product->createdAt ?></td>
                            <td id="<?php echo $product->productId?>"><?php if( $product->status == '1'){ echo "còn hàng";}else {echo "hết hàng";} ?></td>
                            <td>
                                <a href="?view=edit-product&productId=<?php echo $product->productId?>" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <button id="<?php echo $product->productId ?>" class="btn btn-danger btn-sm rounded-0 text-white btnDeleteProduct" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                            </td> 
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">Trước</span>
                            <span class="sr-only">Sau</span>
                        </a>
                        <?php
                        if ($current_page > 1 && $_SESSION['total_page_product'] > 1){
                            echo ' <li class="page-item"><a class="page-link" href="?view=list-product&page='.($current_page-1).'">Prev</a>  <li class="page-item">  ';
                        }

                        // Lặp khoảng giữa
                        for ($i = 1; $i <= $_SESSION['total_page_product']; $i++){
                            // Nếu là trang hiện tại thì hiển thị thẻ span
                            // ngược lại hiển thị thẻ a
                            if ($i == $current_page){
                                echo '<span>'.$i.'</span>  ';
                            }
                            else{
                                echo ' <li class="page-item"><a class="page-link"<a href="?view=list-product&page='.$i.'">'.$i.'</a> <li class="page-item"> ';
                            }
                        }

                        if ($current_page < $_SESSION['total_page_product'] && $_SESSION['total_page_product'] > 1){
                            echo '<li class="page-item"><a class="page-link" <a href="?view=list-product&page='.($current_page+1).'">Next</a> <li class="page-item"> ';
                        }
                        ?>
                </ul>
            </nav>
        </div>
    </div>
</div>