



<div id="content" class="container-fluid">
    <?php 
        require_once './category/product/model/indexModel.php';
        require_once './product/model/indexModel.php';
        $category = new category("sfdsdf","adas","dsadas");
        $product = new product(0,0,"","","","",0,0);
        $productEditDetail = $product->getProductById($_GET['productId'])->data[0];
        $caca = $category->getAllCategory();
        $cc = getDatatree($caca['data'],0,0);

    ?>
    <div class="card">
        <div class="card-header font-weight-bold">
            Chỉnh sửa sản phẩm
        </div>
        <div class="card-body">
            <form action="<?php echo $config['baseUrl']?>/admin/product/controller/indexController.php" enctype="multipart/form-data" method="POST">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input class="form-control" type="text" name="productName" id="name" value="<?php echo $productEditDetail->productName ?>">
                        </div>
                        <div class="form-group">
                            <label for="name">Giá</label>
                            <input class="form-control" type="text" name="price" id="name" value="<?php echo $productEditDetail->price ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Size</label>
                    <select class="form-control" name="size" id="">
                        <option>Chọn Size</option>
                        <option value="22" <?php if ($productEditDetail->size == 22 ) { echo ' selected="selected"'; } ?>>22</option>
                        <option value="24" <?php if ($productEditDetail->size == 24 ) { echo ' selected="selected"'; } ?>>24</option>
                        <option value="26" <?php if ($productEditDetail->size == 26 ) { echo ' selected="selected"'; } ?>>26</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="intro">Chi tiết sản phẩm</label>
                    <textarea name="decription" class="form-control decription" id="decription" cols="30" rows="5"><?php echo $productEditDetail->decription ?></textarea>
                </div>


                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select class="form-control" name="categoryId" id="">
                        <option>Chọn danh mục</option>
                        <?php
                            foreach($cc as $item){
                        ?>
                        <option value="<?php echo $item['categoryId'] ?>"<?php  if ($productEditDetail->categoryId == $item['categoryId'] ) { echo ' selected="selected"'; } ?>><?php echo str_repeat('---', $item['level'] ).$item['categoryName']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="intro">Hinh</label>
                    <input type="file" name="uploadFile">
                </div>
                <div class="form-group">
                    <label for="">trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isActive" id="exampleRadios1" value="0" checked>
                        <label class="form-check-label" for="exampleRadios1">
                           Đã xóa
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isActive" id="exampleRadios2" value="1">
                        <label class="form-check-label" for="exampleRadios2">
                            Hoạt động
                        </label>
                    </div>
                </div>
                <button type="submit" value="<?php echo $productEditDetail->productId ?>" class="btn btn-primary" name="updateProduct">Thêm mới</button>
            </form>
            <script>
                    CKEDITOR.replace( 'decription' );
            </script>
        </div>
    </div>
</div>
